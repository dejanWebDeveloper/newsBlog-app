@extends('admin._layouts._layout')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">@lang('Edit Tag')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Input Form of Tag</li>
        </ol>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <!-- Must have 'entype' or a photo error will occur -->
        <form id="edit-tag" action="{{route('admin.tag.update-tag', ['tag'=>$tag])}}" method="post">
            @csrf
            <div class="col-12">
                <div class="col-6 " style="padding-bottom: 10px;">
                    <label for="tag_name" class="form-label">@lang('Input Name od Tag')</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Name of Tag" value="{{old('name', $tag->name)}}">
                    <div>
                        @error('name')
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
        <script>
            $(document).ready(function () {
                $('#edit-tag').validate({
                    "rules": {
                        "ignore" : [], //zbog tags i editora
                        "name": {
                            "required": true,
                            "minlength": 3,
                            "maxlength": 30
                        }
                    },
                    "messages": {
                        "name": {
                            "required": "Please enter category name",
                            "minlength": "Category name must be over 3 characters",
                            "maxlength": "Enter no more than 30 characters"
                        }
                    },
                    "errorClass": "is-invalid"
                });
            });
        </script>
    @endpush
@endsection
