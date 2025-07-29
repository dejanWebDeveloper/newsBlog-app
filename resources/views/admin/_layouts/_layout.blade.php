<!DOCTYPE html>
<html lang="en">
@include('admin._layouts._head')
<body class="sb-nav-fixed">
@include('admin._layouts._navbar')
<div id="layoutSidenav">
    @include('admin._layouts._side_nav')
    <div id="layoutSidenav_content">
        <main>
            @yield('content')
        </main>
    </div>

</div>
@include('admin._layouts._footer')
@include('admin._layouts._footer_script')
</body>
</html>
