@extends('front._layouts._layout')
@section('content')
    @include('front.single_page.partials.title')
    <section class="section">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">
                    @include('front.single_page.partials.news_content')
                    <div class="pt-5 comment-wrap">
                        @include('front.single_page.partials.comments')
                        @include('front.single_page.partials.comment_form')
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 sidebar">
                    @include('front.partials.search')
                    @include('front.single_page.partials.author_information')
                    <div class="sidebar-box">
                        @include('front.partials.popular_post')
                    </div>
                    @include('front.partials.categories_and_tags')
                </div>
            </div>
        </div>
    </section>
    @include('front.single_page.partials.more_blog_posts')
@endsection
