@extends('admin')
@section('content')
    @if(Route::is('admin.boxes.edytuj'))
        <form method="POST" action="{{route('admin.boxes.update', $entry->id)}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
    @else
        <form method="POST" action="{{route('admin.boxes.zapisz')}}" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="container-fluid">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        @include('form-elements.errors')
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'nazwa', 'value' => $entry->nazwa])
                            @include('form-elements.input-text', ['label' => 'Tekst', 'name' => 'tekst', 'value' => $entry->tekst])
                            @include('form-elements.input-text', ['label' => 'Link', 'name' => 'link', 'value' => $entry->link])
                            @include('form-elements.input-file', ['label' => 'Ikonka', 'sublabel' => '(wymiary: '.$iconwidth.'px / '.$iconheight.'px)', 'name' => 'plik'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz boks'])
    </form>
@endsection
