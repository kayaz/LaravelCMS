@extends('admin')

@section('content')
    @if(Route::is('admin.gallery.edytuj'))
        <form method="POST" action="{{route('admin.gallery.update', $entry->id)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.gallery.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
        <div class="container-fluid">
            <div class="card">
                @include('form-elements.card-header')
                <div class="card-body">
                    <div class="row">
                        @include('form-elements.errors')
                        <div class="col-12">
                            @include('form-elements.input-text', ['label' => 'Nazwa katalogu', 'name' => 'name', 'value' => $entry->name])
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
