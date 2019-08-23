@extends('layouts.page')

@section('meta_title', 'Inwestycje')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($lista as $p)
                <div class="col-6">
                    <a href="#" itemprop="url"><div class="card">
                        <img src="{{asset('inwestycje/thumbs/'.$p->miniaturka) }}" alt="{{ $p->nazwa }}">
                        <div class="card-body">
                            <img src="{{asset('inwestycje/logo/'.$p->logo) }}" alt="{{ $p->nazwa }}">
                            <h1 class="card-title">{{$p->nazwa}}</h1>
                            <p>{{$p->lista}}</p>
                        </div>
                    </div></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
