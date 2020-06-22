var j = jQuery.noConflict();
j(document).ready(function() {

    j(".conversation-compose .send").on( "click", function() {
        openWA();
    });

    j('.input-msg').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            openWA();
        }
    });

    function openWA() {

        var whatsappLink = "https://wa.me/" + whatsappNumber + "?text=" + encodeURIComponent(j(".input-msg").val());
        var redirectWindow = window.open(whatsappLink, '_blank');
        redirectWindow.location;

    }

    j(".whatsapp-button, .actions.close").on( "click", function() {

        if (j(".whatsapp").hasClass("opened")) {

            j(".whatsapp").removeClass("opened");
            j(".whatsapp-button").removeClass("invert");
        }else{
            j(".whatsapp-button").addClass("invert");
            j(".whatsapp").addClass("opened");

        }

        j(".whatsapp").removeAttr("style");
     });
});