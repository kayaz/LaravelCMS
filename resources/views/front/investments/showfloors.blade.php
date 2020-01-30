@extends('layouts.page')

@section('meta_title', 'Inwestycja - '.$investment->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($investment->plan)
                <div id="plan">
                    <div id="plan-holder"><img src="/inwestycje/plan/{{$investment->plan}}" alt="{{$investment->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                    <map name="invesmentplan">
                        @foreach($floor as $f)
                        <area shape="poly" href="{{route('front.inwestycja.pietro', ['slug' => $investment->slug, 'floorslug' => $f->slug])}}" data-item="{{$f->id}}" title="{{$f->name}}" alt="{{$f->slug}}" data-floornumber="{{$f->number}}" data-floortype="{{$f->typ}}" coords="{{cords($f->html)}}">
                        @endforeach
                    </map>

                    <div class="plan-control">
                        @foreach($floor as $f)
                        <a data-item="{{$f->id}}" href="{{route('front.inwestycja.pietro', ['slug' => $investment->slug, 'floorslug' => $f->slug])}}" class="clearfix" data-tag="{{$f->slug}}" data-floornumber="{{$f->numer}}" data-floortype="{{$f->typ}}" title="{{$f->name}}"><span>{{$f->number}}</span></a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
