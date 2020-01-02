@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-file-text"></i> &nbsp;Menu strony</h4>
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
                                <th>Nazwa</th>
                                <th>URI</th>
                                <th>Typ</th>
                                <th class="text-center">Data modyfikacji</th>
                                <th class="text-center">Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php recursive(App\Menu::renderAsArray()); ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit row">
        <div class="col-12">
            <a href="{{route('admin.menu.dodaj')}}" class="btn btn-primary">Dodaj stronę</a>
            <a href="{{route('admin.menu.dodaj')}}" class="btn btn-primary">Dodaj link</a>
        </div>
    </div>
@endsection
