<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{route('index_page')}}" class="logo m-0 float-start">Blogy<span class="text-primary">.</span></a>
                    </div>
                    <div class="col-8 text-center">
                        <form action="#" class="search-form d-inline-block d-lg-none">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bi-search"></span>
                        </form>

                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li class="has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{route('search_result_page')}}">Search Result</a></li>
                                    <li><a href="{{route('blog_page')}}">Blog</a></li>
                                    <li><a href="{{route('about_page')}}">About</a></li>
                                    <li><a href="{{route('contact_page')}}">Contact Us</a></li>

                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">Categories</a>
                                <ul class="dropdown">
                                    @foreach($categoriesForDisplay as $newCategory)
                                    <li><a href="{{route('category_page', ['category'=>$newCategory->name])}}">{{$newCategory->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">Tags</a>
                                <ul class="dropdown">
                                    @foreach($tagsForDisplay as $newTag)
                                    <li><a href="#">#{{$newTag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-2 text-end">
                        <a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                        <form action="#" class="search-form d-none d-lg-inline-block">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bi-search"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
