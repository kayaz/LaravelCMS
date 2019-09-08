@extends('admin')

@section('content')
    <div class="container-fluid">
        <h4 class="page-title"><i class="fe-home"></i> <a href="{{route('admin.investments.index')}}">Inwestycje</a> / {{$investment->nazwa}}: Dodaj plan inwestycji</h4>
    </div>
    <div class="container-fluid">
        <div class="card">

            @include('investments.submenu')

            <div class="card-body">
                <div class="alert alert-info" role="alert">Rzut planu inwestycji: 1200px szerokości / 560px wysokości</div>
                @if($investment->plan)
                    <img class="img-fluid" src="<?php echo asset("inwestycje/plan/".$investment->plan)?>" alt="{{ $investment->nazwa }}">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit row">
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bootstrapmodal">Zmień plan inwestycji</button>
        </div>
    </div>

    <div class="modal fade" id="bootstrapmodal" tabindex="-1" role="dialog" aria-labelledby="uploadlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadlabel">Dodaj plan</h5>
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

    <script type = "text/javascript" language = "javascript" >
    $(window).on('shown.bs.modal', function () {
        $('#bootstrapmodal').modal('show');
        var fileCount = 0;

        $('#jquery-wrapped-fine-uploader').fineUploader({
            debug: true,
            multiple: false,
            text: {
                uploadButton: "Wybierz plik",
                dragZone: "Przeciągnij i upuśc plik tutaj"
            },
            request: {
                endpoint: '{{route('admin.investments.planupdate', [$investment])}}',
                customHeaders: {
                    "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
                }
            }
        }).on('error', function (event, id, name, reason) {}).on('submit', function (id, nameN) {
            fileCount++;
        }).on('complete', function (event, id, name, response) {
            if (response.success == true) {
                fileCount--;
            if (fileCount == 0) {
                location.reload();
            }
            }
        });
    });
    </script>
@endsection
@section('scripts')
    <script src="/js/fineuploader.js" charset="utf-8"></script>
@endsection
