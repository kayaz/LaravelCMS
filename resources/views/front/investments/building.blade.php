@extends('layouts.page')

@section('meta_title', 'Inwestycja - '.$investment->name.' - '.$building->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($building->file)
                    <div id="plan">
                        <div id="plan-holder"><img src="/inwestycje/budynek/{{$building->file}}" alt="{{$building->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                        <map name="invesmentplan">

                        </map>

                        <div class="plan-control">

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
