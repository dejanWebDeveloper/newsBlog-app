<section class="section posts-entry posts-entry-sm bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-uppercase text-black">More Blog Posts</div>
        </div>
        <div class="row">
            @foreach($moreBlogArticles as $moreBlogArticle)
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="#" class="img-link">
                            <img src="{{url('themes/front/images/img_1_horizontal.jpg')}}" alt="Image" class="img-fluid">
                        </a>
                        <span class="date">{{$moreBlogArticle->created_at}}</span>
                        <h2><a href="#">{{$moreBlogArticle->heading}}</a></h2>
                        <p>{{$moreBlogArticle->preheading}}</p>
                        <p><a href="{{route('single_page', ['heading'=>$moreBlogArticle->heading])}}" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
