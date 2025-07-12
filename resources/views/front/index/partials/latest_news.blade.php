<!-- Start retroy layout blog posts -->

<section class="section bg-light">
    <div class="container">
        <div class="row align-items-stretch retro-layout">
            <!-- udjes na public/themes/index.html i tamo ces videti kakva je struktura bila ove sekcije
            rad se sveo na sledece:
                napravili smo foreach loop i u nju ubacili onaj deo koda koji se ponavlja u svih 5 divova, a to je <a></a>
                zatim smo ono sto se razlikuje od prolaska do prolaska kroz kod definisali uz pomoc if i loop iteration
                zatim smo pre samog koda koji je vidljiv na stranici a ispod foreach petlje definisali do koje iteracije se koeriste
                podaci taj deo kooda, 1 i 2, 3, 4 i 5
                *moglo je i bez continue i break
            -->
            <div class="col-md-4">
                @foreach($latestNews as $leadArticle)
                    @if($loop->iteration > 2)
                        @break
                    @endif
                    <a href="{{route('single_page', ['heading'=>$leadArticle->heading])}}"
                       class="h-entry @if($loop->iteration == 3) img-5 h-100 @endif @if($loop->iteration == 1 ||$loop->iteration == 4) mb-30 @endif @if($loop->iteration != 3) v-height @endif gradient">

                        <div class="featured-img" style="background-image: url('/themes/front/images/hero_2.jpg');"></div>
                        <!-- ovo je jako bitno da ako smo uneli podatke u bazu i kada ih preko nekog query buildera vadimo iz baze ti dobijeni podaci su objekti klase u nasem slucaju DB i zato da bi ispisali neku
                         njegovu vrednosti moramo da koristimo terminologiju za objkete a ne za nizove -> umesto ['']-->
                        <div class="text">
                            <span class="date">{{ $leadArticle->preheading }}</span>
                            <h2>{{ $leadArticle->created_at->format('d M Y') }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-md-4">
                @foreach($latestNews as $leadArticle)
                    @if($loop->iteration <= 2)
                        @continue
                    @endif
                    @if(@$loop->iteration > 3)
                        @break
                    @endif
                    <a href="{{route('single_page', ['heading'=>$leadArticle->heading])}}"
                       class="h-entry @if($loop->iteration == 3) img-5 h-100 @endif @if($loop->iteration == 1 ||$loop->iteration == 4) mb-30 @endif gradient">

                        <div class="featured-img" style="background-image: url('/themes/front/images/hero_2.jpg');"></div>

                        <div class="text">
                            <span class="date">{{ $leadArticle->preheading }}</span>
                            <h2>{{ $leadArticle->created_at->format('d M Y') }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-md-4">
                @foreach($latestNews as $leadArticle)
                    @if($loop->iteration < 4)
                        @continue
                    @endif
                    <a href="{{route('single_page', ['heading'=>$leadArticle->heading])}}"
                       class="h-entry  @if($loop->iteration == 1 || $loop->iteration == 4) mb-30 @endif @if($loop->iteration != 3) v-height @endif gradient">

                        <div class="featured-img" style="background-image: url('/themes/front/images/hero_2.jpg');"></div>

                        <div class="text">
                            <span class="date">{{ $leadArticle->preheading }}</span>
                            <h2>{{ $leadArticle->created_at->format('d M Y') }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
