@extends('layouts.page')

@section('meta_title', $gallery->name)

@section('content')
    <div id="photos-list" class="container pt-5 pb-5">
        <div class="row">
            @foreach ($list as $p)
                <div class="col-3">
                    <img src="/uploads/galeria/thumbs/{{$p->file}}" alt="{{ $p->name }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection
