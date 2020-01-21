@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-book-open"></i> &nbsp;Przeglądaj punkty</h4>
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
                <table class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>#</th>
                        <th>Nazwa</th>
                        <th>Adres</th>
                        <th>Grupa</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->address }}</td>
                            <td>{{ $p->group_id }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.map.edit', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj punkt"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.map.delete', $p->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn action-button confirm" data-toggle="tooltip" data-placement="top" title="Usuń punkt" data-id="{{ $p->id }}"><i class="fe-trash-2"></i></button>
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
            <a href="{{route('admin.map.create')}}" class="btn btn-primary">Dodaj punkt</a>
        </div>
    </div>
@endsection
