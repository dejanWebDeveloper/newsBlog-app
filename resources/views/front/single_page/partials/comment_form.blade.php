<div class="comment-form-wrap pt-5">
    <h3 class="mb-5">Leave a comment</h3>
    <form id="comment-form" action="{{route('store_comment')}}" method="post" class="p-5 bg-light">
        @csrf
        <div class="form-group">
            <label for="name">Name *</label>
            <input name="name" type="text" class="form-control" id="name">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <input name="email" type="email" class="form-control" id="email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
            @error('comment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('g-recaptcha-response')
            <div class="alert alert-danger">{{ $errors->first('g-recaptcha-response') }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary" id="submit-comment">
        </div>

    </form>
</div>
@push('footer_script')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
<script>

    $(document).ready(function(){

        $('#comment-form').on('submit', function(e){
            e.preventDefault();

            grecaptcha.ready(function() {
                grecaptcha.execute('{{ env("GOOGLE_RECAPTCHA_KEY") }}', {action: 'submit'}).then(function(token) {
                    $.ajax({
                        url: "{{ route('store_comment') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: $('#name').val(),
                            email: $('#email').val(),
                            comment: $('#message').val(),
                            article_id: {{$article->id}},
                            'g-recaptcha-response': token
                        },
                        success: function(response) {
                            $('#comment-form')[0].reset();
                            $('#comment-wrapper').load(window.location.href + ' #comment-wrapper > *');
                        },
                        error: function (xhr) {
                            $('.is-invalid').removeClass('is-invalid');
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function (key, value){
                                    let input = "#comment-form [name='" + key + "']";
                                    $(input).addClass('is-invalid');
                                });
                            }
                        }
                    });
                });
            });
        });



    });
</script>
@endpush
