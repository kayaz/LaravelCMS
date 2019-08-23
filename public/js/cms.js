/*

	Obsługa wszystkich funkcji jQuery

*/

// Potwierdzenie
(function(a){a.confirm=function(c){if(a("#confirmOverlay").length){return false}var f="";a.each(c.buttons,function(h,g){f+='<a href="#" class="'+g["class"]+'">'+h+"<span></span></a>";if(!g.action){g.action=function(){}}});var e=['<div id="confirmOverlay">','<div class="modal fade show" id="confirmBox"><div class="modal-dialog"><div class="modal-content">','<div class="modal-header"><h5 class="modal-title">',c.title,"</h5></div>",'<div class="modal-body">',c.message,"</div>",'<div id="confirmButtons" class="modal-footer">',f,"</div></div></div>"].join("");a(e).hide().appendTo("body").fadeIn();var b=a("#confirmBox .btn"),d=0;a.each(c.buttons,function(g,h){b.eq(d++).click(function(){h.action();a.confirm.hide();return false})})};a.confirm.hide=function(){a("#confirmOverlay").fadeOut(function(){a(this).remove()})}})(jQuery);

function show5(){if(document.layers||document.all||document.getElementById){var e=new Date,c=e.getHours(),o=e.getMinutes(),t=e.getSeconds();0==c&&(c=12),o<=9&&(o="0"+o),t<=9&&(t="0"+t),myclock=c+":"+o+":"+t+" ",document.layers?(document.layers.liveclock.document.write(myclock),document.layers.liveclock.document.close()):document.all?liveclock.innerHTML=myclock:document.getElementById&&(document.getElementById("liveclock").innerHTML=myclock),setTimeout("show5()",1e3)}}window.onload=show5;

// Pomoc przy sortowaniu
var fixHelper=function(b,a){a.children().each(function(){var c=$(this).clone();$(this).width($(this).width())});return a};

// Sortowanie listy
jQuery.fn.sortuj=function(a){this.sortable({cursor:"move",handle:".move-button",start:function(d,c){var b=$(this).sortable("instance");c.placeholder.height(c.helper.height());b.containment[3]+=c.helper.height()*1.5-b.offset.click.top;b.containment[1]-=b.offset.click.top},helper:function(b,c){c.children().each(function(){$(this).width($(this).width())});return c},zIndex:9999,containment:"#sortable",axis:"y",update:function(){var b=$(this).sortable("serialize");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});$.ajax({data:b,type:"POST",url:a,success:function(c){$(".card-header").append('<div class="alert alert-success none" role="alert">Zmiana zapisana</div>');$(".alert").fadeIn("slow");setTimeout(function(){$(".alert").fadeOut("slow").remove()},1500)},error:function(){$(".card-header").append('<div class="alert alert-danger none" role="alert">Wystąpił błąd</div>');$(".alert").fadeIn("slow");setTimeout(function(){$(".alert").fadeOut("slow").remove()},1500)}})}}).disableSelection()};

// Sortowanie galerii
jQuery.fn.sortujGal=function(a){this.sortable({cursor:"move",handle:".move-button",zIndex:9999,containment:"#sortable",dropOnEmpty:false,start:function(d,c){var b=$(this).sortable("instance");b.containment[3]+=c.helper.height()*1.5-b.offset.click.top;b.containment[1]-=b.offset.click.top},update:function(){var b=$(this).sortable("serialize");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});$.ajax({data:b,type:"POST",url:a,success:function(c){$(".page-title").append('<div class="alert alert-success none" role="alert">Zmiana zapisana</div>');$(".alert").fadeIn("slow");setTimeout(function(){$(".alert").fadeOut("slow").remove()},1500)},error:function(){$(".page-title").append('<div class="alert alert-danger none" role="alert">Wystąpił błąd</div>');$(".alert").fadeIn("slow");setTimeout(function(){$(".alert").fadeOut("slow").remove()},1500)}})}}).disableSelection()};

$(document).ready(function(){
	$('#togglemenu').click(function(e) {
		e.preventDefault();
		$('body').toggleClass('icon-menu');
	});
	$('[data-toggle="tooltip"]').tooltip();

	$(".confirm").click(function(d){d.preventDefault();var c=$(this).closest("form");var a=c.attr("action");var f=$(this).data("id");var b=$("meta[name='csrf-token']").attr("content");$.confirm({title:"Potwierdzenie usunięcia",message:"Czy na pewno chcesz usunąć?",buttons:{Tak:{"class":"btn btn-primary",action:function(){$.ajax({url:a,type:"DELETE",data:{_token:b,},success:function(){location.reload()}})}},Nie:{"class":"btn btn-secondary",action:function(){}}}})});


});
