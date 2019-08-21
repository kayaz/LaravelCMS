@extends('admin')

@section('content')
    @if(Route::is('admin.boksy.edytuj'))
        <form method="POST" action="{{route('admin.boksy.update', $wpis->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.boksy.zapisz')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{ $cardtitle }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="form_nazwa" class="col-2 col-form-label control-label">Nazwa</label>
                                            <div class="col-10">
                                                <input id="form_nazwa" value="{{ $wpis->nazwa }}" class="form-control" name="nazwa" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="form_nazwa" class="col-2 col-form-label control-label">Tekst</label>
                                            <div class="col-10">
                                                <input id="form_tekst" value="{{ $wpis->tekst }}" class="form-control" name="tekst" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="form_link" class="col-2 col-form-label control-label">Link</label>
                                            <div class="col-10">
                                                <input id="form_link" value="{{ $wpis->link }}" class="form-control" name="link" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="form_plik" class="col-2 col-form-label control-label">Plik</label>
                                            <div class="col-10">
                                                <input id="form_plik" class="form-control-file" name="plik" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-submit row">
                        <div class="col-12">
                            <input name="submitUstawienia" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
                        </div>
                    </div>
                </form>
@endsection
