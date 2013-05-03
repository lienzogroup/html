jQuery(function ($) {
    
    resizeOverlay = function(slider){
		var currentSlide = $('.slide-' + slider.currentSlide),
	    currentSlidewidth = currentSlide.width(),
	    overlayContainerWidth = $('.overlay-container').width(),
	    otherWidth = (overlayContainerWidth - currentSlidewidth) / 2;
	    	
	    $('.main-overlay').animate({width: currentSlidewidth}, 500);
	    $('.left-overlay').width(otherWidth);
	    $('.right-overlay').width(otherWidth);
	    $('.slides').css({'padding-left': otherWidth});	    
    }    
    
    $('.flexslider').flexslider({
        animation: "slide",
        controlsContainer: ".flex-container",
        animationLoop: true,
        startAt: 1,
        slideshowSpeed: 7000,
        itemWidth: 1100,
	    itemMargin: 0,
	    minItems: 1,
	    maxItems: 3,
	    pauseOnHover: true,
	        
	    start: function(slider){
			resizeOverlay(slider);
			$('.slide-' + slider.currentSlide).addClass('currentSlide');
	    },  
	       
	    before: function(slider){			
	    	resizeOverlay(slider);
	    	$('.currentSlide').removeClass('currentSlide');
	    	$('.slide-' + slider.animatingTo).addClass('currentSlide');
	    },
	    
	    after: function(slider){
			if(slider.currentSlide >= slider.count - 2)	// subtract the 2 clone elements
	    	{
	    		
	    	}  
	    }
	    
    });    
    
});