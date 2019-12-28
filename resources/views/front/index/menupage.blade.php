@extends('layouts.page')

@section('meta_title', $page->nazwa)

@section('content')
    <div id="news-list" class="container pt-5 pb-5">
        <div class="row">
                <div class="col-12">
                    {!! $page->tekst !!}
                </div>
        </div>
    </div>
@endsection
