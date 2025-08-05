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
        <h1 class="mt-4">@lang('Categories')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Table of all categories</li>
        </ol>
        <div style="padding-bottom: 20px; display: inline-block">
            <a class="btn btn-success" href="{{route('admin.category.add-category')}}">Add New Category</a>
        </div>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <div class="row">
            <table id="categories-table" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Priority</th>
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
                    <form id="delete-category" method="post" action="{{route('admin.category.delete-category')}}">
                        @csrf
                        <input type="hidden" name="category_for_delete_id" value="">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the selected category?
                            <p id="category_for_delete_name"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Delete category</button>
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
            $('#categories-table').dataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{route('admin.category.datatable')}}",
                    "type": "post",
                    "data": {
                        "_token": "{{csrf_token()}}"
                    }
                },
                "order": [[4, "desc"]], //definisemo order..da bude desc po vrednosti 6 kolone ali brojanje ide od 0 pa je zato 5, mora ovako preko modela kad sortiras ne radi, takav je plugin
                "columns": [
                    {"name": "id", "data": "id"},
                    {"name": "name", "data": "name"},
                    {"name": "description", "orderable": false, "data": "description"},
                    {"name": "priority", "data": "priority"},
                    {"name": "created_at", "searchable": false, "data": "created_at"},
                    {"name": "actions", "orderable": false, "searchable": false, "data": "actions"}
                ],
                "pageLength": 10,
                "lengthMenu": [5, 10, 15, 25, 30]
            })

            $('#categories-table').on('click', "[data-action='delete']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');

                $("#deleteModal [name='category_for_delete_id']").val(id);
                $('#deleteModal p#category_for_delete_name').html(name);
            });
            // Klik na dugme za potvrdu brisanja
            $('#delete-category').on('submit', function (e) {
                e.preventDefault();
                let categoryId = $("#deleteModal [name='category_for_delete_id']").val(); // uzimamo ID iz hidden input-a u modalu

                $.ajax({
                    url: "{{ route('admin.category.delete-category') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        category_for_delete_id: categoryId
                    },
                    success: function () {
                        // Sakrij modal
                        $('#deleteModal').modal('hide');
                        toastr.success('Category successfully deleted.');
                        // Reload celog DataTables umesto ručnog uklanjanja reda
                        $('#categories-table').DataTable().ajax.reload(null, false);
                    }
                });
            });
        });
    </script>
@endpush
