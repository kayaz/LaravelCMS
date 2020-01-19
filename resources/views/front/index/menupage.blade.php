@extends('layouts.page')

@section('meta_title', $page->title)

@section('content')
    <div id="news-list" class="container pt-5 pb-5">
        <div class="row">
                <div class="col-12">
                    {!! $page->content !!}
                </div>
        </div>
    </div>
@endsection
