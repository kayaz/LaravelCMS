@extends('layouts.page')

@section('meta_title', 'Kontakt')

@section('content')
    <div id="googlemap" style="margin-top: -3rem !important;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d75026.40781200519!2d15.905379606234842!3d54.010314595600285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47004b08968ee9e5%3A0xa14442a5b3691f18!2s78-200+Bia%C5%82ogard!5e0!3m2!1spl!2spl!4v1565532183210!5m2!1spl!2spl" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div id="kontakt" class="container pt-5">
        <div class="row">
            <div class="col-7">
                <h2>Dane kontaktowe</h2>

                <h3>Biuro sprzedaży.</h3>
                <p>Telefon: 123 456 789</p>
                <p>E-mail: biuro@domena.pl</p>
                <p>Adres: Ulica 4A/11</p>
                <p>&nbsp;</p>
                <h3>Dział sprzedaży.</h3>
                <p>Telefon: 123 456 789</p>
                <p>E-mail: biuro@domena.pl</p>
                <p>Adres: Ulica 4A/11</p>
            </div>
            <div class="col-5 col-overmap">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success border-0">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning border-0">
                        {{ session('warning') }}
                    </div>
                @endif
                <form method="post" action="{{ route('front.kontakt.send') }}" class="validateForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12 col-input">
                            <label for="form_imie">Imię lub nazwa firmy</label>
                            <input name="imie" id="form_imie" class="validate[required]" class="validate[required]" type="text">
                        </div>
                        <div class="col-6 col-input mt-2">
                            <label for="form_email">E-mail</label>
                            <input name="email" id="form_email" class="validate[required]" type="text">
                        </div>
                        <div class="col-6 col-input mt-2">
                            <label for="form_telefon">Telefon</label>
                            <input name="telefon" id="form_telefon" class="validate[required]" type="text">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="form_wiadomosc">Treść wiadomości</label>
                            <textarea rows="1" cols="1" name="wiadomosc" id="form_wiadomosc"></textarea>
                        </div>
                        <div class="col-12 obowiazek">
                            <p>Na podstawie z art. 13 ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (Dz. Urz. UE L 119 z 04.05.2016) informujemy, iż przesyłając wiadomość za pomocą formularza kontaktowego wyrażacie Państwo zgodę na (<a href="" target="_blank">polityka informacyjna</a>):</p>
                        </div>

                        <div class="col-12 regulki">
                                @foreach ($rules as $r)
                                <label for="zgoda_{{$r->id}}" class="rules-text"><input name="zgoda_{{$r->id}}" id="zgoda_{{$r->id}}" value="1" type="checkbox" @if($r->required === 1) class="validate[required]" @endif data-prompt-position="topLeft:0"><p>{!! $r->text !!}</p></label>
                                @endforeach
                        </div>
                    </div>
                    <div class="row row-form-submit">
                        <div class="col-6"></div>
                        <div class="col-6 col-6-form-submit pt-4">
                            <div class="input text-right">
                                <script type="text/javascript">
                                    document.write("<button class=\"bttn\" type=\"submit\">WYŚLIJ</button>");
                                </script>
                                <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
