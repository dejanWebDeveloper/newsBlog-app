@extends('front._layouts._layout')
@section('content')
    <div class="section search-result-wrap">
        <div class="container">
            @include('front.search_result.partials.title')
            <div class="row posts-entry">
                @include('front.search_result.partials.search_results')

                <div class="col-lg-4 sidebar">

                    @include('front.search_result.partials.search')
                    @include('front.search_result.partials.popular_post')
                    @include('front.search_result.partials.categories_and_tags')

                </div>
            </div>
        </div>
    </div>
@endsection
