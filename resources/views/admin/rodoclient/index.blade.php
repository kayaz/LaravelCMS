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
                        <th>Nazwa</th>
                        <th>Adres e-mail</th>
                        <th>Data dodania</th>
                        <th>Data aktualizacji</th>
                        <th>IP</th>
                        <th>Host</th>
                        <th class="position"></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $index => $p)
                        <tr id="recordsArray_{{ $p->id }}">
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->mail }}</td>
                            <td>{{ $p->created_at }}</td>
                            <td>{{ $p->updated_at }}</td>
                            <td>{{ $p->ip }}</td>
                            <td>{{ $p->host }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="btn action-button mr-1" data-toggle="tooltip" data-placement="top" title="Pokaż historię"><i class="fe-inbox"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
