@extends('admin')

@section('content')
    @if(Route::is('admin.menu.edytuj'))
        <form method="POST" action="{{route('admin.menu.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.menu.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
        <div class="container-fluid">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        @include('form-elements.errors')
                        <div class="col-12">
                            @include('form-elements.select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->menu, 'options' => ['1' => 'Pokaż w menu', '2' => 'Ukryj w menu']])
                            @include('form-elements.select', ['label' => 'Podstrona', 'name' => 'status', 'selected' => $entry->id_parent, 'options' => ['0' => 'Brak']])
                            @include('form-elements.input-text', ['label' => 'Tytuł strony', 'name' => 'nazwa', 'value' => $entry->nazwa])
                            @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_tytul', 'value' => $entry->meta_tytul])
                            @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_opis', 'value' => $entry->meta_opis])
                            @include('form-elements.textarea', ['label' => 'Wprowadź tekst', 'name' => 'tekst', 'value' => $entry->tekst, 'rows' => 11, 'class' => 'tinymce'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
        @include('form-elements.tintmce')
@endsection
