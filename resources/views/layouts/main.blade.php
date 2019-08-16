<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>{{ settings()->get('meta_title') }}</title>
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
<body id="mainpage">
Test
@include('layouts.header')

<div id="slider" class="clearfix">
    <ul class="rslidess list-unstyled mb-0">
        @foreach ($slider as $s)
        <li><img src="{{asset('storage/slider/'.$s->plik) }}" alt="{{ $s->nazwa }}"></li>
        @endforeach
    </ul>
</div>

<div id="news-list" class="container pt-5 pb-5">
    <div class="row">
        <div class="col-12">
            @foreach ($news as $n)
                <article id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                    <div class="list-post">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->nazwa }}" itemprop="url"><img src="{{asset('storage/news/thumbs/'.$n->plik) }}" alt="{{ $n->nazwa }}"></a>
                            </div>
                            <div class="col-8">
                                <div class="list-post-content">
                                    <header>
                                        <div class="list-post-date">Data publikacji: <span itemprop="datePublished" content="{{ $n->data }}">{{ $n->data }}</span></div>
                                        <h2 class="list-post-title"><a href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->nazwa }}" itemprop="url"><span itemprop="name headline">{{ $n->nazwa }}</span></a></h2>
                                    </header>

                                    <div class="list-post-entry" itemprop="articleBody">
                                        <p>{{ $n->wprowadzenie }}</p>
                                    </div>

                                    <footer>
                                        <a itemprop="url" href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->nazwa }}" class="bttn">CZYTAJ WIĘCEJ</a>
                                        <meta itemprop="author" content="JK Design">
                                        <meta itemprop="mainEntityOfPage" content="{{route('front.news.wpis', ['slug' => $n->slug])}}">
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
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
