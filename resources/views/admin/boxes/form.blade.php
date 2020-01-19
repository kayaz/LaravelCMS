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
                            @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'title', 'value' => $entry->title])
                            @include('form-elements.input-text', ['label' => 'Tekst', 'name' => 'content', 'value' => $entry->content])
                            @include('form-elements.input-text', ['label' => 'Link', 'name' => 'url', 'value' => $entry->url])
                            @include('form-elements.input-file', ['label' => 'Ikonka', 'sublabel' => '(wymiary: '.$iconwidth.'px / '.$iconheight.'px)', 'name' => 'file'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz boks'])
    </form>
@endsection
