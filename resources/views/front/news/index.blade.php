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
        <div class="col-12">{{ $news->links('front.news.pagination') }}</div>
    </div>
</div>
@endsection
