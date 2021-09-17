<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    @yield('css')
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon/favicon.ico">
    @include('partials.css')
</head>
<body>
    @include('partials.header')
    @yield('main_content')
    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>