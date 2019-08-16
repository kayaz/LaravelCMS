@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-sliders"></i> &nbsp;Ustawienia</h4>
    </div>
        <form method="POST" action="{{route('admin.ustawienia.update')}}">
        @method('PUT')
        @csrf
        <div class="container-fluid">
            <div class="card">

                @include('admin.subsettings')

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success border-0">
                                    {{ session('success') }}
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
                                <label class="col-2 col-form-label control-label">Nazwa strony<br><span>Meta tag - title</span></label>
                                <div class="col-10">
                                    <input value="{{ settings('meta_title') }}" class="form-control" name="meta_nazwa_strony" placeholder="(Title) tytuł strony wyświetlany na pasku w przeglądarce" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label control-label">Opis strony<br><span>Meta tag - description</span></label>
                                <div class="col-10">
                                    <input value="{{ settings('meta_description') }}" class="form-control" name="meta_opis_strony" placeholder="(Description) krótki opis strony który pojawi się w wyszukiwarce" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label control-label">Adres strony</label>
                                <div class="col-10">
                                    <input value="{{ settings('page_url') }}" class="form-control" name="adres_strony" placeholder="Adres strony zaczynający się od http:// np. http://wwww.mojastrona.pl" type="text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="row">
                            <div class="col-12">
                                Podgląd wyszukiwarki Google
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-2 col-form-label control-label">&nbsp;</div>
                                <div class="col-10" style="line-height: normal">
                                    <h3 style="font-family: arial,sans-serif;font-size:18px;line-height: 1.2;margin:0;font-weight: normal;color:#1a0dab;">{{ settings('meta_nazwa_strony') }}</h3>
                                    <div style="line-height: 14px"><cite style="font-size:14px;line-height: 16px;color: #006621;font-style: normal;font-family: arial,sans-serif">{{ settings('adres_strony') }}</cite></div>
                                    <span style="font-family: arial,sans-serif;font-size:13px;line-height:18px;color: #545454">{{ settings('meta_opis_strony') }}</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label control-label">Autor strony<br><span>Meta tag - robots
</span></label>
                                <div class="col-10">
                                    <input value="{{ settings('author') }}" class="form-control" name="autor" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label control-label">Adres e-mail<br><span>Skrzynka pocztowa na którą będą wysyłane wiadmości z formularza</span></label>
                                <div class="col-10">
                                    <input value="{{ settings('email') }}" class="form-control" name="email" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label control-label">Indeksowanie<br><span>Meta tag - robots</span></label>
                                <div class="col-10">
                                <?php $cos = settings('robots'); ?>
                                    <select id="robots" class="form-control" name="indeksowanie_strony">
                                        <option value="noindex, nofollow"<?php if($cos == 'noindex, nofollow'){?> selected<?php } ?>>noindex, nofollow</option>
                                        <option value="index, follow"<?php if($cos == 'index, follow'){?> selected<?php } ?>>index, follow</option>
                                        <option value="index, nofollow"<?php if($cos == 'index, nofollow'){?> selected<?php } ?>>index, nofollow</option>
                                        <option value="noindex, follow"<?php if($cos == 'noindex, follow'){?> selected<?php } ?>>noindex, follow</option>
                                    </select>
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
