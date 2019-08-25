@extends('admin')
@section('content')
    @if(Route::is('admin.news.edytuj'))
        <form method="POST" action="{{route('admin.news.update', $wpis->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.news.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="container-fluid">
        <div class="card">
            @include('form-elements.card-header')
            <div class="card-body">
                <div class="row">
                    @include('form-elements.errors')
                    <div class="col-12">
                        @include('form-elements.select', ['label' => 'Status', 'name' => 'status', 'selected' => $wpis->status, 'options' => ['1' => 'Pokaż na liście', '2' => 'Ukryj na liście']])
                        @include('form-elements.input-text', ['label' => 'Tytuł wpisu', 'name' => 'nazwa', 'value' => $wpis->nazwa])
                        @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_tytul', 'value' => $wpis->meta_tytul])
                        @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_opis', 'value' => $wpis->meta_opis])
                        @include('form-elements.input-text', ['label' => 'Data', 'name' => 'data', 'value' => $wpis->data])
                        @include('form-elements.input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.$thumbwidth.'px / '.$thumbheight.'px)', 'name' => 'plik'])
                        @include('form-elements.input-text', ['label' => 'Wprowadzenie', 'name' => 'wprowadzenie', 'value' => $wpis->wprowadzenie])
                        @include('form-elements.textarea', ['label' => 'Wprowadź tekst', 'name' => 'tekst', 'value' => $wpis->tekst, 'rows' => 11, 'class' => 'tinymce'])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@include('form-elements.tintmce')
@endsection

