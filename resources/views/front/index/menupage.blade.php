@extends('layouts.page')

@section('meta_title', $page->title)
@section('seo_title', $page->meta_title)
@section('seo_description', $page->meta_description)

@section('content')
    <div id="news-list" class="container pt-5 pb-5">
        <div class="row">
                <div class="col-12">
                    {!! parse($page->content) !!}
                </div>
        </div>
    </div>
@endsection
