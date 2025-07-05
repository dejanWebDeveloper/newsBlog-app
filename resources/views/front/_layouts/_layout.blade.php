<!doctype html>
<html lang="en">
<head>
@include('front._layouts._head')
</head>
<body>
@include('front._layouts._navbar')

@yield('content')

@include('front._layouts._footer')
@include('front._layouts._footer_script')
</body>
</html>


