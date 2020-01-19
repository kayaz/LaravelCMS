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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <!-- tutaj trzeba wstawić kod od head -->
</head>
<body id="mainpage">
@include('layouts.header')

<div id="slider" class="clearfix">
    <ul class="rslidess list-unstyled mb-0">
        @foreach ($slider as $s)
        <li>
            <img src="{{asset('uploads/slider/'.$s->file) }}" alt="{{ $s->name }}">
            <div class="apla">
                <h2>{{ $s->name }}<span></span></h2>
            </div>
        </li>
        @endforeach
    </ul>
</div>

<div id="mainbox">
    <div class="container">
        <div class="row">
@foreach ($boxes as $b)
            <div class="col-md-4">
                <div class="boks p-4 pt-5 pb-5 shadow rounded bg-white text-center">
                    <img src="{{asset('uploads/boksy/'.$b->file) }}" class="img-fluid" alt="{{ $b->title }}">
                    <h4 class="title text-uppercase mt-3">{{ $b->title }}</h4>
                    <p class="text-muted">{{ $b->content }}</p>
                </div>
            </div><!--end col-->
@endforeach
        </div><!--end row-->
    </div>
</div>

<div id="news-list" class="container pt-5 pb-5">
    <div class="row">
        <div class="col-12">
            @foreach ($news as $n)
                <article id="list-post-{{ $n->id }}" itemscope="" itemtype="http://schema.org/NewsArticle">
                    <div class="list-post">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->title }}" itemprop="url"><img src="{{asset('uploads/news/thumbs/'.$n->file) }}" alt="{{ $n->title }}"></a>
                            </div>
                            <div class="col-8">
                                <div class="list-post-content">
                                    <header>
                                        <div class="list-post-date">Data publikacji: <span itemprop="datePublished" content="{{ $n->date }}">{{ $n->date }}</span></div>
                                        <h2 class="list-post-title"><a href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->title }}" itemprop="url"><span itemprop="name headline">{{ $n->title }}</span></a></h2>
                                    </header>

                                    <div class="list-post-entry" itemprop="articleBody">
                                        <p class="text-muted">{{ $n->content_entry }}</p>
                                    </div>

                                    <footer>
                                        <a itemprop="url" href="{{route('front.news.wpis', ['slug' => $n->slug])}}" title="{{ $n->title }}" class="bttn">CZYTAJ WIĘCEJ</a>
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
        $(".rslidess").responsiveSlides({auto:true, pager:false, nav:true, timeout:2000, random:false, speed:500});

    });
    $(window).load(function() {
        $(".rslidess").show();
        $(".rslides_nav").show();
    });
    $(window).resize(function() {

    });
</script>
<!-- Tutaj kod stopki -->

</body>
</html>
