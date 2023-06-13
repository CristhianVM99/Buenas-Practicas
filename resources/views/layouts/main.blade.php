<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Propiedades de meta a mostrar-->
    <meta property="og:url"         content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
    <meta property="og:type"        content="article" />
    <meta property="og:title"       content="When Great Minds Don’t Think Alike" />
    <meta property="og:description" content="How much does culture influence creative thinking?" />
    <meta property="og:image"       content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />

    @yield('meta-head')
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/animations.css') }}">
    <link rel="stylesheet" href="{{ url('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ url('css/main.css') }}" class="color-switcher-link">
    <link rel="stylesheet" href="{{ url('css/shop.css') }}" class="color-switcher-link">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe.css">
    <link rel="stylesheet" href="./photoswipe-dynamic-caption-plugin.css">
    @yield('styles-css')
    <script src="{{ url('js/vendor/modernizr-2.6.2.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="preloader">
        <div class="preloader_image"></div>
    </div>
    <div id="canvas">
        <div id="box_wrapper">
            @include('components.menu')
            @include('sections.mensajes-toast')
            @yield('content')
            @yield('footer')
        </div>
    </div>
    <script src='{{ url('js/compressed.js') }}'></script>
    <script src='{{ url('js/main.js') }}'></script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    @yield('scripts-js')
</body>

</html>
