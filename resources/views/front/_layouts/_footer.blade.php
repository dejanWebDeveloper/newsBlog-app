<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">About</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts.</p>
                </div> <!-- /.widget -->
                <div class="widget">
                    <h3>Social</h3>
                    <ul class="list-unstyled social">
                        <li><a href="https://www.instagram.com/?hl=en"><span class="icon-instagram"></span></a></li>
                        <li><a href="https://x.com/?lang=en"><span class="icon-twitter"></span></a></li>
                        <li><a href="https://www.facebook.com/"><span class="icon-facebook"></span></a></li>
                        <li><a href="https://www.linkedin.com/"><span class="icon-linkedin"></span></a></li>
                        <li><a href="https://www.pinterest.com/"><span class="icon-pinterest"></span></a></li>
                        <li><a href="https://dribbble.com/"><span class="icon-dribbble"></span></a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4 ps-lg-5">
                <div class="widget">
                    <h3 class="mb-4">Categories and Tags</h3>
                    <ul class="list-unstyled float-start links">
                        @foreach($categoriesForDisplay as $categoryForDisplay)
                            @if($loop->iteration > 6)
                                @break
                            @endif
                            <li>
                                <a href="{{route('category_page', ['name' => $categoryForDisplay->name])}}">{{$categoryForDisplay->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="list-unstyled float-start links">
                        @foreach($tagsForDisplay as $tag)
                            @if($loop->iteration > 6)
                                @break
                            @endif
                            <li><a href="">#{{$tag->name}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">Recent Post Entry</h3>
                    <div class="post-entry-footer">
                        <ul>
                            @foreach($articlesForDisplay as $article)
                            <li>
                                <a href="{{route('single_page', ['heading'=>$article->heading])}}">
                                    <img src="{{url('/themes/front/images/img_1_sq.jpg')}}" alt="Image placeholder" class="me-4 rounded">
                                    <div class="text">
                                        <h4>{{$article->preheading}}</h4>
                                        <div class="post-meta">
                                            <span class="mr-2">{{$article->created_at}}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>


                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
        </div> <!-- /.row -->

        <div class="row mt-5">
            <div class="col-12 text-center">
                <!--
                    **==========
                    NOTE:
                    Please don't remove this copyright link unless you buy the license here https://untree.co/license/
                    **==========
                  -->

                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    . All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>
                    Distributed by <a href="https://themewagon.com">ThemeWagon</a>
                    <!-- License information: https://untree.co/license/ -->
                </p>
            </div>
        </div>
    </div> <!-- /.container -->
</footer> <!-- /.site-footer -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
