<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
    @if(session()->has('system_message'))
        <div class="alert alert-success" role="alert">
            {{session()->pull('system_message')}}
        </div>
    @endif
    <form id="email-form" action="{{route('contact_form_upload')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-6 mb-3">
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Your Name" value="{{old('name')}}">
                <div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6 mb-3">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{old('email')}}">
                <div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 mb-3">
                <textarea name="message" id="" cols="30" rows="7" class="form-control @error('message') is-invalid @enderror" placeholder="Message">{{old('message')}}</textarea>
                <div>
                    @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('g-recaptcha-response')
                    <div class="alert alert-danger">{{ $errors->first('g-recaptcha-response') }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <input type="submit" value="Send Message" class="btn btn-primary g-recaptcha"
                       data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"
                       data-callback='onSubmit'
                       data-action='submit'>
            </div>
        </div>
    </form>
</div>
@push('footer_script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#email-form').validate({
                "rules" : {
                    "name" : {
                        "required" : true,
                        "minlength" : 2,
                        "maxlength" : 30
                    },
                    "email" : {
                        "required" : true,
                        "email" : true
                    },
                    "message" : {
                        "required" : true,
                        "minlength" : 10,
                        "maxlength" : 500
                    }
                },
                "messages" : {
                    "name" : {
                        "required" : "Please enter your name",
                        "minlength" : "Your name must be over 2 characters",
                        "maxlength" : "Enter no more than 30 characters"
                    },
                    "email" : {
                        "required" : "Your email adress must be provided",
                        "email" : "Enter valid email adress"
                    },
                    "message" : {
                        "required" : "What do you want to say to us",
                        "minlength" : "Your message must be longer than 10 characters",
                        "maxlength" : "Your message cannot be longer than 500 characters"
                    }
                },
                "errorClass" : "is-invalid"
            });
        });
    </script>

@endpush
@push('recaptcha')
    <script>
        function onSubmit(token) {
            document.getElementById("email-form").submit();
        }
    </script>
@endpush
