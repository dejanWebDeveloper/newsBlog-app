@push('head_link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@extends('admin._layouts._layout')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">@lang('Edit Category')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Input Form of Category</li>
        </ol>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <!-- Must have 'entype' or a photo error will occur -->
        <form id="edit-category" action="{{route('admin.category.update-category', ['category'=>$category])}}" method="post">
            @csrf
            <div class="col-12">
                <div class="col-6 ">
                    <label for="category_name" class="form-label">@lang('Input Name od category')</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Name of category" value="{{old('name', $category->name)}}">
                    <div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="category_description" class="form-label">@lang('Input Description of Category')</label>
                    <input name="description" type="text" class="form-control @error('description') is-invalid @enderror"
                           placeholder="Description of category" value="{{old('description', $category->description)}}">
                    <div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-check-label" for="show_on_homepage">@lang('Show on Homepage')</label>
                    <input class="form-check-input" type="checkbox" value="1" id="show_on_homepage"
                           name="show_on_homepage"
                        {{ old('show_on_homepage', $category->show_on_homepage ?? false) ? 'checked' : '' }}>
                    <div>
                        @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="category_priority" class="form-label">@lang('Input Priority')</label>
                    <select id="select_priority" name="priority" class="form-control @error('priority') is-invalid @enderror">
                        <option value="0">-- select priority --</option>
                        <option value="1">@lang('First Category')</option>
                        <option value="2">@lang('Second Category')</option>
                        <option value="3">@lang('Third Category')</option>
                        <option value="4">@lang('Fourth Category')</option>
                    </select>
                    <div>
                        @error('priority')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" data-action='submit'>SEND</button>
                </div>
            </div>
        </form>
    </div>
    @push('footer_script')
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <script>
            $(document).ready(function () {
                $('#select_priority').select2({
                    "placeholder" : "--select priority--"
                });

                $('#edit-category').validate({
                    "rules": {
                        "ignore" : [], //zbog tags i editora
                        "name": {
                            "required": true,
                            "minlength": 3,
                            "maxlength": 30
                        },
                        "description": {
                            "required": true,
                            "minlength": 3,
                            "maxlength": 100
                        },
                        "priority": {
                            "required": true
                        }
                    },
                    "messages": {
                        "name": {
                            "required": "Please enter category name",
                            "minlength": "Category name must be over 3 characters",
                            "maxlength": "Enter no more than 30 characters"
                        },
                        "description": {
                            "required": "Please enter category description",
                            "minlength": "Your description must be longer than 5 characters",
                            "maxlength": "Your description cannot be longer than 60 characters"
                        },
                        "priority": {
                            "required": "If you don't enter a priority, it will be the first free value of the added category ID."
                        }
                    },
                    "errorClass": "is-invalid"
                });
            });
        </script>
    @endpush
@endsection
