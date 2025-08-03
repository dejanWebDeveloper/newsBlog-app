@push('head_link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@extends('admin._layouts._layout')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">@lang('Add Article')</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Input form of article</li>
        </ol>
        @if(session()->has('system_message'))
            <div class="alert alert-success" role="alert">
                {{session()->pull('system_message')}}
            </div>
        @endif
        <!-- Must have 'entype' or a photo error will occur -->
        <form id="store-article" enctype="multipart/form-data" action="{{route('admin.article.store-article')}}" method="post">
            @csrf
            <div class="col-12">
                <div class="col-6 ">
                    <label for="article_heading" class="form-label">@lang('Input Heading')</label>
                    <input name="heading" type="text" class="form-control @error('heading') is-invalid @enderror"
                           placeholder="Heading of article" value="{{old('heading')}}">
                    <div>
                        @error('heading')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_preheading" class="form-label">@lang('Input Preheading')</label>
                    <input name="preheading" type="text" class="form-control @error('preheading') is-invalid @enderror"
                           placeholder="Preheading of article" value="{{old('preheading')}}">
                    <div>
                        @error('preheading')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_author" class="form-label">@lang('Input Author')</label>
                    <select id="select_author" name="author" class="form-control @error('author') is-invalid @enderror">
                        @foreach($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('author')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_photo" class="form-label">@lang('Input Photo')</label>
                    <input id="photo-input" name="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                           placeholder="Article photo" value="{{old('photo')}}">
                    <img id="photoPreview" src="#" alt="Preview" style="padding-top: 10px; display: none; max-width: 500px;">
                    <div>
                        @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_category" class="form-label">@lang('Input Category')</label>
                    <select id="select_category" name="category_id" class="form-control @error('category') is-invalid @enderror">
                        @foreach($categories as $category)
                            <option @if($category->id == old('category')) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_tags" class="form-label">@lang('Input Tags')</label>
                    <select class="form-control @error('tags') is-invalid @enderror" name="tags[]" id="select_tags" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <label for="article_text" class="form-label">@lang('Input Text')</label>
                    <textarea type="text" class="form-control @error('text') is-invalid @enderror"
                              name="text" id="article_text">{{old('text')}}</textarea>
                    <div>
                        @error('text')
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
            document.getElementById('photo-input').addEventListener('change', function(event) {
                const input = event.target;
                const preview = document.getElementById('photoPreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });

            $(document).ready(function () {
                $('#select_author').select2({
                    "placeholder" : "--select author--"
                });
                $('#select_category').select2({
                    "placeholder" : "--select category--"
                });
                $('#select_tags').select2({
                    "placeholder" : "--select tags--"
                });

                CKEDITOR.replace('article_text');
                CKEDITOR.config.height = 600;

                $('#store-article').validate({
                    "rules": {
                        "ignore" : [], //zbog tags i editora
                        "heading": {
                            "required": true,
                            "minlength": 3,
                            "maxlength": 30
                        },
                        "preheading": {
                            "required": true,
                            "minlength": 5,
                            "maxlength": 60
                        },
                        "category": {
                            "required": true
                        },
                        "tags[]": {
                            "required": true
                        },
                        "text": {
                            "required": true
                        }
                    },
                    "messages": {
                        "heading": {
                            "required": "Please enter articles heading",
                            "minlength": "Your name must be over 3 characters",
                            "maxlength": "Enter no more than 30 characters"
                        },
                        "preheading": {
                            "required": "Please enter articles preheading",
                            "minlength": "Your description must be longer than 5 characters",
                            "maxlength": "Your description cannot be longer than 60 characters"
                        },
                        "category": {
                            "required": "Please enter some category"
                        },
                        "tags[]": {
                            "required": "Please enter some tags"
                        },
                        "text": {
                            "required": "What do you want to say to us"
                        }
                    },
                    "errorClass": "is-invalid"
                });
            });
        </script>
    @endpush
@endsection
