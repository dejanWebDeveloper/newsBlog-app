<div class="section bg-light">
    <div class="container">

        <div class="row mb-4">
            @foreach($fourthCategoryNews as $fourthCategoryNew)
                @if($loop->iteration > 1)
                    @break
                @endif
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">{{$fourthCategoryNew->category->name}}</h2>
                </div>
                <div class="col-sm-6 text-sm-end"><a
                        href="{{route('category_page', ['name'=>$fourthCategoryNew->category->name])}}"
                        class="read-more">View All</a></div>
            @endforeach
        </div>

        <div class="row align-items-stretch retro-layout-alt">

                <div class="col-md-5 order-md-2">
                    @foreach($fourthCategoryNews as $fourthCategoryNew)
                        @if($loop->iteration > 1)
                            @break
                        @endif
                    <a href="{{route('single_page', ['heading'=>$fourthCategoryNew->heading])}}"
                       class="hentry gradient
                       @if($loop->iteration == 1) img-1 @endif
                       @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) img-2 v-height @endif
                       @if($loop->iteration == 2) mb30 @endif
                       @if($loop->iteration == 4) ms-auto float-end @endif
                       @if($loop->iteration == 1) h-100 @endif">
                        <div class="featured-img" style="background-image: url('{{url('/themes/front/images/img_2_vertical.jpg')}}');"></div>
                        <div class="text @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) text-sm @endif">
                            <span>{{$fourthCategoryNew->created_at->format('d M Y')}}</span>
                            <h2>{{$fourthCategoryNew->preheading}}</h2>
                        </div>
                    </a>
                    @endforeach
                </div>

            <div class="col-md-7">

                @foreach($fourthCategoryNews as $fourthCategoryNew)
                    @if($loop->iteration <= 1)
                        @continue
                    @endif
                        @if($loop->iteration > 2)
                            @break
                        @endif
                    <a href="{{route('single_page', ['heading'=>$fourthCategoryNew->heading])}}"
                       class="hentry gradient
                       @if($loop->iteration == 1) img-1 @endif
                       @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) img-2 v-height @endif
                       @if($loop->iteration == 2) mb30 @endif
                       @if($loop->iteration == 4) ms-auto float-end @endif
                       @if($loop->iteration == 1) h-100 @endif">
                        <div class="featured-img" style="background-image: url('{{url('/themes/front/images/img_2_vertical.jpg')}}');"></div>
                        <div class="text @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) text-sm @endif">
                            <span>{{$fourthCategoryNew->created_at->format('d M Y')}}</span>
                            <h2>{{$fourthCategoryNew->preheading}}</h2>
                        </div>
                    </a>
                @endforeach

                <div class="two-col d-block d-md-flex justify-content-between">
                    @foreach($fourthCategoryNews as $fourthCategoryNew)
                        @if($loop->iteration <= 2)
                            @continue
                        @endif
                        @if($loop->iteration > 4)
                            @break
                        @endif
                        <a href="{{route('single_page', ['heading'=>$fourthCategoryNew->heading])}}"
                           class="hentry gradient
                       @if($loop->iteration == 1) img-1 @endif
                       @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) img-2 v-height @endif
                       @if($loop->iteration == 2) mb30 @endif
                       @if($loop->iteration == 4) ms-auto float-end @endif
                       @if($loop->iteration == 1) h-100 @endif">
                            <div class="featured-img" style="background-image: url('{{url('/themes/front/images/img_2_vertical.jpg')}}');"></div>
                            <div class="text @if($loop->iteration == 2 || $loop->iteration == 3 || $loop->iteration == 4) text-sm @endif">
                                <span>{{$fourthCategoryNew->created_at->format('d M Y')}}</span>
                                <h2>{{$fourthCategoryNew->preheading}}</h2>
                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
        </div>

    </div>
</div>

<!--
 <div class="col-md-7">

                <a href="#" class="hentry gradient img-2 v-height mb30 ">
                    <div class="featured-img" style="background-image: url('');"></div>
                    <div class="text text-sm">
                        <span></span>
                        <h2></h2>
                    </div>
                </a>

                <div class="two-col d-block d-md-flex justify-content-between">
                    <a href="#" class="hentry gradient v-height img-2 ">
                        <div class="featured-img" style="background-image: url('');"></div>
                        <div class="text text-sm">
                            <span></span>
                            <h2></h2>
                        </div>
                    </a>
                    <a href="#" class="hentry gradient v-height img-2 ms-auto float-end ">
                        <div class="featured-img" style="background-image: url('');"></div>
                        <div class="text text-sm">
                            <span></span>
                            <h2></h2>
                        </div>
                    </a>
                </div>

            </div>
 -->
