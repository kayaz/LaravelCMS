@extends('admin')

@section('content')
    @if(Route::is('admin.news.edytuj'))
        <form method="POST" action="{{route('admin.news.update', $wpis->id)}}" enctype="multipart/form-data">
            @method('PUT')
    @else
        <form method="POST" action="{{route('admin.news.zapisz')}}" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="container-fluid">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">{{ $cardtitle }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="form_status" class="col-2 col-form-label control-label">Status</label>
                            <div class="col-10">
                                <select id="form_status" class="form-control" name="status">
                                    <option value="1"@if ($wpis->status == 1) selected @endif>Pokaż na liście</option>
                                    <option value="0"@if ($wpis->status == 0) selected @endif>Ukryj na liście</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_nazwa" class="col-2 col-form-label control-label">Tytuł wpisu</label>
                            <div class="col-10">
                                <input id="form_nazwa" value="{{ $wpis->nazwa }}" class="form-control" name="nazwa" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_meta_tytul" class="col-2 col-form-label control-label">Nagłówek strony<br><span>Meta tag - title</span></label>
                            <div class="col-10">
                                <input id="form_meta_tytul" value="{{ $wpis->meta_tytul }}" class="form-control" name="meta_tytul" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_meta_opis" class="col-2 col-form-label control-label">Opis strony<br><span>Meta tag - description</span></label>
                            <div class="col-10">
                                <input id="form_meta_opis" value="{{ $wpis->meta_opis }}" class="form-control" name="meta_opis" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_data" class="col-2 col-form-label control-label">Data</label>
                            <div class="col-10">
                                <input id="form_data" value="{{ $wpis->data }}" class="form-control" name="data" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_plik" class="col-2 col-form-label control-label">Plik</label>
                            <div class="col-10">
                                <input id="form_plik" class="form-control-file" name="plik" type="file">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="form_wprowadzenie" class="col-2 col-form-label control-label">Wprowadzenie</label>
                            <div class="col-10">
                                <input id="form_wprowadzenie" value="{{ $wpis->wprowadzenie }}" class="form-control" name="wprowadzenie" type="text">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label control-label">Wprowadź tekst</label>
                            <div class="col-10">
                                <textarea class="form-control" id="tinymce" name="tekst" rows="4">{{ $wpis->tekst }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit row">
        <div class="col-12">
            <input name="submitUstawienia" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
        </div>
    </div>
</form>

<script>
    tinymce.init({
        selector: '#tinymce',
        language: 'pl',
        branding: false,
        height: 400,
        plugins: 'searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern filemanager',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        relative_urls: false,
        image_advtab: true
    });
</script>
@endsection
@section('scripts')
<script src="/js/editor/tinymce.min.js"></script>
@endsection
