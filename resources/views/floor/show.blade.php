@extends('admin')
@section('content')
<div class="mappa">
    <div class="mappa-tool">
        <div class="mappa-workspace">
            <div id="overflow" style="overflow:auto;width:100%;">
                <canvas class="mappa-canvas"></canvas>
            </div>
            <div class="mappa-toolbars">
                <ul class="mappa-drawers none">
                    <li><input type="radio" name="tool" value="polygon" id="new" class="addPoint input_hidden"/><label for="new" class="actionBtn tip addPoint" title="Dodaj punkt">Dodaj punkt</label></li>
                </ul>
                <ul class="mappa-points none">
                    <li><input checked="checked" type="radio" name="tool" id="move" value="arrow" class="movePoint input_hidden"/><label for="move" class="actionBtn tip movePoint" title="Przesuń punkt">Przesuń / Zaznacz</label></li>
                    <li><input type="radio" name="tool" value="delete" id="delete" class="deletePoint input_hidden"/><label for="delete" class="actionBtn tip deletePoint" title="Usuń punkt">Usuń punkt</label></li>
                </ul>
                <ul class="mappa-list none"></ul>
                <ul class="mappa-points none">
                    <li><a href="#" id="toggleparam" class="actionBtn tip toggleParam">Pokaż / ukryj parametry</a></li>
                </ul>
            </div>
        </div>
    </div>

<script src="{{ URL::asset('js/plan/underscore.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/plan/backbone.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/plan/backbone-relational.js') }}" charset="utf-8"></script>
<script type="text/javascript">
    var map = {
        "name":"imagemap",
        "areas":[]
    };
</script>
<script src="{{ URL::asset('js/plan/mappa-backbone.js') }}" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {
        mapview = new MapView({el:'.mappa'}, map);
        mapview.loadImage('http://www.melia-apartamenty.pl/files/inwestycje/plan/przykladowa-inwestycja.jpg');
    });
</script>

<div class="col-12">
    <div class="form-group row"><label for="cords" class="col-2 col-form-label control-label">Współrzędne punktów</label><div class="col-10"><textarea class="form-control mappa-html" id="cords" name="cords" rows="10" ></textarea></div></div>
    <div class="form-group row"><label for="html" class="col-2 col-form-label control-label">Współrzędne punktów HTML</label><div class="col-10"><textarea class="form-control mappa-area" id="html" name="html" rows="10" ></textarea></div></div>
</div>
</div>
@endsection
