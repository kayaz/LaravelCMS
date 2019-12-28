@extends('layouts.page')

@section('meta_title', $nazwa)

@section('content')
    <div id="photos-list" class="container pt-5 pb-5">
        <div class="row">
            @foreach ($list as $p)
                <div class="col-3">
                    <img src="<?php echo asset("uploads/galeria/thumbs/".$p->plik)?>" alt="{{ $p->nazwa }}">
                </div>
            @endforeach
        </div>
    </div>
@endsection
