@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-book-open"></i> &nbsp;Przeglądaj wpisy</h4>
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
                    </div>
                @endif
                <table class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th>#</th>
                        <th>Tytuł</th>
                        <th>Miniaturka</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($lista as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <th class="position" scope="row">{{ $index+1 }}</th>
                            <td>{{ $p->nazwa }}</td>
                            <td><img src="<?php echo asset("uploads/news/adminthumbs/".$p->plik)?>" alt="{{ $p->nazwa }}"></td>
                            <td class="text-center">{{ $p->data }}</td>
                            <td class="text-center">{!! page_status($p->status) !!}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.news.edytuj', ['id' => $p->id])}}" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>
                                    <form method="POST" action="{{route('admin.news.usun', ['id' => $p->id])}}">
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
            <a href="{{route('admin.news.dodaj')}}" class="btn btn-primary">Dodaj wpis</a>
        </div>
    </div>
@endsection
