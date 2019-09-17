@extends('layouts.page')

@section('meta_title', 'Inwestycja - '.$investment->nazwa.' - '.$floor->nazwa.' - '.$room->nazwa)

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-4"></div>
            <div class="col-4"><a href="{{route('front.inwestycja.pietro', ['slug' => $investment->slug, 'floor' => $floor->slug])}}" title="" class="bttn">PLAN PIĘTRA</a></div>
            <div class="col-4"></div>
        </div>
        <div class="row">
            <div class="col-3">
                <h2>{{$room->nazwa}}</h2>
                <span class="room-list-status-{{ $room->status }}">{{ room_status($room->status) }}</span>
                <ul class="list-unstyled room-param mt-5">
                    @if($room->pokoje)<li>Pokoje<span>{{$room->pokoje}}</span></li>@endif
                    @if($room->metry)<li>Powierzchnia<span>{{$room->metry}} m<sup>2</sup></span></li>@endif
                    @if($room->cena)<li>Cena<span>{{$room->cena}}</span></li>@endif
                </ul>
                @if($room->pdf)
                    <a href="{{ URL::asset('inwestycje/mieszkanie/pdf/'.$room->pdf) }}" target="_blank">Pobierz kartę .pdf</a>
                @endif
            </div>
            <div class="col-4">
                @if($room->plik)<img src="{{ URL::asset('inwestycje/mieszkanie/thumbs/'.$room->plik) }}" alt="{{$room->nazwa}}">@endif
            </div>
            <div class="col-5">
                <h2>Zapytaj o mieszkanie</h2>
                <hr>
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
                <form method="post" action="#" class="validateForm">
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
                            <label for="zgoda_1" class="rules-text"><input name="zgoda_1" id="zgoda_1" value="1" type="checkbox"><p>Na otrzymywanie ofert  handlowych  drogą elektroniczną od firmy ....., na podany przez Państwo adres e-mail</p></label>
                            <label for="zgoda_1" class="rules-text"><input name="zgoda_1" id="zgoda_1" value="1" type="checkbox"><p>Na otrzymywanie ofert  handlowych  drogą elektroniczną od firmy ....., na podany przez Państwo adres e-mail</p></label>
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
