@push('head_link')
    <!--css link za dataTable plugin-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

@endpush

@extends('admin._layouts._layout')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">@lang('Tags')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Table of all tags</li>
        </ol>
        <div style="padding-bottom: 20px; display: inline-block">
            <a class="btn btn-success" href="{{route('admin.tag.add-tag')}}">Add New Tag</a>
        </div>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <div class="row">
            <table id="tags-table" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col" class="w-50">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete-tag" method="post" action="{{route('admin.tag.delete-tag')}}">
                        @csrf
                        <input type="hidden" name="tag_for_delete_id" value="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Tag</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the selected tag?
                            <p id="tag_for_delete_name"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Delete tag</button>
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
            $('#tags-table').dataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{route('admin.tag.datatable')}}",
                    "type": "post",
                    "data": {
                        "_token": "{{csrf_token()}}"
                    }
                },
                "order": [[3, "desc"]], //definisemo order..da bude desc po vrednosti 6 kolone ali brojanje ide od 0 pa je zato 5, mora ovako preko modela kad sortiras ne radi, takav je plugin
                "columns": [
                    {"name": "id", "data": "id"},
                    {"name": "name", "data": "name"},
                    {"name": "created_at", "searchable": false, "data": "created_at"},
                    {"name": "actions", "orderable": false, "searchable": false, "data": "actions"}
                ],
                "pageLength": 10,
                "lengthMenu": [5, 10, 15, 25, 30]
            })

            $('#tags-table').on('click', "[data-action='delete']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');

                $("#deleteModal [name='tag_for_delete_id']").val(id);
                $('#deleteModal p#tag_for_delete_name').html(name);
            });
            // Klik na dugme za potvrdu brisanja
            $('#delete-tag').on('submit', function (e) {
                e.preventDefault();
                let tagId = $("#deleteModal [name='tag_for_delete_id']").val(); // uzimamo ID iz hidden input-a u modalu

                $.ajax({
                    url: "{{ route('admin.tag.delete-tag') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tag_for_delete_id: tagId
                    },
                    success: function () {
                        // Sakrij modal
                        $('#deleteModal').modal('hide');
                        toastr.success('Tag successfully deleted.');
                        // Reload celog DataTables umesto ručnog uklanjanja reda
                        $('#tags-table').DataTable().ajax.reload(null, false);
                    }
                });
            });
        });
    </script>
@endpush
