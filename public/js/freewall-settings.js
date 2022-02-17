jQuery( document ).ready( function( $ ){
    //jQuery.noConflict();

    $(".js-img-viwer").SmartPhoto();

    $('.responsiveGallery-wrapper').responsiveGallery({
        animatDuration: 400,
        $btn_prev: $('.responsiveGallery-btn_prev'),
        $btn_next: $('.responsiveGallery-btn_next')
    });

    // Random width layout
    var freewallRandom = new Freewall("#image-grid");
    freewallRandom.reset({
        selector: ".freewall-brick",
        animate: true,
        cellW: 200,
        cellH: "auto",
        onResize: function() {
            freewallRandom.fitWidth();
        }
    });
    $( document ).ready(function() {
        freewallRandom.fitWidth();

    });



    //Chaotic freewall framework settings
    var freewallChaotic = new Freewall("#flex-grid");
    freewallChaotic.reset({
        animate: true,
        cellW: 150,
        cellH: 150,
        //fixSize: 1,

        onResize: function() {
            freewallChaotic.fitWidth();
        }
    });
    freewallChaotic.addCustomEvent("onBlockLoad", function(setting) {
        //console.log(setting);
    });
    freewallChaotic.fitWidth();


    //freewall fixed image layout framework settings
    let freewallFixed = new Freewall("#nested-grid");
    freewallFixed.reset({
        animate: true,
        fixSize: 0,
        gutterY: 20,
        gutterX: 20,
        onResize: function () {
            freewallFixed.fitWidth();
        }

    });
    freewallFixed.fitWidth();



});