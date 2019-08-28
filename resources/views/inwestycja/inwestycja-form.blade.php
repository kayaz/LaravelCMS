@extends('admin')
@section('content')
    @if(Route::is('admin.inwestycja.edytuj'))
        <form method="POST" action="{{route('admin.inwestycja.update', $wpis->id)}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
    @else
        <form method="POST" action="{{route('admin.inwestycja.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="container-fluid">
        <div class="card">
            @include('form-elements.card-header')
            <div class="card-body">
                <div class="row">
                    @include('form-elements.errors')
                    <div class="col-12">
                        @include('form-elements.select', ['label' => 'Typ inwestycji', 'name' => 'typ', 'selected' => $wpis->typ, 'options' => ['1' => 'Inwestycja osiedlowa', '2' => 'Inwestycja budynkowa', '3' => 'Inwestycja z domami']])
                        @include('form-elements.select', ['label' => 'Status inwestycji', 'name' => 'status', 'selected' => $wpis->status, 'options' => ['1' => 'Inwestycja w sprzedaży', '2' => 'Inwestycja zakończona']])
                        @include('form-elements.input-text', ['label' => 'Nazwa inwestycji', 'name' => 'nazwa', 'value' => $wpis->nazwa])
                        @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_tytul', 'value' => $wpis->meta_tytul])
                        @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_opis', 'value' => $wpis->meta_opis])
                        @include('form-elements.input-text', ['label' => 'E-mail', 'name' => 'email', 'value' => $wpis->email])
                        @include('form-elements.input-text', ['label' => 'Telefon', 'name' => 'telefon', 'value' => $wpis->telefon])
                        @include('form-elements.input-text', ['label' => 'Adres inwestycji', 'name' => 'adres', 'value' => $wpis->adres])
                        @include('form-elements.input-text', ['label' => 'Adres biura', 'name' => 'biuro', 'value' => $wpis->biuro])
                        @include('form-elements.input-file', ['label' => 'Logo inwestycji', 'sublabel' => '(wymiary: '.$logowidth.'px / '.$logoheight.'px)', 'name' => 'logo'])
                        @include('form-elements.input-file', ['label' => 'Miniaturka inwestycji', 'sublabel' => '(wymiary: '.$thumbwidth.'px / '.$thumbheight.'px)', 'name' => 'miniaturka'])
                        @include('form-elements.input-text', ['label' => 'Krótki opis', 'name' => 'lista', 'value' => $wpis->lista])
                        @include('form-elements.textarea', ['label' => 'Opis inwestycji', 'name' => 'tekst', 'value' => $wpis->tekst, 'rows' => 11, 'class' => 'tinymce'])

                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz inwestycje'])
    </div>
</form>
@include('form-elements.tintmce')
@endsection

