<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{url('themes/front/images/hero_5.jpg')}}')">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4">{{$article->heading}}</h1>
                    <div class="post-meta align-items-center text-center">
                        <figure class="author-figure mb-0 me-3 d-inline-block"><img src="{{url('themes/front/images/images/person_1.jpg')}}" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1">{{$article->category->name}}</span>
                        <span>&nbsp;{{$article->created_at}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
