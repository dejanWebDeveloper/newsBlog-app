<section class="section posts-entry">
    <div class="container">
        <div class="row mb-4">
            @foreach($secondCategoryNews as $secondCategoryNew)
                @if($loop->iteration > 1)
                    @break
                @endif
            <div class="col-sm-6">
                <h2 class="posts-entry-title">{{$secondCategoryNew->category->name}}</h2>
            </div>
            <div class="col-sm-6 text-sm-end"><a href="{{route('category_page', ['name'=>$secondCategoryNew->category->name])}}" class="read-more">View All</a></div>
            @endforeach
        </div>
        <div class="row g-3">
            <div class="col-md-9 order-md-2">
                <div class="row g-3">
                    @foreach($secondCategoryNews as $secondCategoryNew)
                        @if($loop->iteration > 2)
                            @break
                        @endif
                    <div class="col-md-6">
                        <div class="blog-entry">
                            <a href="{{route('single_page', ['heading'=>$secondCategoryNew->heading])}}" class="img-link">
                                <img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image" class="img-fluid">
                            </a>
                            <span class="date">{{$secondCategoryNew->created_at->format('d M Y')}}</span>
                            <h2><a href="{{route('single_page', ['heading'=>$secondCategoryNew->heading])}}">{{$secondCategoryNew->heading}}</a></h2>
                            <p>{{$secondCategoryNew->preheading}}</p>
                            <p><a href="{{route('single_page', ['heading'=>$secondCategoryNew->heading])}}" class="btn btn-sm btn-outline-primary">Read More</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <ul class="list-unstyled blog-entry-sm">
                    @foreach($secondCategoryNews as $secondCategoryNew)
                        @if($loop->iteration <= 2)
                            @continue
                        @endif
                        @if($loop->iteration > 5)
                            @break
                        @endif
                    <li>
                        <span class="date">{{$secondCategoryNew->created_at->format('d M Y')}}</span>
                        <h3><a href="{{route('single_page', ['heading'=>$secondCategoryNew->heading])}}">{{$secondCategoryNew->heading}}</a></h3>
                        <p>{{$secondCategoryNew->preheading}}</p>
                        <p><a href="{{route('single_page', ['heading'=>$secondCategoryNew->heading])}}" class="read-more">Continue Reading</a></p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
