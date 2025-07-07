<div class="section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-5 mx-auto text-center" data-aos="fade-up">
                <h2 class="heading text-primary">Our Team</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the blind texts. </p>
            </div>
        </div>

        <div class="row">
            @foreach($employees as $employee)
            <div class="col-lg-4 mb-4 text-center" data-aos="fade-up" data-aos-delay="0">
                <img src="{{url('/themes/front/images/person_1.jpg')}}" alt="Image" class="img-fluid w-50 rounded-circle mb-3">
                <h5 class="text-black">{{$employee->name}}</h5>
                <p>{{$employee->text}}</p>
            </div>
            @endforeach
        </div>

    </div>
</div>
