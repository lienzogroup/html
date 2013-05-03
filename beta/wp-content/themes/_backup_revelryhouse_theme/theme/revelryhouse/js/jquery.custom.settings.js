/*-----------------------------------------------------------------------------------*/
/* Isotope
/*-----------------------------------------------------------------------------------*/

jQuery.noConflict()(function($){
        
var $container = $('#portfolio-items');
var $filter = $('#filters');
// Initialize isotope 
$container.isotope({
    filter: '*',
    itemSelector: '.block',
    layoutMode: 'fitRows',
    animationOptions: {
        duration: 750,
        easing: 'linear'
    }
});
// Filter items when filter link is clicked
$filter.find('a')
    .click(function () {
    var selector = $(this)
        .attr('data-filter');
    $filter.find('a')
        .removeClass('current');
    $(this)
        .addClass('current');
    $container.isotope({
        filter: selector,
        animationOptions: {
            animationDuration: 750,
            easing: 'linear',
            queue: false,
        }
    });
    return false;
});

/*-----------------------------------------------------------------------------------*/
/* Back to Top Button
/*-----------------------------------------------------------------------------------*/

jQuery(function ($) {

    $("#back-to-top").hide();
    
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

});

/*-----------------------------------------------------------------------------------*/
/* Superfish (Dropdowns)
/*-----------------------------------------------------------------------------------*/

jQuery(function ($) {

    $('.menu').superfish({
        delay: 200,
        animation: {
            opacity: 'show',
            height: 'show'
        },
        speed: 'fast',
        autoArrows: false,
        dropShadows: false
    });

});

	/* End all Custom JS Functions */
		
});