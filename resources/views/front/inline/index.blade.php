@extends('layouts.page')

@section('meta_title', 'Inline Test')

@php
    $array = App\Inline::getElements(1);
@endphp

@section('content')
<div id="inline" class="container pt-5 pb-5">
    <div class="row">
        <div class="col-12 inline inline-tc">
            <h2 data-modaltytul="1">{{ getInline($array, 1, 'modaltytul') }}</h2>
            <div data-modaleditor="1">
                <p>{{ getInline($array, 1, 'modaleditor') }}</p>
            </div>

            <div class="inline-btn"><button type="button" class="btn btn-primary btn-modal btn-sm" data-toggle="modal" data-target="#inlineModal" data-inline="1" data-hideinput="modaleditortext,modallink,modallinkbutton,obrazek,obrazek_alt" data-method="update" data-imgwidth="100" data-imgheight="100"></button></div>
        </div>
    </div>
</div>
@endsection

@section('inline')
<div class="modal" id="inlineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edytuj</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="inlineform">
                    <form method="POST" action="" enctype="multipart/form-data" id="inlineForm" name="inlineForm">
                        @csrf
                        <div class="form-group form-modaltytul"><label for="modaltytul" class="required">Tytuł</label>
                            <div class="formRight">
                                <input type="text" name="modaltytul" id="modaltytul" value="" size="83" class="validate[required] form-control">
                            </div>
                        </div>

                        <div class="form-group form-modaleditor"><label for="modaleditor" class="required">Tekst</label>
                            <div class="formRight">
                                <input type="text" name="modaleditor" id="modaleditor" value="" size="83" class="validate[required] form-control">
                            </div>
                        </div>

                        <div class="form-group form-modaleditortext" style="display: none;"><label for="modaleditortext" class="required">Treść</label>
                            <div class="fullformRowtext">
                                <textarea name="modaleditortext" id="modaleditortext" rows="19" cols="100" class="editor"></textarea>
                            </div>
                        </div>

                        <div class="form-group form-modallink" style="display: none;"><label for="modallink" class="required">Button link</label>
                            <div class="formRight">
                                <input type="text" name="modallink" id="modallink" value="" size="83" class="validate[required] form-control">
                            </div>
                        </div>

                        <div class="form-group form-modallinkbutton" style="display: none;"><label for="modallinkbutton" class="required">Button tekst</label>
                            <div class="formRight">
                                <input type="text" name="modallinkbutton" id="modallinkbutton" value="" size="83" class="validate[required] form-control">
                            </div>
                        </div>

                        <div class="form-group form-obrazek"><label for="obrazek" class="optional">Obrazek - szerokość: 1920 px - wysokość: 960 px</label>
                            <div class="formRight">
                                <input type="hidden" name="MAX_FILE_SIZE" value="16777216" id="MAX_FILE_SIZE">
                                <input type="file" name="obrazek" id="obrazek" class="validate[checkFileType[jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF]]">
                            </div>
                        </div>

                        <div class="form-group form-obrazek_alt" style="display: none;"><label for="obrazek_alt" class="required">Tytuł obrazka</label>
                            <div class="formRight">
                                <input type="text" name="obrazek_alt" id="obrazek_alt" value="" size="83" class="validate[required] form-control">
                            </div>
                        </div>

                        <div class="form-group form-hidden">
                            <div class="formRight">
                                <input type="hidden" name="id_element" value="1" id="id_element">
                            </div>
                        </div>

                        <div>
                            <input type="submit" name="submit" id="submit" value="Zapisz" class="btn btn-primary">
                        </div>
                    </form>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    const baseURL = '';

    function process_response(e)
    {
        var f = $("#inlineModal form");
        var d;
        for (d in e)
        {
            f.find('[name="' + d + '"]').val(e[d])
        }
    }
    var is_editor_active = function (b)
    {
        if (typeof tinyMCE == "undefined")
        {
            return false
        }
        if (typeof b == "undefined")
        {
            editor = tinyMCE.activeEditor
        }
        else
        {
            editor = tinyMCE.EditorManager.get(b)
        }
        if (editor == null)
        {
            return false
        }
        return !editor.isHidden()
    };

    function cleanModal(){
        $("#inlineForm, #inlineForm .form-group, .progress").removeAttr("style");
        $("#inlineForm")[0].reset();
        //$("#id_element, #obrazek").val("");
        $("#obrazek").val("");
        $("label[for='obrazek']").text("Obrazek");
        $(".modal h5").text("Edytuj");
        $(".alert").remove()
    }

    $("#inlineModal").on("shown.bs.modal", function (j)
    {
        cleanModal();
        const form = document.getElementById("inlineForm");
        let f = j.relatedTarget.dataset.inline,
            k = j.relatedTarget.dataset.place,
            a = j.relatedTarget.dataset.method,
            c = j.relatedTarget.dataset.imgwidth,
            g = j.relatedTarget.dataset.imgheight,
            h = j.relatedTarget.dataset.hideinput;

        if (h)
        {
            var b = h.split(",");
            var d;
            for (d = 0; d < b.length; ++d)
            {
                $(".form-" + b[d]).hide()
            }
        }
        if (f !== undefined)
        {
            $.ajax({
                type: "GET",
                url: baseURL + "inline/loadinline/" + f,
                success: function (i) {
                    if (i.error) {
                        alert(i.error);
                        $("#inlineModal").modal("toggle")
                    } else {
                        process_response(i);
                        if (c !== undefined) {
                            $("label[for='obrazek']").append(" - szerokość: " + c + " px")
                        }
                        if (g !== undefined) {
                            $("label[for='obrazek']").append(" - wysokość: " + g + " px")
                        }
                        $("#id_element").val(f);
                    }
                },
                error: function () {
                    alert("Wystąpił błąd połączenia z bazą")
                }
            })
        } else {
            if (c !== undefined)
            {
                $("label[for='obrazek']").append(" - szerokość: " + c + " px")
            }
            if (g !== undefined)
            {
                $("label[for='obrazek']").append(" - wysokość: " + g + " px")
            }
            $(".modal h5").text("Dodaj nowy element")
        }
        console.log('Form shown');

        form.addEventListener( "submit", function (event) {
            console.log('Submit form');
            event.preventDefault();
            event.stopImmediatePropagation();

            let n, type, o = $(this).serialize(), l = $("#id_element").val();
            if (l === "") {
                n = baseURL + "inline/create/" + k;
                type = 'POST';
                console.log("Dodaje nowy element")
                console.log(n)
            } else {
                n = baseURL + "inline/update/" + l;
                type = 'POST';
                console.log("Aktualizuje element")
                console.log(n)
            }
            console.log(o);

            $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('input[name="_token"]').val()}});
            $.ajax({
                type: type,
                url: n,
                data: o,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                enctype: "multipart/form-data",
                processData: false,
                beforeSend: function () {
                    $(".modal form").hide();
                    $(".modal h5").text("Zapisuje...");
                    $(".modal .progress").css({
                        display: "flex"
                    })
                },
                cache: false,
                success: function (p) {
                    if (p.status == "success") {
                        $(".progress").removeAttr("style");
                        console.log(p);

                        if (p.items.modaltytul) {
                            $("[data-modaltytul=" + p.item + "]").text(p.items.modaltytul)
                        }
                        if (p.items.modaleditor) {
                            $("[data-modaleditor=" + p.item + "]").text(p.items.modaleditor)
                        }
                        if (p.items.modaleditortext) {
                            $("[data-modaleditortext=" + p.item + "]").html(p.items.modaleditortext)
                        }
                        if (p.items.modallink) {
                            $("[data-modallink=" + p.item + "]").attr("href", p.items.modallink)
                        }
                        if (p.items.modallinkbutton) {
                            $("[data-modalbutton=" + p.item + "]").text(p.items.modallinkbutton)
                        }
                        if (p.items.obrazek_alt) {
                            $("[data-img=" + p.item + "]").attr("alt", p.items.obrazek_alt)
                        }
                        if (p.items.obrazek) {
                            $("[data-img=" + p.item + "]").attr("src", baseClearURL + "files/inline/" + p.items.obrazek)
                        }
                        if (p.items.id_place) {
                            $("[data-placeholder=" + p.items.id_place + "]").append(p.html)
                        }

                        $(".modal h5").text("Gotowe");

                        $(".inlineform").append('<div class="alert alert-success border-0" role="alert">Edycja zakończona sukcesem!</div>');
                        setTimeout(function () {
                            $("#inlineModal").modal("hide");
                            setTimeout(function () {
                                cleanModal();
                            }, 200)
                        }, 2000)
                    } else {
                        console.log("Coś poszło nie tak :)")
                    }
                },
                error: function () {
                    alert("Wystąpił bład połączenia z bazą");
                    $("#inlineModal").modal("hide");
                }
            });
            return false

        });
    });

    $("#inlineModal").on("hide.bs.modal", function (c)
    {
        console.log('Close modal');
        cleanModal();
    });
</script>
@endsection
