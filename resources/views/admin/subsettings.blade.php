<div class="card-header border-bottom">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.ustawienia.index') ? ' active' : '' }}{{ Request::routeIs('admin.ustawienia.dashboard') ? ' active' : '' }}" href="{{route('admin.ustawienia.index')}}"><span class="fe-settings"></span> Główne ustawienia strony</a>
        <a class="nav-link {{ Request::routeIs('admin.ustawienia.social') ? ' active' : '' }}" href="{{route('admin.ustawienia.social')}}"><span class="fe-list"></span> Portale społecznościowe</a>
        <a class="nav-link" href="#"><span class="fe-map-pin"></span> Kontakt i mapa</a>
        <a class="nav-link" href="#"><span class="fe-database"></span> Kopia bazy</a>
        <a class="nav-link" href="#"><span class="fe-upload"></span> Baner na start</a>
        <a class="nav-link" href="#"><span class="fe-download"></span> Baner na wyjście</a>
    </nav>
</div>
