<!DOCTYPE html>
<html>
    <head>
        <title>Techs - @yield('title')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/top_nav.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/message.css') }}" />
        <!-- jQuery -->
        <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/general/event_message.js') }}"></script>
    </head>
    <body>
        @include('layout.header')
        @include('layout.left_sidebar')

        <div class="w3-main w3-light-grey" id="belowtopnav">
            <h1>@yield('title_page')</h1>
            @yield('content')
        </div>

        @yield('custom_script')
        @yield('custom_style')
    </body>
</html>