<div class="card-header border-bottom">
    <nav class="nav">
        <a class="nav-link {{ Request::routeIs('admin.investments.edytuj') ? ' active' : '' }}" href="{{route('admin.investments.edytuj', ['investment' => $investment->id])}}"><span class="fe-info"></span> {{$investment->name}}</a>
        @if ($investment->typ == 2)
            <a class="nav-link {{ Request::routeIs('admin.investments.pietroindex') ? ' active' : '' }}" href="{{route('admin.investments.pietroindex', ['investment' => $investment->id])}}"><span class="fe-layers"></span> Lista kondygnacji</a>
        @else
            <a class="nav-link {{ Request::routeIs('admin.investments.budynekindex') ? ' active' : '' }}" href="{{route('admin.investments.budynekindex', ['investment' => $investment->id])}}"><span class="fe-package"></span> Lista budynków</a>
        @endif

        @if (Request::routeIs('admin.investments.roomindex'))
        <a class="nav-link {{ Request::routeIs('admin.investments.roomindex') ? ' active' : '' }}" href="{{route('admin.investments.roomindex', ['floor' => $floor->id])}}"><span class="fe-square"></span> Lista mieszkań</a>
        @endif

        <a class="nav-link {{ Request::routeIs('admin.investments.planindex') ? ' active' : '' }}" href="{{route('admin.investments.planindex', ['investment' => $investment->id])}}"><span class="fe-image"></span> Plan</a>
    </nav>
</div>
