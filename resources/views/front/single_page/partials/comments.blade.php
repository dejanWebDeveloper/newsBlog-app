
<ul class="comment-list" id="comment-wrapper">
    <h3 class="mb-5 heading">{{count($comments)}} @if(count($comments) == 0 || count($comments) == 1) Comment @else Comments @endif </h3>

@foreach($comments as $comment)
    <li class="comment">
        <div class="vcard">
            <img src="{{url('/themes/front/images/person_1.jpg')}}" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>{{$comment->name}}</h3>
            <div class="meta">{{$comment->created_at->diffForHumans()}}</div>
            <p>{{$comment->comment}}</p>
        </div>
    </li>
    @endforeach
</ul>
