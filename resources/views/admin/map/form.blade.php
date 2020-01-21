@extends('admin')

@section('content')
    @if(Route::is('admin.map.edit'))
        <form method="POST" action="{{route('admin.map.update', $entry->id)}}">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.map.store')}}">
                    @endif
                    @csrf
                    <div class="container-fluid">
                        <div id="map"></div>
                        <div class="card">
                            @include('form-elements.card-header')
                            <div class="card-body">
                                <div class="row">
                                    @include('form-elements.errors')
                                    <div class="col-12">
                                        @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name])
                                        @include('form-elements.select', [
                                        'label' => 'Grupa',
                                        'name' => 'group_id',
                                        'selected' => $entry->group_id,
                                        'options' => [
                                            '1' => 'Inwestycja',
                                            '2' => 'Sklep',
                                            '3' => 'Parking',
                                            '4' => 'Park',
                                            '5' => 'Szkoła'
                                        ]])
                                        @include('form-elements.input-text', ['label' => 'Szerokość geograficzna', 'name' => 'lat', 'value' => $entry->lat])
                                        @include('form-elements.input-text', ['label' => 'Długość geograficzna', 'name' => 'lng', 'value' => $entry->lng])
                                        @include('form-elements.input-text', ['label' => 'Zoom', 'name' => 'zoom', 'value' => $entry->zoom])
                                        @include('form-elements.input-text', ['label' => 'Adres', 'name' => 'address', 'value' => $entry->address])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
                <link href="/css/leaflet.css" rel="stylesheet">
                <script src="/js/leaflet.js" charset="utf-8"></script>
                <script>
                    function setOnLoad($lat, $lng, $zoom){
                        $('input[name="zoom"]').val($zoom);
                        $('input[name="lat"]').val($lat);
                        $('input[name="lng"]').val($lng);
                        map.setView([$lat, $lng], $zoom);
                    }

                    function loadInputs($lat, $lng){
                        $('input[name="lat"]').val($lat);
                        $('input[name="lng"]').val($lng);
                    }

                    function setZoom($zoom){
                        $('input[name="zoom"]').val($zoom);
                    }

                    let map = L.map('map').setView([52.227388, 21.011063], 13),
                        theMarker = {},
                        zoom = map.getZoom(),
                        latLng = map.getCenter();

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    @if($entry->lat && $entry->lng && $entry->zoom)
                    setOnLoad('{{ $entry->lat }}', '{{ $entry->lng }}', '{{ $entry->zoom }}');
                    theMarker = L.marker([
                        '{{ $entry->lat }}',
                        '{{ $entry->lng }}'
                    ], {
                        draggable:'true'
                    }).addTo(map);
                    @else
                    setOnLoad(latLng.lat, latLng.lng, zoom);
                    @endif

                    map.on('zoomend', function() {
                        setZoom(map.getZoom());
                    });

                    map.on('click', function(e) {
                        let lat = e.latlng.lat,
                            lng = e.latlng.lng;

                        loadInputs(lat, lng);

                        if (theMarker != undefined) {
                            map.removeLayer(theMarker);
                        }
                        theMarker = L.marker([lat, lng], {
                            draggable:'true'
                        }).addTo(map);
                    });

                    theMarker.on('dragend', function() {
                        let position = theMarker.getLatLng();
                        theMarker.setLatLng(position, {
                            draggable: 'true'
                        });
                        loadInputs(position.lat, position.lng);
                    });
                </script>
@endsection
