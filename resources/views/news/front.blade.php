@extends('layouts.page')

@section('meta_title', 'Aktualności')

@section('content')
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
@endsection
