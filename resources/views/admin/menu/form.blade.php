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
                            @include('form-elements.select', ['label' => 'Status', 'name' => 'menu', 'selected' => $entry->menu, 'options' => ['1' => 'Pokaż w menu', '2' => 'Ukryj w menu']])
                            @include('form-elements.select', [
                                'label' => 'Podstrona',
                                'name' => 'parent_id',
                                'selected' => $entry->parent_id,
                                'options' => $selectMenu
                            ])
                            @include('form-elements.input-text', ['label' => 'Tytuł strony', 'name' => 'title', 'value' => $entry->title])
                            @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $entry->meta_title])
                            @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $entry->meta_description])
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
