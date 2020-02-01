@extends('layouts.page')

@section('meta_title', $wpis->title)
@section('seo_title', $wpis->meta_title)
@section('seo_description', $wpis->meta_description)

@section('content')
    <div class="container wpis-page">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="single-news">
                    <div class="main-entry-img">
                        <img src="{{asset('uploads/news/'.$wpis->file) }}" alt="{{ $wpis->title }}" class="img-news">
                    </div>

                    <div class="main-entry-outer">
                        <div class="main-entry-text">
                            <div class="list-post-date">Data publikacji: <span itemprop="datePublished" content="{{ $wpis->date }}">{{ $wpis->date }}</span></div>
                            <h1>{{ $wpis->title }}</h1>
                            <p><i>{{ $wpis->content_entry }}</i></p>
                            <p>&nbsp;</p>
                            {!! $wpis->content !!}
                            <a href="{{route('front.news.index')}}" class="bttn">WRÓĆ DO AKTUALNOŚCI</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
