@extends('admin')

@section('content')
    <form method="POST" action="{{route('admin.users.zapisz')}}" enctype="multipart/form-data">
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
                                    <label for="form_email" class="col-2 col-form-label control-label">Adres e-mail</label>
                                    <div class="col-10">
                                        <input id="form_email" value="{{ $wpis->email }}" class="form-control" name="email" type="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_nazwa" class="col-2 col-form-label control-label">Nazwa</label>
                                    <div class="col-10">
                                        <input id="form_nazwa" value="{{ $wpis->name }}" class="form-control" name="name" type="text" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_role" class="col-2 col-form-label control-label">Typ konta</label>
                                    <div class="col-10">
                                        <select id="form_role" class="form-control" name="role">
                                            <option value="admin"@if ($wpis->role == 'admin') selected @endif>Administrator</option>
                                            <option value="editor"@if ($wpis->role == 'editor') selected @endif>Redaktor</option>
                                            <option value="user"@if ($wpis->role == 'user') selected @endif>Użytkownik</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_haslo" class="col-2 col-form-label control-label">Hasło</label>
                                    <div class="col-10">
                                        <input id="form_haslo" class="form-control" name="password" type="password" required autocomplete="nowe-haslo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form_haslo2" class="col-2 col-form-label control-label">Powtórz hasło</label>
                                    <div class="col-10">
                                        <input id="form_haslo2" class="form-control" name="password_confirmation" type="password" required autocomplete="nowe-haslo">
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
