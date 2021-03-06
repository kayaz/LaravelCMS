@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-home"></i> <a href="{{route('admin.investments.index')}}">Inwestycje</a> / {{$investment->name}}: Lista budynków</h4>
    </div>
    <div class="container-fluid">
        <div class="card">

            @include('investments.submenu')

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
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Pokaż piętra"><i class="fe-folder"></i></a>
                                    <a href="{{route('admin.investments.budynekedytuj', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj budynek"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.investments.budynekusun', $p->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń piętro" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
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
            <a href="{{route('admin.investments.budynekdodaj', $investment->id)}}" class="btn btn-primary">Dodaj budynek</a>
        </div>
    </div>
@endsection
