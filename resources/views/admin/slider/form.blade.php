@extends('admin')
@section('content')
    @if(Route::is('admin.slider.edytuj'))
        <form method="POST" action="{{route('admin.slider.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.slider.zapisz')}}" enctype="multipart/form-data">
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
                            @include('form-elements.input-file', ['label' => 'Plik', 'sublabel' => '(wymiary: '.$imgwidth.'px / '.$imgheight.'px)', 'name' => 'plik'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
