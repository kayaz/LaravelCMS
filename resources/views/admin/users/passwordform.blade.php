@extends('admin')

@section('content')
    <form method="POST" action="{{route('admin.users.updatepass', $entry->id)}}">
        @method('PUT')
        @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ $cardtitle }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
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
                                <label for="form_oldpassword" class="col-2 col-form-label control-label">Stare hasło</label>
                                <div class="col-10">
                                    <input id="form_oldpassword" class="form-control" name="oldpassword" type="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form_haslo" class="col-2 col-form-label control-label">Nowe Hasło</label>
                                <div class="col-10">
                                    <input id="form_haslo" class="form-control" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form_haslo2" class="col-2 col-form-label control-label">Powtórz nowe hasło</label>
                                <div class="col-10">
                                    <input id="form_haslo2" class="form-control" name="password_confirmation" type="password" required>
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
