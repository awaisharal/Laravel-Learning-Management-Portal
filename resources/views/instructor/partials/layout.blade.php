<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon/favicon.ico">
        <base href="/">
        @yield('meta')
        @include('instructor.partials.css')
        @yield('css')
    </head>
    <body>
        @include('instructor.partials.header')
        <div class="pt-5 pb-5">
            <div class="container">
                @include('instructor.partials.top_section')
                <div class="row mt-0 mt-md-4">
                    <div class="col-lg-3 col-md-4 col-12">
                        @include('instructor.partials.sidebar')                        
                    </div>
                    @yield('main_content')
                </div>
            </div>
        </div>
        @include('instructor.partials.scripts')
        @include('instructor.partials.footer')
    </body>
</html>