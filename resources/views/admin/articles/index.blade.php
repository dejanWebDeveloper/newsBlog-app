@push('head_link')
    <!--css link za dataTable plugin-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush

@extends('admin._layouts._layout')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">@lang('Articles')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Table of all articles</li>
        </ol>
        <div style="padding-bottom: 20px; display: inline-block">
            <a class="btn btn-success" href="{{route('admin.article.add-article')}}">Add New Article</a>
        </div>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <div class="row">
            <table id="articles-table" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Ban</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <!--
                <tbody>
                ceo ovaj tbody koji je bio popunjen podacima dobijenim iz prosledjenog artikla smo
                izbrsisali i sada pravimo novi u skladu sa ajax-om
                </tbody>-->
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- modal for deleting articles -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete-article" method="post" action="{{route('admin.article.delete-article')}}">
                        @csrf
                        <input type="hidden" name="article_for_delete_id" value="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete article</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the selected article?
                            <p id="article_for_delete_name"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Delete article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal updateStatus article -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="update-article" method="post" action="{{route('admin.article.update-status')}}">
                        @csrf
                        <input type="hidden" name="article_for_update_id" value="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change status</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to change status of the selected article?
                            <p id="article_for_update_name"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Change status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_script')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //plugin za data tables
        $(document).ready(function () {
            $('#articles-table').dataTable({
                "serverSide": true, //ovo nam oznacava da se podaci dohvataju na serveru, to je nam treba jer biramo nacin preuzimanja pdataka preko ajax-a ne preuyimao plodatke preko kontrolera pa onda ovde da ih ispisujemo kao sto smo do sada radili
                "processing": true, // ovo nam omogucava da dok cekamo da se podaci ucitaju da nam pise neko obavestenje tipa LOADING i sl.
                "ajax": {
                    "url": "{{route('admin.article.datatable')}}", //ruta po kojoj ide ajax
                    "type": "post", //get ili post
                    "data": {
                        "_token": "{{csrf_token()}}" //posto je post metod moramo pod data da prosledimo csrf token
                    }
                },
                "order": [[5, "desc"]], //definisemo order..da bude desc po vrednosti 6 kolone ali brojanje ide od 0 pa je zato 5, mora ovako preko modela kad sortiras ne radi, takav je plugin
                "columns": [
                    {"name": "id", "data": "id"}, //definisemo u pluginu nazive za svaku od kolona
                    {"name": "photo", "orderable": false, "searchable": false, "data": "photo"}, //definisemo po kojim kolonama cemo moci da sortiramo
                    {"name": "heading", "data": "heading"}, //data : heading oznacava sta treba da se ispise za vrednost u toj koloni ispisuje se ono sto je dobije od ajax-a
                    {"name": "category", "data": "category"},
                    {"name": "tag", "orderable": false, "searchable": false, "data": "tag"}, //za search definisemo da radi pretragu samo po heading i categoriji
                    {"name": "created_at", "searchable": false, "data": "created_at"},
                    {"name": "ban", "searchable": false, "data": "ban"},
                    {"name": "actions", "orderable": false, "searchable": false, "data": "actions"}
                ],
                "pageLength": 25,
                "lengthMenu": [5, 10, 15, 25, 30, 50, 100]
            })
            //delete article
            // Otvaranje modala i popunjavanje podataka
            $('#articles-table').on('click', "[data-action='delete']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');

                $("#deleteModal [name='article_for_delete_id']").val(id);
                $('#deleteModal p#article_for_delete_name').html(name);
            });

            // Klik na dugme za potvrdu brisanja
            $('#delete-article').on('submit', function (e) {
                e.preventDefault();
                let articleId = $("#deleteModal [name='article_for_delete_id']").val(); // uzimamo ID iz hidden input-a u modalu

                $.ajax({
                    url: "{{ route('admin.article.delete-article') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        article_for_delete_id: articleId
                    },
                    success: function () {
                        // Sakrij modal
                        $('#deleteModal').modal('hide');
                        toastr.success('Article successfully deleted.');
                        // Reload celog DataTables umesto ručnog uklanjanja reda
                        $('#articles-table').DataTable().ajax.reload(null, false);
                    }
                });
            });

            $('#articles-table').on('click', "[data-action='update']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');
                //let status = $(this).attr('data-status')

                $("#statusModal [name='article_for_update_id']").val(id);
                $('#statusModal p#article_for_update_name').html(name);
            });
            $('#update-article').on('submit', function (e) {
                e.preventDefault();
                let articleId = $("#statusModal [name='article_for_update_id']").val();
                $.ajax({
                    url: "{{ route('admin.article.update-status') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        article_for_update_id: articleId
                    },
                    success: function () {
                        // Sakrij modal
                        $('#statusModal').modal('hide');
                        toastr.success('Article successfully updated.');
                        // Reload celog DataTables umesto ručnog uklanjanja reda
                        $('#articles-table').DataTable().ajax.reload(null, false);
                    }
                });
            });
        });
    </script>
@endpush
