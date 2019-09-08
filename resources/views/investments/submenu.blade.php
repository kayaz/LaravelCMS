<div class="card-header border-bottom">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.investments.edytuj') ? ' active' : '' }}" href="{{route('admin.investments.edytuj', ['id' => $investment->id])}}"><span class="fe-info"></span> {{$investment->nazwa}}</a>
        @if ($investment->typ == 2)
            <a class="nav-link {{ Request::routeIs('admin.investments.pietroindex') ? ' active' : '' }}" href="{{route('admin.investments.pietroindex', ['id' => $investment->id])}}"><span class="fe-layers"></span> Lista kondygnacji</a>
        @else
            <a class="nav-link" href="#"><span class="fe-package"></span> Lista budynków</a>
        @endif

        @if (Request::routeIs('admin.investments.roomindex'))
        <a class="nav-link {{ Request::routeIs('admin.investments.roomindex') ? ' active' : '' }}" href="{{route('admin.investments.roomindex', ['id' => $floor->id])}}"><span class="fe-square"></span> Lista mieszkań</a>
        @endif

        <a class="nav-link {{ Request::routeIs('admin.investments.planindex') ? ' active' : '' }}" href="{{route('admin.investments.planindex', ['id' => $investment->id])}}"><span class="fe-image"></span> Plan</a>
    </nav>
</div>
