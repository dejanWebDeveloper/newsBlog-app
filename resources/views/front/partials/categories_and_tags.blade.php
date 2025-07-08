<div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
        @foreach($categories as $category)
        <li><a href="{{route('category_page', ['name'=>$category->name])}}">{{$category->name}}<span>{{count($category->articles)}}</span></a></li>
        @endforeach
    </ul>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">
        @foreach($tags as $tag)
        <li><a href="#">#{{$tag->name}}</a></li>
        @endforeach
    </ul>
</div>
