<section class="section">
    <div class="container">

        <div class="row mb-4">
            @foreach($thirdCategoryNews as $thirdCategoryNew)
                @if($loop->iteration > 1)
                    @break
                @endif
            <div class="col-sm-6">
                <h2 class="posts-entry-title">{{$thirdCategoryNew->category->name}}</h2>
            </div>
            <div class="col-sm-6 text-sm-end"><a href="{{route('category_page', ['name'=>$thirdCategoryNew->category->name])}}" class="read-more">View All</a></div>
            @endforeach
        </div>

        <div class="row">
            @foreach($thirdCategoryNews as $thirdCategoryNew)
                @if($loop->iteration > 9)
                    @break
                @endif
            <div class="col-lg-4 mb-4">
                <div class="post-entry-alt">
                    <a href="{{route('single_page', ['heading'=>$thirdCategoryNew->heading])}}" class="img-link"><img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image"
                                                                class="img-fluid"></a>
                    <div class="excerpt">


                        <h2><a href="{{route('single_page', ['heading'=>$thirdCategoryNew->heading])}}">{{$thirdCategoryNew->preheading}}</a></h2>
                        <div class="post-meta align-items-center text-left clearfix">
                            <figure class="author-figure mb-0 me-3 float-start"><img src="images/person_5.jpg"
                                                                                     alt="Image" class="img-fluid">
                            </figure>
                            <span class="d-inline-block mt-1">By <a href="{{route('single_page', ['heading'=>$thirdCategoryNew->heading])}}">{{$thirdCategoryNew->heading}}</a></span>
                            <span>{{$thirdCategoryNew->created_at->format('d M Y')}}</span>
                        </div>

                        <p>{{$thirdCategoryNew->text}}</p>
                        <p><a href="{{route('single_page', ['heading'=>$thirdCategoryNew->heading])}}" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
