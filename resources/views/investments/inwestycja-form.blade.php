@extends('admin')
@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-home"></i> <a href="{{route('admin.investments.index')}}">Inwestycje</a> / {{$investment->name}}</h4>
    </div>
    @if(Route::is('admin.investments.edytuj'))
        <form method="POST" action="{{route('admin.investments.update', $investment->id)}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
    @else
        <form method="POST" action="{{route('admin.investments.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="container-fluid">
        <div class="card">
            @if(Route::is('admin.investments.edytuj'))
                @include('investments.submenu')
            @endif
            @include('form-elements.card-header')
            <div class="card-body">
                <div class="row">
                    @include('form-elements.errors')
                    <div class="col-12">
                        @include('form-elements.select', ['label' => 'Typ inwestycji', 'name' => 'typ', 'selected' => $investment->typ, 'options' => ['1' => 'Inwestycja osiedlowa', '2' => 'Inwestycja budynkowa']])
                        @include('form-elements.select', ['label' => 'Status inwestycji', 'name' => 'status', 'selected' => $investment->status, 'options' => ['1' => 'Inwestycja w sprzedaży', '2' => 'Inwestycja zakończona']])
                        @include('form-elements.input-text', ['label' => 'Nazwa inwestycji', 'name' => 'name', 'value' => $investment->name])
                        @include('form-elements.input-text', ['label' => 'Nagłówek strony', 'sublabel'=> 'Meta tag - title', 'name' => 'meta_title', 'value' => $investment->meta_title])
                        @include('form-elements.input-text', ['label' => 'Opis strony', 'sublabel'=> 'Meta tag - description', 'name' => 'meta_description', 'value' => $investment->meta_description])
                        @include('form-elements.input-text', ['label' => 'E-mail', 'name' => 'email', 'value' => $investment->email])
                        @include('form-elements.input-text', ['label' => 'Telefon', 'name' => 'phone', 'value' => $investment->phone])
                        @include('form-elements.input-text', ['label' => 'Adres inwestycji', 'name' => 'address', 'value' => $investment->address])
                        @include('form-elements.input-text', ['label' => 'Adres biura', 'name' => 'office', 'value' => $investment->office])
                        @include('form-elements.input-file', ['label' => 'Logo inwestycji', 'sublabel' => '(wymiary: '.$logowidth.'px / '.$logoheight.'px)', 'name' => 'logo'])
                        @include('form-elements.input-file', ['label' => 'Miniaturka inwestycji', 'sublabel' => '(wymiary: '.$thumbwidth.'px / '.$thumbheight.'px)', 'name' => 'thumb'])
                        @include('form-elements.input-text', ['label' => 'Krótki opis', 'name' => 'content_list', 'value' => $investment->content_list])
                        @include('form-elements.textarea', ['label' => 'Opis inwestycji', 'name' => 'content', 'value' => $investment->content, 'rows' => 11, 'class' => 'tinymce'])

                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz inwestycje'])
    </div>
</form>
@include('form-elements.tintmce')
@endsection

