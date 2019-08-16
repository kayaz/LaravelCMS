@extends('layout')

@section('content')
@foreach ($wpis as $w)
    <h1><a href="{{route('news.pokazwpis', $w->tag )}}">{{ $w->tytul }}</a></h1>
    <span>{{ $w->data }}</span>
    <p>{{ $w->tekst }}</p>
    <div class="row">
        <div class="col-2">
            <form action="{{ route('news.usunwpis', $w->id)}}" method="post">@csrf @method('DELETE')<button class="btn btn-sm btn-danger" type="submit">Usuń wpis</button></form>
        </div>
        <div class="col-2">
            <a href="{{route('news.edytuj', $w->id)}}" class="btn btn-sm btn-success">Edytuj wpis</a>
        </div>
    </div>
    <hr>
@endforeach

<a href="{{route('news.nowywpis')}}" class="btn btn-primary">Dodaj wpis</a>
@endsection