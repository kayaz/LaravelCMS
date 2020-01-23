@extends('layouts.page')

@section('meta_title', 'Inwestycja - '.$investment->name.' - '.$floor->name)

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-4"></div>
            <div class="col-4"><a href="{{route('front.inwestycja', $investment->slug)}}" title="" class="bttn">PLAN BUDYNKU</a></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="plan">
                    <div id="plan-holder"><img src="/inwestycje/pietro/{{$floor->file}}" alt="{{$floor->name}}" id="invesmentplan" usemap="#invesmentplan"></div>
                    <map name="invesmentplan">
                        @foreach($rooms as $r)
                            <area shape="poly" href="{{route('front.inwestycja.mieszkanie', ['slug' => $investment->slug, 'floorslug' => $floor->slug, 'roomslug' => $r->slug])}}" data-item="{{$r->id}}" title="{{$r->name}}" alt="{{$r->slug}}" data-roomnumber="{{$r->number}}" data-roomtype="{{$r->typ}}" data-roomstatus="{{$r->status}}" coords="@if($r->html) {{cords($r->html)}} @endif">
                        @endforeach
                    </map>
                </div>
            </div>
        </div>

        <div class="list-sort mt-4">
            <form method="GET" action="{{url()->current()}}" class="row">
                <div class="col-3">
                    <select name="orderRooms" value="{{$orderByRooms}}" onchange="this.form.submit()">
                        @foreach([['name' => 'Pokoje rosnąco', 'order' => 'asc'], ['name' => 'Pokoje malejąco', 'order' => 'desc']] as $order)
                            <option @if($order['order'] == $orderByRooms) selected @endif value="{{$order['order']}}">{{ucfirst($order['name'])}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select name="orderArea" value="{{$orderByArea}}" onchange="this.form.submit()">
                        @foreach([['name' => 'Powierzchnia rosnąco', 'order' => 'asc'], ['name' => 'Powierzchnia malejąco', 'order' => 'desc']] as $order)
                            <option @if($order['order'] == $orderByArea) selected @endif value="{{$order['order']}}">{{ucfirst($order['name'])}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <div class="view">
                        <span id="grid">Mała lista</span>
                        <span id="list">Duża lista</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="offerList" class="container">
                    @foreach($rooms as $r)
                    <div class="row pozycja-ap">
                        <div class="col-2 d-flex align-items-center">
                            <h2>{{$r->name}}</h2>
                        </div>
                        <div class="col-2 col-room-thumb">
                            <img src="/inwestycje/mieszkanie/lista/{{$r->file}}" alt="{{$r->name}}">
                        </div>
                        <div class="col-3 paramlist d-flex align-items-center">
                            <ul class="list-unstyled biglist mb-0">
                                <li>pokoje: <span>{{$r->rooms}}</span></li>
                                <li>powierzchnia: <span>{{$r->area}}&nbsp; m<sup>2</sup></span></li>
                            </ul>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <div class=""><span class="room-list-status-{{ $r->status }}">{{ room_status($r->status) }}</span></div>
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-end">
                            <a href="{{route('front.inwestycja.mieszkanie', [
                            'slug' => $investment->slug,
                            'floorslug' => $floor->slug,
                            'roomslug' => $r->slug]
                            )}}" class="bttn"><span>ZOBACZ</span></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
