
/* SHOW AND HIDE AJAX MODAL ******************************************/
	function showModal() {
		var loadingContainer = "body #loading_modal";
		var wHeight = jQuery(document).height();
		var css = "background: none repeat scroll 0 0 #000000;display: none; height: "+wHeight+"px;opacity: 0.3;position: absolute;text-align: center;vertical-align: middle;width: 100%;z-index: 99999999;";
		jQuery(loadingContainer).attr("style",css);
		jQuery(loadingContainer).fadeIn();
	}
	function hideModal() {
		var loadingContainer = "body #loading_modal";
		jQuery(loadingContainer).fadeOut();
	}

/* DOCUMENT READY */
jQuery(function() {
	var selector = "#rt_user_header";

/* SHOW USER LOGIN ******************************************/
	
	/*SHOW LOGIN PAGE*/
	jQuery(selector+" #login").click(function() {
		var mainContainer = "user_login";
		/* CHECK IF THE CONTAINER EXIST */
		var checkContainer = jQuery("#"+mainContainer).css('display');
		if(checkContainer) {
			jQuery("#"+mainContainer+",#user_login_background").fadeIn(1500);
		}
		else {
			var href = jQuery(this).attr("href");
			
			/* SHOW MODAL */
			showModal();
			
			/* REQUEST PAGE */
			jQuery.ajax({
				type: "POST",
				url: href + "?r=ajax",
				/* data: {"field": field,"sort":sort}, */
				dataType: "html"
			}).done(function(data) {
					
					/* SHOW PAGE */
					jQuery("body").append(data);
					jQuery("#"+mainContainer+",#user_login_background").fadeIn(1500);
					
				/* HIDE MODAL*/
				hideModal();
				return false;
			});
		}
		return false;
	});
		/* LOGOUT PAGE */
		jQuery(selector+" a#logout").click(function() {
				/* REQUEST LOGIN */
				showModal();
				jQuery.ajax({
					type: "POST",
					url: apiURL + "logout",
					dataType: "html"
				}).done(function(data) {
						window.location = homeURL;
					return false;
				});
			return false;
		});
	
		/* ADD CART BUTTON */
		jQuery(".add_to_cart_button.button ").click(function() {
			
			/* Show Cart Notification Message*/
			var cartContainer = jQuery('#cart_notification_container')			
			if(cartContainer.hasClass('visible'))				
				cartContainer.removeClass('visible');				
			else
				{
				cartContainer.addClass('visible');
				cartContainer.fadeIn(1000).delay(100).fadeOut(1000);
				cartContainer.removeClass('visible');				
				}
			
			/**/
			setTimeout(function() {
				var items = jQuery("#rt_user_header #items").html();
				items = (items * 1) + 1;
				jQuery("#rt_user_header #items").html(items);
			},1000);
		})

/* SHOW USER LOGIN ******************************************/
	
/* SHOW OPTION ***********************************************/
	jQuery(selector+" #option").mouseover(function() {
		jQuery(selector+' #option').show();
	}); /* HIDE */
		jQuery(selector+" #option").mouseout(function() {
			jQuery(selector+' #option').hide();
		});
	jQuery(selector+" #display_name").mouseover(function() {
		jQuery(selector+' #option').show();
	}); /* HIDE */
		jQuery(selector+" #display_name").mouseout(function() {
			jQuery(selector+' #option').hide();
		});
/* SHOW OPTION **********************************************/	

	

	jQuery(window).scroll(function() {
		var pos = jQuery("div.container div.nav-container").position();
		
	});

});