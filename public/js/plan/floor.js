$(document).ready(function() {
    $("#invesmentplan").mapster({
        onClick: function(g) {
            var f = $(this).attr("data-roomstatus");
            if (f != "2") {
                window.open(this.href, "_self")
            } else {
                return false
            }
        },
        fillOpacity: 0.8,
        onMouseover: function(g) {
            var f = $(this).attr("data-roomstatus");
            if (f == "2") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: "ec2327",
                    fillOpacity: 0.8
                })
            }
            if (f == "3") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: "1788c9",
                    fillOpacity: 0.8
                })
            }
            if (f == "1") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: "3a9019",
                    fillOpacity: 0.8
                })
            }
            if (f == "4") {
                $(this).mapster("set", false).mapster("set", true, {
                    fillColor: "de8300",
                    fillOpacity: 0.8
                })
            }
        },
        onMouseout: function(f) {
            $(this).mapster("set", false);
            $("area[data-roomstatus='2']").mapster("set", true, {
                fillColor: "ec2327",
                fillOpacity: 0.5
            });

            $("area[data-roomstatus='3']").mapster("set", true, {
                fillColor: "1788c9",
                fillOpacity: 0.5
            });

            $("area[data-roomstatus='1']").mapster("set", true, {
                fillColor: "3a9019",
                fillOpacity: 0.5
            });

            $("area[data-roomstatus='4']").mapster("set", true, {
                fillColor: "de8300",
                fillOpacity: 0.5
            });
        }
    });

    $("area[data-roomstatus='2']").mapster("set", true, {
        fillColor: "ec2327",
        fillOpacity: 0.5
    });

    $("area[data-roomstatus='3']").mapster("set", true, {
        fillColor: "1788c9",
        fillOpacity: 0.5
    });

    $("area[data-roomstatus='1']").mapster("set", true, {
        fillColor: "3a9019",
        fillOpacity: 0.5
    });

    $("area[data-roomstatus='4']").mapster("set", true, {
        fillColor: "de8300",
        fillOpacity: 0.5
    });
});
