<h3 class="mb-5 heading">6 Comments</h3>
<ul class="comment-list" id="comment-wrapper">


@foreach($comments as $comment)
    <li class="comment">
        <div class="vcard">
            <img src="{{url('/themes/front/images/person_1.jpg')}}" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{$comment->name}}</h3>
            <div class="meta">{{$comment->created_at->diffForHumans()}}</div>
            <p>{{$comment->comment}}</p>
            <p><a href="#" class="reply rounded">Reply</a></p>
        </div>
    </li>
    @endforeach
</ul>
