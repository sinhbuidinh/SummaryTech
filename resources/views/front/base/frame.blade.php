<html lang="en-US" class="js no-svg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex,follow">
    <link rel="stylesheet" href="{{ asset('css/zona/header_image.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/zona/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/zona/footer.css') }}" />
</head>

<body class="home page-template-default page front-page has-header-image page-two-column colors-light">
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
        @include('front.base.header')

        <div class="site-content-contain">
            @yield('content')
            @include('front.base.footer')
        </div>
    </div>
</body>
</html>
