<div class="col-lg-8">
    @foreach($articlesOfCategory as $articleOfCategory)
    <div class="blog-entry d-flex blog-entry-search-item">
        <a href="{{route('single_page', ['heading'=>$articleOfCategory->heading])}}" class="img-link me-4">
            <img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image" class="img-fluid">
        </a>
        <div>
            <span class="date">{{$articleOfCategory->created_at}}<a href=""> {{$articleOfCategory->category->name}}</a></span>
            <h2><a href="{{route('single_page', ['heading'=>$articleOfCategory->heading])}}">{{$articleOfCategory->heading}}</a></h2>
            <p>{{$articleOfCategory->preheading}}</p>
            <p><a href="{{route('single_page', ['heading'=>$articleOfCategory->heading])}}" class="btn btn-sm btn-outline-primary">Read More</a></p>
        </div>
    </div>
    @endforeach
    <div class="row text-start pt-5 border-top">
        <div class="col-md-12">
            <div class="mt-4" style="padding-top: 40px;">
                {{ $articlesOfCategory->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
