@extends('layouts.page')

@section('meta_title', 'Inwestycja - '.$investment->nazwa.' - '.$floor->nazwa)

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-4"></div>
            <div class="col-4"><a href="{{route('front.inwestycja', ['slug' => $investment->slug])}}" title="" class="bttn">PLAN BUDYNKU</a></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="plan">
                    <div id="plan-holder"><img src="{{ URL::asset('inwestycje/pietro/'.$floor->plik) }}" alt="{{$floor->nazwa}}" id="invesmentplan" usemap="#invesmentplan"></div>
                    <map name="invesmentplan">
                        @foreach($rooms as $r)
                            <area shape="poly" href="{{route('front.inwestycja.mieszkanie', ['slug' => $investment->slug, 'floorslug' => $floor->slug, 'roomslug' => $r->slug])}}" data-item="{{$r->id}}" title="{{$r->nazwa}}" alt="{{$r->slug}}" data-roomnumber="{{$r->numer}}" data-roomtype="{{$r->typ}}" data-roomstatus="{{$r->status}}" coords="{{cords($r->html)}}">
                        @endforeach
                    </map>
                </div>
            </div>
        </div>
    </div>
@endsection
