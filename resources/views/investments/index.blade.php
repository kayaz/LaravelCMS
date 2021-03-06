@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-home"></i> &nbsp;Przeglądaj inwestycje</h4>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-form">
                <form class="form-inline">
                    <input type="text" class="form-control" id="filter" placeholder="Szukaj na liście">
                </form>
            </div>
            <div class="table-overflow">
                @if (session('success'))
                    <div class="alert alert-success border-0 mb-0">
                        {{ session('success') }}
                        <script>window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},3000);</script>
                    </div>
                @endif
                <table class="table mb-0" id="sortable">
                    <thead class="thead-default">
                    <tr>
                        <th>#</th>
                        <th>Nazwa</th>
                        <th>Status</th>
                        <th>Typ</th>
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>
                                @if ($p->typ == 2)
                                    <a href="{{route('admin.investments.pietroindex', $p->id)}}">{{ $p->name }}</a>
                                @else
                                    <a href="{{route('admin.investments.budynekindex', $p->id)}}">{{ $p->name }}</a>
                                @endif
                            </td>
                            <td><span class="inwest-list-status-{{ $p->status }}">{{ inwest_status($p->status) }}</span></td>
                            <td>{{ inwest_typ($p->typ) }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.investments.planindex', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Plan inwestycji"><i class="fe-image"></i></a>
                                    @if ($p->typ == 2)
                                    <a href="{{route('admin.investments.pietroindex', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Lista kondygnacji"><i class="fe-layers"></i></a>
                                    @else
                                    <a href="{{route('admin.investments.budynekindex', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Lista budynków"><i class="fe-package"></i></a>
                                    @endif

                                    <a href="{{route('admin.investments.edytuj', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.investments.usun', ['investment' => $p->id])}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń wpis" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit row">
        <div class="col-12">
            <a href="{{route('admin.investments.dodaj')}}" class="btn btn-primary">Dodaj inwestycje</a>
        </div>
    </div>
@endsection
