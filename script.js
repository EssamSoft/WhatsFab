
$(document).ready(function() {

    $(".conversation-compose .send").on( "click", function() {
        openWA();
    });

    $('.input-msg').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            openWA();
        }
    });

    function openWA() {

        var whatsappLink = "https://wa.me/" + whatsappNumber + "?text=" + encodeURIComponent($(".input-msg").val());
        var redirectWindow = window.open(whatsappLink, '_blank');
        redirectWindow.location;

    }

    $(".whatsapp-button, .actions.close").on( "click", function() {

        if ($(".whatsapp").hasClass("opened")) {

            $(".whatsapp").removeClass("opened");
            $(".whatsapp-button").removeClass("invert");
        }else{
            $(".whatsapp-button").addClass("invert");
            $(".whatsapp").addClass("opened");

        }

        $(".whatsapp").removeAttr("style");
     });
});