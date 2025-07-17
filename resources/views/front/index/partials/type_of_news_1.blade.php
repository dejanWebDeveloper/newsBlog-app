<section class="section posts-entry">
    <div class="container">
        <div class="row mb-4">
            @foreach($firstCategoryNews as $firstCategoryNew)
                @if($loop->iteration > 1)
                    @break
                @endif
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">{{$firstCategoryNew->category->name}}</h2>
                </div>
                <div class="col-sm-6 text-sm-end"><a
                        href="{{route('category_page', ['name'=>$firstCategoryNew->category->name])}}"
                        class="read-more">View All</a></div>
            @endforeach
        </div>
        <div class="row g-3">
            <div class="col-md-9">
                <div class="row g-3">
                    @foreach($firstCategoryNews as $firstCategoryNew)
                        @if($loop->iteration > 2)
                            @break
                        @endif
                        <div class="col-md-6">
                            <div class="blog-entry">

                                <a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}"
                                   class="img-link">
                                    <img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image"
                                         class="img-fluid">
                                </a>
                                <span class="date">{{$firstCategoryNew->created_at->format('d M Y')}}</span>
                                <h2>
                                    <a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}">{{$firstCategoryNew->heading}}</a>
                                </h2>
                                <p>{{$firstCategoryNew->preheading}}</p>
                                <p><a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}"
                                      class="btn btn-sm btn-outline-primary">Read More</a></p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled blog-entry-sm">
                    @foreach($firstCategoryNews as $firstCategoryNew)
                        @if($loop->iteration <= 2)
                            @continue
                        @endif
                        @if($loop->iteration > 5)
                            @break
                        @endif
                        <li>
                            <span class="date">{{$firstCategoryNew->created_at->format('d M Y')}}</span>
                            <h3>
                                <a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}">{{$firstCategoryNew->heading}}</a>
                            </h3>
                            <p>{{$firstCategoryNew->preheading}}</p>
                            <p><a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}"
                                  class="read-more">Continue Reading</a></p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End posts-entry -->

<!-- Start posts-entry -->
<section class="section posts-entry posts-entry-sm bg-light">
    <div class="container">
        <div class="row">
            @foreach($firstCategoryNews as $firstCategoryNew)
                @if($loop->iteration <= 5)
                    @continue
                @endif
                @if($loop->iteration > 9)
                    @break
                @endif
            <div class="col-md-6 col-lg-3">
                <div class="blog-entry">
                    <a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}" class="img-link">
                        <img src="{{url('/themes/front/images/img_2_horizontal.jpg')}}" alt="Image" class="img-fluid">
                    </a>
                    <span class="date">{{$firstCategoryNew->created_at->format('d M Y')}}</span>
                    <h2><a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}">{{$firstCategoryNew->preheading}}</a></h2>
                    <p>{{$firstCategoryNew->preheading}}</p>
                    <p><a href="{{route('single_page', ['heading'=>$firstCategoryNew->heading])}}" class="read-more">Continue Reading</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
