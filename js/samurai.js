jQuery(document).ready(function($) {

    scrollTo = {
        target: $('.menu a, .btn-go, .goup, .mail-link'),
        root: $('html, body'),
        init: function() {
            scrollTo.target.click(function() {
                scrollTo.root.animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - 120
                }, 500);
                return false;
            });
        }
    }

    scrollTo.init();

    $(' .menu-primary-container a, .btn-go, .mail-link').on('click', function() {
        $('.mobile-nav, .mobile-trigger').removeClass('active');
    });

    $('.mobile-trigger').on('click',function(){
        $('.mobile-nav, .mobile-trigger').toggleClass('active');
    });

    popup = $('.popup-demo');

    if (popup.length) {
        popupClose = $('.popup-close');
        popup.fadeIn('fast', function() {

        });

        popupClose.on('click', function() {
            $(this).closest('.popup-demo').fadeOut('fast', function() {
                $(this).remove();
            });
        });
    }


    $('.wpb_gmaps_widget, .sp_maps_container').on('click', function() {
        $(this).addClass('active-map'); // set the pointer events true on click
    });

    // you want to disable pointer events when the mouse leave the canvas area;

    $(".wpb_gmaps_widget, .sp_maps_container").mouseleave(function() {
        $(this).removeClass('active-map'); // set the pointer events to none when mouse leaves the map area
    });

    $('html').on('touchstart', function(e) {
        $('.wpb_gmaps_widget, .sp_maps_container').removeClass('active-map');
    });

    $(".wpb_gmaps_widget, .sp_maps_container").on('touchstart',function(e) {
        e.stopPropagation();
    });
    



   

});