@extends('front._layouts._layout')
@section('content')
    <div class="section search-result-wrap">
        <div class="container">
            @include('front.category.partials.title')
            <div class="row posts-entry">
                @include('front.partials.categories_news')

                <div class="col-lg-4 sidebar">

                    @include('front.partials.popular_post')
                    @include('front.partials.categories_and_tags')

                </div>
            </div>
        </div>
    </div>
@endsection
