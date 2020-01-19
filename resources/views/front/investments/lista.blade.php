@extends('layouts.page')

@section('meta_title', 'Inwestycje')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($list as $p)
                <div class="col-6">
                    <a href="{{route('front.inwestycja', $p->slug)}}" itemprop="url"><div class="card">
                        <img src="/inwestycje/thumbs/{{$p->thumb}}" alt="{{ $p->name }}">
                        <div class="card-body">
                            <img src="/inwestycje/logo/{{$p->logo}}" alt="{{ $p->name }}">
                            <h1 class="card-title">{{$p->name}}</h1>
                            <p>{{$p->content_list}}</p>
                        </div>
                    </div></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
