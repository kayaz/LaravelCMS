@extends('admin')
@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-home"></i> <a href="{{route('admin.investments.index')}}">Inwestycje</a> / {{$investment->nazwa}} / <a href="{{route('admin.investments.roomindex', ['id' => $floor->id])}}">{{$floor->nazwa}}</a></h4>
    </div>

    <script src="{{ URL::asset('js/plan/underscore.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        var map = {
            "name":"imagemap",
            "areas":[{!! $entry->cords !!}]
        };
    </script>
    <script src="{{ URL::asset('js/plan/mappa-backbone.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            mapview = new MapView({el:'.mappa'}, map);
            mapview.loadImage('{{ URL::asset('inwestycje/pietro/'.$floor->plik) }}');
        });
    </script>
    @if(Route::is('admin.investments.roomedytuj'))
        <form method="POST" action="{{route('admin.investments.roomupdate', ['room' => $entry->id])}}" enctype="multipart/form-data" class="mappa">
            {{method_field('PUT')}}
    @else
        <form method="POST" action="{{route('admin.investments.roomzapisz', $floor->id)}}" enctype="multipart/form-data" class="mappa">
    @endif
    @csrf
            <div class="container-fluid">
                <div class="card">
                    @include('form-elements.card-header')
                    <div class="card-body">
                        <div class="mappa-tool">
                            <div class="mappa-workspace">
                                <div id="overflow" style="overflow:auto;width:100%;">
                                    <canvas class="mappa-canvas"></canvas>
                                </div>
                                <div class="mappa-toolbars">
                                    <ul class="mappa-drawers list-unstyled mb-0">
                                        <li><input type="radio" name="tool" value="polygon" id="new" class="addPoint input_hidden"/><label for="new" data-toggle="tooltip" data-placement="top" class="actionBtn tip addPoint" title="Służy do dodawanie nowego elementu"><i class="fe-edit-2"></i> Dodaj punkt</label></li>
                                    </ul>
                                    <ul class="mappa-points list-unstyled mb-0">
                                        <li><input checked="checked" type="radio" name="tool" id="move" value="arrow" class="movePoint input_hidden"/><label for="move" class="actionBtn tip movePoint" data-toggle="tooltip" data-placement="top" title="Służy do przesuwania punktów"><i class="fe-move"></i> Przesuń / Zaznacz</label></li>
                                        <li><input type="radio" name="tool" value="delete" id="delete" class="deletePoint input_hidden"/><label for="delete" class="actionBtn tip deletePoint" data-toggle="tooltip" data-placement="top" title="Służy do usuwana punków"><i class="fe-trash-2"></i> Usuń punkt</label></li>
                                    </ul>
                                    <ul class="mappa-list list-unstyled mb-0"></ul>
                                    <ul class="mappa-points list-unstyled mb-0">
                                        <li><a href="#" id="toggleparam" class="actionBtn tip toggleParam" data-toggle="tooltip" data-placement="top" title="Służy do pokazywania/ukrywania parametrów"><i class="fe-repeat"></i> Pokaż / ukryj parametry</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @include('form-elements.errors')
                            <div class="col-12">
                                <div class="toggleRow">
                                    @include('form-elements.mappa', ['label' => 'Współrzędne punktów', 'name' => 'cords', 'value' => $entry->cords, 'rows' => 10, 'class' => 'mappa-html'])
                                    @include('form-elements.mappa', ['label' => 'Współrzędne punktów HTML', 'name' => 'html', 'value' => $entry->html, 'rows' => 10, 'class' => 'mappa-area'])
                                </div>

                                @include('form-elements.select', ['label' => 'Status mieszkania', 'name' => 'status', 'selected' => $entry->status, 'options' =>
                                [
                                    '1' => 'Na sprzedaż',
                                    '2' => 'Sprzedane',
                                    '3' => 'Rezerwacja',
                                    '4' => 'Wynajęte'
                                ]])

                                @include('form-elements.input-text', ['label' => 'Nazwa mieszkania', 'name' => 'nazwa', 'value' => $entry->nazwa])
                                @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_tytul', 'value' => $entry->meta_tytul])
                                @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_opis', 'value' => $entry->meta_opis])

                                @include('form-elements.input-text', ['label' => 'Pokoje', 'name' => 'pokoje', 'value' => $entry->pokoje])
                                @include('form-elements.input-text', ['label' => 'Powierzchnia bez m<sup>2</sup>', 'sublabel'=> 'wartość wyświetlana', 'name' => 'metry', 'value' => $entry->metry])
                                @include('form-elements.input-text', ['label' => 'Powierzchnia bez m<sup>2</sup>', 'sublabel'=> 'wartość wyszukiwana', 'name' => 'szukaj_metry', 'value' => $entry->szukaj_metry])

                                @include('form-elements.input-text', ['label' => 'Cena', 'sublabel'=> 'wartość wyświetlana', 'name' => 'cena', 'value' => $entry->cena])
                                @include('form-elements.input-text', ['label' => 'Cena', 'sublabel'=> 'wartość wyszukiwana: tylko liczby, bez spacji, bez przecinka', 'name' => 'szukaj_cena', 'value' => $entry->szukaj_cena])
                                @include('form-elements.input-text', ['label' => 'Cena za m<sup>2</sup>', 'sublabel'=> 'wartość wyświetlana', 'name' => 'cena_m', 'value' => $entry->cena_m])

                                @include('form-elements.input-file', ['label' => 'Plan mieszkania', 'name' => 'plik'])
                                @include('form-elements.input-file', ['label' => 'Plik .pdf', 'name' => 'plikpdf'])


                            </div>
                        </div>
                    </div>
                </div>
                @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz mieszkanie'])
            </div>
        </form>
@endsection
