<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
    @if(session()->has('system_message'))
        <div class="alert alert-success" role="alert">
            {{session()->pull('system_message')}}
        </div>
    @endif
    <form action="{{route('contact_form_upload')}}" method="post">
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
                </div>
            </div>

            <div class="col-12">
                <input type="submit" value="Send Message" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
