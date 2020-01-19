@extends('admin')
@section('content')
    @if(Route::is('admin.news.edytuj'))
        <form method="POST" action="{{route('admin.news.update', $entry->id)}}" enctype="multipart/form-data">
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
                            @include('form-elements.select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'options' => ['1' => 'Pokaż na liście', '2' => 'Ukryj na liście']])
                            @include('form-elements.input-text', ['label' => 'Tytuł wpisu', 'name' => 'title', 'value' => $entry->title])
                            @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                            @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
                            @include('form-elements.input-text', ['label' => 'Data', 'name' => 'date', 'value' => $entry->date])
                            @include('form-elements.input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.$thumbwidth.'px / '.$thumbheight.'px)', 'name' => 'file'])
                            @include('form-elements.input-text', ['label' => 'Wprowadzenie', 'name' => 'content_entry', 'value' => $entry->content_entry])
                            @include('form-elements.textarea', ['label' => 'Wprowadź tekst', 'name' => 'content', 'value' => $entry->content, 'rows' => 11, 'class' => 'tinymce'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
</form>
@include('form-elements.tintmce')
@endsection
