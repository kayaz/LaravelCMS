$(document).ready(function(){

    $(".plan-control a").hover(function() {
        var e = $(this).attr("data-tag");
        $("area[alt='"+ e +"']").mapster("set", true, {
            fillColor: "fff881",
            fillOpacity: 0.6
        })
    }, function() {
        $("area").mapster("set", false);
    });

    $('#invesmentplan').mapster({
        fillColor: 'fff881',
        fillOpacity: 0.6,
        clickNavigate: true
    });
});
