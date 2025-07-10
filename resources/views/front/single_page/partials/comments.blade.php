<h3 class="mb-5 heading">6 Comments</h3>
<ul class="comment-list">

    <li class="comment">
        <div class="vcard">
            <img src="images/person_2.jpg" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>Jean Doe</h3>
            <div class="meta">January 9, 2018 at 2:21pm</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
            <p><a href="#" class="reply rounded">Reply</a></p>
        </div>

        <ul class="children">
            <li class="comment">
                <div class="vcard">
                    <img src="images/person_3.jpg" alt="Image placeholder">
                </div>
                <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                </div>

            </li>
        </ul>
    </li>

    <li class="comment">
        <div class="vcard">
            <img src="images/person_1.jpg" alt="Image placeholder">
        </div>
        <div class="comment-body">
            <h3>Jean Doe</h3>
            <div class="meta">January 9, 2018 at 2:21pm</div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
            <p><a href="#" class="reply rounded">Reply</a></p>
        </div>
    </li>
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
