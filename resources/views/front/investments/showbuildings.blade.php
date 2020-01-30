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
                            @foreach($building as $b)
                                <area shape="poly" href="{{route('front.inwestycja.budynek', ['slug' => $investment->slug, 'buildingslug' => $b->slug])}}" data-item="{{$b->id}}" title="{{$b->name}}" alt="{{$b->slug}}" data-floornumber="{{$b->number}}" data-floortype="{{$b->typ}}" coords="{{cords($b->html)}}">
                            @endforeach
                        </map>

                        <div class="plan-control">
                            @foreach($building as $b)
                                <a data-item="{{$b->id}}" href="{{route('front.inwestycja.budynek', ['slug' => $investment->slug, 'buildingslug' => $b->slug])}}" class="clearfix" data-tag="{{$b->slug}}" data-floornumber="{{$b->numer}}" data-floortype="{{$b->typ}}" title="{{$b->name}}"><span>{{$b->number}}</span></a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
