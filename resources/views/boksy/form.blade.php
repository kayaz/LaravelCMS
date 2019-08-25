@extends('admin')
@section('content')
    @if(Route::is('admin.boksy.edytuj'))
        <form method="POST" action="{{route('admin.boksy.update', $wpis->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.boksy.zapisz')}}" enctype="multipart/form-data">
    @endif
        @csrf
        <div class="container-fluid">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        @include('form-elements.errors')
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'nazwa', 'value' => $wpis->nazwa])
                            @include('form-elements.input-text', ['label' => 'Tekst', 'name' => 'tekst', 'value' => $wpis->tekst])
                            @include('form-elements.input-text', ['label' => 'Link', 'name' => 'link', 'value' => $wpis->link])
                            @include('form-elements.input-file', ['label' => 'Ikonka', 'sublabel' => '(wymiary: '.$iconwidth.'px / '.$iconheight.'px)', 'name' => 'plik'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz boks'])
    </form>
@endsection
