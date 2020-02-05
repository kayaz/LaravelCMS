@extends('admin')
@section('content')
    @if(Route::is('admin.ban.edit'))
        <form method="POST" action="{{route('admin.ban.update', $entry->id)}}" enctype="multipart/form-data">
            {{method_field('PUT')}}
            @else
                <form method="POST" action="{{route('admin.ban.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container-fluid">
                        <div class="card">
                            @include('form-elements.card-header')
                            <div class="card-body">
                                <div class="row">
                                    @include('form-elements.errors')
                                    <div class="col-12">
                                        @include('form-elements.input-text', ['label' => 'Adres IP', 'name' => 'address', 'value' => $entry->address])
                                        @include('form-elements.input-text', ['label' => 'Powód', 'name' => 'reason', 'value' => $entry->reason])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
@endsection
