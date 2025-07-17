<div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
        <ul>
            @foreach($articlesForDisplay as $articleForDisplay)
            <li>
                <a href="{{route('single_page', ['heading'=>$articleForDisplay->heading])}}">
                    <img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image placeholder" class="me-4 rounded">
                    <div class="text">
                        <h4>{{$articleForDisplay->preheading}}</h4>
                        <div class="post-meta">
                            <span class="mr-2">{{$articleForDisplay->created_at}}</span>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
