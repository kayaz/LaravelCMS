@extends('admin')
@section('content')
    @if(Route::is('admin.rodo.edytuj'))
        <form method="POST" action="{{route('admin.rodo.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.rodo.zapisz')}}" enctype="multipart/form-data">
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
                                        @include('form-elements.select', ['label' => 'Wymagane', 'name' => 'required', 'selected' => $entry->required, 'options' => ['1' => 'Tak', '2' => 'Nie']])
                                        @include('form-elements.input-text', ['label' => 'Nazwa regułki', 'name' => 'title', 'value' => $entry->title])
                                        @include('form-elements.input-text', ['label' => 'Czas trwania regułki', 'name' => 'time', 'value' => $entry->time])
                                        @include('form-elements.textarea', ['label' => 'Treść regułki', 'name' => 'text', 'value' => $entry->text, 'rows' => 11, 'class' => 'tinymce'])

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @include('form-elements.tintmce')
@endsection
