@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-image"></i> &nbsp;Galeria - {{$nazwa}}</h4>
    </div>

    <div class="container-fluid">
        <ul id="sortable" class="mb-0 list-unstyled clearfix">
            @foreach ($list as $index => $p)
            <li id="recordsArray_{{ $p->id }}">
                <div class="card thumb-card">
                    <img class="img-fluid" src="<?php echo asset("uploads/galeria/thumbs/".$p->plik)?>" alt="{{ $p->nazwa }}">
                    <div class="card-body">
                        <div class="btn-group">
                            <a href="" class="btn action-button action-small mr-1" data-toggle="tooltip" data-placement="top" title="Edytuj zdjęcie"><i class="fe-edit"></i></a>
                            <a href="" class="btn action-button move-button action-small mr-1"><i class="fe-move"></i></a>
                            <form method="POST" action="{{route('admin.gallery.usunzdjecie', $p->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn action-button action-small confirm" data-toggle="tooltip" data-placement="top" data-id="{{ $p->id }}" title="Usuń zdjęcie"><i class="fe-trash-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="form-group form-group-submit row">
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bootstrapmodal">Dodaj kilka zdjęć</button>
            <a href="{{route('admin.gallery.index')}}" class="btn btn-primary">Wróć do listy</a>
        </div>
    </div>

    <div class="modal fade" id="bootstrapmodal" tabindex="-1" role="dialog" aria-labelledby="uploadlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadlabel">Dodaj zdjęcia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="jquery-wrapped-fine-uploader"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" language="javascript">
        $(window).on('shown.bs.modal', function() { $('#bootstrapmodal').modal('show'); var fileCount = 0; $('#jquery-wrapped-fine-uploader').fineUploader({debug: true, request: {endpoint: '{{route('admin.gallery.upload', $id)}}', customHeaders: {"X-CSRF-Token": $("meta[name='csrf-token']").attr("content")}}}).on('error', function(event, id, name, reason) {}).on('submit', function(id, nameN){fileCount++;}).on('complete', function(event, id, name, response){if(response.success==true){fileCount--;if(fileCount == 0){location.reload();}}});});
        $(document).ready(function(){$("#sortable").sortujGal('{{route('admin.gallery.sort')}}');});
    </script>
@endsection
@section('scripts')
<script src="/js/fineuploader.js" charset="utf-8"></script>
@endsection
