<div id="slider" class="container pt-5 pb-5">
    <div class="row">
        <ul class="textSlider list-unstyled mb-0">
    @foreach ($list as $p)
        <li><img src="/uploads/galeria/{{$p->file}}" alt="{{ $p->name }}"></li>
    @endforeach
    </ul>
    </div>
</div>
