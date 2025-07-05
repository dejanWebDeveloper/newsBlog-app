@extends('front._layouts._layout')

@section('content')
    <!-- Start retroy layout blog posts -->
    @include('front.index.partials.latest_news')
    <!-- End retroy layout blog posts -->

    <!-- Start posts-entry -->
    @include('front.index.partials.type_of_news_1')
    <!-- End posts-entry -->

    <!-- Start posts-entry -->
    @include('front.index.partials.type_of_news_2')
    <!-- End posts-entry -->

    <!-- Start posts-entry -->
    @include('front.index.partials.type_of_news_3')
    <!-- End posts-entry -->

    <!-- Start posts-entry -->
    @include('front.index.partials.type_of_news_4')
    <!-- End posts-entry -->

@endsection
