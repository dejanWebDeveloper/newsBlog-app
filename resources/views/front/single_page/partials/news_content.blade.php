<div class="post-content-body">
    <style>
        .highlight {
            background-color: yellow;
            font-weight: bold;
            padding: 2px 4px;
            border-radius: 4px;
        }
    </style>
    <ul id="articleList" class="list-unstyled">
        <li>
            <p>{{$article->heading}}</p>
        </li>
    </ul>
    <div class="row my-4">
        <div class="col-md-12 mb-4">
            <img src="{{url('themes/front/images/hero_1.jpg')}}" alt="Image placeholder" class="img-fluid rounded">
        </div>
        <div class="col-md-6 mb-4">
            <img src="{{url('themes/front/images/img_2_horizontal.jpg')}}" alt="Image placeholder" class="img-fluid rounded">
        </div>
        <div class="col-md-6 mb-4">
            <img src="{{url('themes/front/images/img_3_horizontal.jpg')}}" alt="Image placeholder" class="img-fluid rounded">
        </div>
    </div>
    <ul id="articleList" class="list-unstyled">
        <li>
            <p>{{$article->text}}</p>
        </li>
        <li>
            <p>{{$article->preheading}}</p>
        </li>
    </ul>


</div>


<div class="pt-5">
    <p>Categories:  <a href="{{route('category_page', ['name'=>$article->category->name])}}">{{$article->category->name}}</a>
       Tags: <a href="#">#{{$article->tag->pluck('name')->join(', #')}}</a>
    </p>
</div>
