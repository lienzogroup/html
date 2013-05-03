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
    
    /*
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
	    	
	    	if(slider.animatingTo >= slider.count - 2)	// subtract the 2 clone elements
	    	{
	    		slider.currentSlide = 1;
	    		$('.slide-' + slider.currentSlide).addClass('currentSlide');
	    	}
	    },
	    
	    after: function(slider){
			if(slider.currentSlide >= slider.count - 2)	// subtract the 2 clone elements
	    	{
	    		slider.currentSlide = 1;
	    		$('.slides').css('-webkit-transition' , '0.0s');
	    		$('.slides').css('-webkit-transform' , 'translate(-1100px, 0)');

	    	}  
	    }
	    
    });    
    */
    
    $('.slides').anythingSlider({
		buildStartStop : false,
		
		onSlideBegin : function(event, slider){
			var nextSlide = $('.slide-' + slider.targetPage);
			var currentSlide = $('.slide-' + slider.currentPage);

			nextSlide.addClass('activePage');
			currentSlide.removeClass('activePage');
		}
    });
});