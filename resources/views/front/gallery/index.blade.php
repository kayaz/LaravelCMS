@extends('layouts.page')

@section('meta_title', 'Galeria')

@section('content')
    <div id="news-list" class="container pt-5 pb-5">
        <div class="row">
            @foreach ($list as $l)
            <div class="col-12">
                <h2 class="list-post-title"><a href="{{route('front.galeria.katalog', $l->id)}}" title="{{ $l->name }}">{{ $l->name }}</a></h2>
            </div>
            @endforeach
        </div>
    </div>
@endsection
