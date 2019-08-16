@extends('layouts.page')

@section('meta_title', $wpis->nazwa)

@section('content')
    <div class="container wpis-page">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="single-news">
                    <div class="main-entry-img">
                        <img src="{{asset('storage/news/'.$wpis->plik) }}" alt="{{ $wpis->nazwa }}" class="img-news">
                    </div>

                    <div class="main-entry-outer">
                        <div class="main-entry-text">
                            <div class="list-post-date">Data publikacji: <span itemprop="datePublished" content="{{ $wpis->data }}">{{ $wpis->data }}</span></div>
                            <h1>{{ $wpis->nazwa }}</h1>
                            <p><i>{{ $wpis->wprowadzenie }}</i></p>
                            {!! $wpis->tekst !!}
                            <a href="{{route('front.news.index')}}" class="bttn">WRÓĆ DO AKTUALNOŚCI</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
