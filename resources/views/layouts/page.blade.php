<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>{{ settings()->get('meta_title') }} - @yield('meta_title')</title>
    <meta name="description" content="{{ settings()->get('meta_title') }}">
    <meta name="author" content="{{ settings()->get('author') }}">
    <meta name="robots" content="{{ settings()->get('robots') }}">

    <!-- Wylaczenie numeru tel. -->
    <meta name="format-detection" content="telephone=no">

    <!-- Prefetch -->
    <link rel="dns-prefetch" href="//maps.google.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <!-- tutaj trzeba wstawić kod od head -->
</head>
<body>

@include('layouts.header')

<main class="pb-5">
    @include('layouts.pageheader')

    @yield('content')
</main>

@include('layouts.footer')

@include('layouts.cookies')

<!-- jQuery -->
<script src="{{ URL::asset('js/jquery.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".rslidess").responsiveSlides({auto:true, pager:false, nav:false, timeout:2000, random:false, speed:500});

    });

    $(window).resize(function() {

    });
</script>
<!-- Tutaj kod stopki -->

</body>
</html>
