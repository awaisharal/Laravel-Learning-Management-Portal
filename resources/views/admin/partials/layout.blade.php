<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    @yield('css')
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon/favicon.ico">
    @include('admin.partials.css')
</head>
<body>
    <div id="db-wrapper">
       <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- Page Content -->
        <div id="page-content">
            <!-- Header -->
            @include('admin.partials.header')
            <!-- Body -->
            @yield('main_content')
        </div>
    </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    @include('admin.partials.scripts')
</body>
</html>