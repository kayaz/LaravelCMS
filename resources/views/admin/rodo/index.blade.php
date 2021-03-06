@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-hard-drive"></i> &nbsp;RODO</h4>
    </div>

    <div class="container-fluid">
        <div class="card">
            @include('admin.subrodo')
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
                        <th>Tytuł regułki</th>
                        <th>Data dodania</th>
                        <th>Data edycji</th>
                        <th>Czas trwania</th>
                        <th class="text-center">Wymagana</th>
                        <th class="text-center">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td>{{ $p->time }}</td>
                            <td class="text-center">{!! page_status($p->required) !!}</td>
                            <td class="text-center">{!! page_status($p->status) !!}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.rodo.edytuj', $p->id)}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.rodo.usun', $p->id)}}">
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
            <a href="{{route('admin.rodo.dodaj')}}" class="btn btn-primary">Dodaj regułkę</a>
        </div>
    </div>
@endsection
