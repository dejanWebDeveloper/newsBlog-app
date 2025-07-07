<div class="section sec-halfs py-0">
    <div class="container">
        @foreach($articles as $article)

        <div class="half-content d-lg-flex align-items-stretch">
            <div class="img @if($loop->iteration==2) order-md-2 @endif" style="background-image: url('{{url('/themes/front/images/hero_1.jpg')}}')" data-aos="fade-in" @if($loop->iteration==1) data-aos-delay="100" @endif>

            </div>
            <div class="text">
                <h2 class="heading text-primary mb-3">{{$article->preheading}}</h2>
                <p class="mb-4">{{$article->text}}</p>
                <p><a href="{{route('single_page', ['heading'=>$article->heading])}}" class="btn btn-outline-primary py-2">Read more</a></p>
            </div>
        </div>
        @endforeach

    </div>

</div>
