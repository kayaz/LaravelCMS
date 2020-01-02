<div class="card-header border-bottom">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.rodo.index') ? ' active' : '' }}" href="{{route('admin.rodo.index')}}"><span class="fe-list"></span> Lista regułek</a>
        <a class="nav-link {{ Request::routeIs('admin.rodoclient.index') ? ' active' : '' }}" href="{{route('admin.rodoclient.index')}}"><span class="fe-list"></span> Lista klientów</a>
        <a class="nav-link" href="#"><span class="fe-settings"></span> Ustawienia</a>
    </nav>
</div>
