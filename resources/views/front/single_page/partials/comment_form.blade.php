<div class="comment-form-wrap pt-5">
    <h3 class="mb-5">Leave a comment</h3>
    <form id="comment-form" action="{{route('store_comment')}}" method="post" class="p-5 bg-light">
        @csrf
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Post Comment" class="btn btn-primary">
        </div>

    </form>
</div>
@push('footer_script')
<script>
    $(document).ready(function(){

        $('#comment-form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                "url": "{{route('store_comment')}}",
                "type": "POST",
                "data": {
                    "_token": "{{csrf_token()}}",
                    "name": $('#name').val(),
                    "email": $('#email').val(),
                    "comment": $('#message').val(),
                    "article_id": {{$article->id}}
                }
            }).done(function (){
                location.reload();
            }).fail(function (data){
                $.each(data.responseJSON.errors, function (key, value){
                    var input = "#comment-form [name='"+key+"']";
                    $(input).addClass('is-invalid');
                });
            });
        })
    });
</script>
@endpush
