$(document).ready(function($) {
//    $( "select#slots" ).change(function() {
//  alert( "Handler for .change() called." );
//});

$("select#slots").change(function () {
    var s = $('option:selected', $(this)).val();
    
    if (s == -1) {
        $(".total-slots").addClass("displayNone");

    }


    else if (s == 1) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1").removeClass("displayNone");
        $(".slot2 ,.slot3 , .slot4 , .slot5 , .slot6, .slot7").addClass("displayNone");

    }
    else if (s == 2) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2").removeClass("displayNone");
        $(".slot3 , .slot4 , .slot5 , .slot6, .slot7").addClass("displayNone");


    }
    else if (s == 3) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2 , .slot3").removeClass("displayNone");
        $(".slot4 , .slot5 , .slot6, .slot7").addClass("displayNone");


    }
    else if (s == 4) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2 , .slot3 , .slot4").removeClass("displayNone");
        $(".slot5 , .slot6, .slot7").addClass("displayNone");
    }
    else if (s == 5) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2 , .slot3 , .slot4 , .slot5 ").removeClass("displayNone");
         $(".slot6, .slot7").addClass("displayNone");
    }
    else if (s == 6) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2 , .slot3 , .slot4 , .slot5, .slot6 ").removeClass("displayNone");
         $(" .slot7").addClass("displayNone");
    }
    else if (s == 7) {
        $(".total-slots").removeClass("displayNone");
        $(".slot1 , .slot2 , .slot3 , .slot4 , .slot5, .slot6, .slot7 ").removeClass("displayNone");
        
    }
});


$(function() {
$( ".datepicker" ).datepicker({ minDate: 10});
});
});
