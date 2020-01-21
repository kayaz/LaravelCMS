@extends('layouts.page')

@section('meta_title', 'Mapa')

@section('content')
    <div id="map"></div>

    <link href="/css/leaflet.css" rel="stylesheet">
    <script src="/js/leaflet.js" charset="utf-8"></script>

    <script type="text/javascript">
        let map = L.map('map').setView([52.227388, 21.011063], 13),
            theMarker = {},
            zoom = map.getZoom(),
            latLng = map.getCenter();

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let markers = [
            @foreach ($list as $p)
            [{{$p->lat}}, {{$p->lng}}, '{{$p->name}}'],
            @endforeach
        ],
            route = L.featureGroup().addTo(map),
            n = markers.length;

            for (let i = 0; i < n-1; i++) {
                let marker = new L.Marker(markers[i]).bindPopup(markers[i][2]);
                route.addLayer(marker);
            };
            route.addLayer(new L.Marker(markers[n-1]).bindPopup(markers[n-1][2]));
            map.fitBounds(route.getBounds());
    </script>
    <style>
        #pageheader {margin-bottom:0 !important;}
        main.pb-5 {padding-bottom:0 !important;}
    </style>
@endsection
