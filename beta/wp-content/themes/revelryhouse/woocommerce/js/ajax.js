
/* Display Page with animation */
function animatePage(mainContainer,movement,currentContainer,nextContainer) {

	var timer = 1500;
	
	/* Fade in Fade Out 
	jQuery(currentContainer).fadeOut(1000);
	jQuery(nextContainer).fadeIn(1500); */
	
	// SLIDE */
	if(movement == 'right') {
		jQuery(mainContainer).animate({
			left: '+=960',
		}, timer, function() {
		// Animation complete.
		});
	}
	else {
		jQuery(mainContainer).animate({
			left: '-=960',
		}, timer, function() {
		// Animation complete.
		});
	}
}

var userCurrentPage = '';

jQuery(function() {



/* USER ACCOUNT LINKS ******************************************/
	/* EVENT LISTINER */
	var selector = "#user_container";
	jQuery(selector+" a").click(function(){
	var mainContainer = "#user_container #content #sliderContainer";
		/* GET HREF VALUE */
		var href = jQuery(this).attr("href");
		var myClass = jQuery(this).attr("class");
		var myID = jQuery(this).attr("id");
		
		if(myClass == 'button pay') {
			window.location = href;
		}
		else if(myID == 'goto_signup' ||myID == 'forgot') {}
		else {
			
			// SET CONTAIMER
			var containerPos = 0;
			if(myID == 'profile') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = 0;
				userCurrentPage = 'profile';
			}
			else if(myID == 'billing') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -960;
				userCurrentPage = 'billing';
			}
			else if(myID == 'shipping') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -1920;
				userCurrentPage = 'shipping';
			}
			else if(myID == 'orders') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -2880;
				userCurrentPage = 'orders';
			}
			
			/*Check if data is alredy exist*/
			if(jQuery.trim(jQuery(mainContainerData).html()) != '') {
			
					/* HIGHLIGHT CURRENT MENU /PAGE */
					jQuery("#user_container #user_menu li a").attr('class','');
					jQuery("#user_container #user_menu li a#"+myID).attr('class','active');
				
						/* SLIDER */
						jQuery(mainContainer).animate({
							left: containerPos
						}, 1500, function() {
							// Animation complete.
						
								/* Set Height */
								var pageHeight = jQuery(mainContainerData).css('height');
								//jQuery(mainContainer).css('height',pageHeight);
								jQuery(mainContainer).animate({
									height: pageHeight
								}, 1000, function() {
								// Animation complete.
								});
							
						});
			}
			else {
			
					/* Download Data*/
					if(myClass == 'button'
					|| myClass == 'edit'
					|| myID == 'billing'
					|| myID == 'shipping') {
						var url = href + "&r=ajax";
					}
					else {
						var url = href + "?r=ajax";
					}
				
					/* SHOW MODAL */
					showModal();
			
					/* HIGHLIGHT CURRENT MENU /PAGE */
					jQuery("#user_container #user_menu li a").attr('class','');
					jQuery("#user_container #user_menu li a#"+myID).attr('class','active');
				
					/* REQUEST PAGE */
					jQuery.ajax({
						type: "POST",
						url: url,
					/* data: {"field": field,"sort":sort}, */
						dataType: "html"
					}).done(function(data) {
					
							/* UPDATE CONTENT */
							jQuery(mainContainerData).html(data);
							
							/* SLIDER */
							jQuery(mainContainer).animate({
								left: containerPos
							}, 1500, function() {
							// Animation complete.
						
								/* Set Height */
								var pageHeight = jQuery(mainContainerData).css('height');
								//jQuery(mainContainer).css('height',pageHeight);
								jQuery(mainContainer).animate({
									height: pageHeight
								}, 1000, function() {
								// Animation complete.
								});
							
							});
							
						/* HIDE MODAL*/
						hideModal();
						
						return false;
					});
			}
		}
		return false;
	});
/* USER ACCOUNT LINKS ******************************************/

/* PROCESS ORDER LINKS ******************************************/
	/* EVENT LISTINER */
	var selector = "#process_container";
	jQuery(selector+" .cart_totals a").click(function(){ 
		
		var mainContainer = "#process_container";
		var myID = jQuery(this).attr('id');
		var myClass = jQuery(this).attr('class');
		/* GET HREF VALUE */
		var href = jQuery(this).attr("href");
	
		if(myID == 'previouspage') {
			if(myClass == 'cart') {
				window.location = href;
			}
			else if(myClass == 'checkout') {
			
					jQuery("#process_container #content #left #sliderContainer p#errmsg").css("width","671px");
			
					/* Active Menu */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","active");
					jQuery("#process_nav li a#step3").attr("class","pending");
					jQuery("#process_nav li a#step4").attr("class","pending");
					jQuery("#process_nav li a#step5").attr("class","pending");
					
					/* Update Calass */
					jQuery(this).attr('class','cart');
					jQuery(selector+" .cart_totals a#nextpage").attr('class','checkout');
					
					/* SLIDER */
					jQuery("#process_container #content #left #sliderContainer").animate({
						left: '0px'
					}, 2000, function() {
					// Animation complete.
					});
			}
			else if(myClass == 'shipping') {
					/* Active Menu */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","");
					jQuery("#process_nav li a#step3").attr("class","active");
					jQuery("#process_nav li a#step4").attr("class","pending");
					jQuery("#process_nav li a#step5").attr("class","pending");
					
					/* Update Calass */
					jQuery(this).attr('class','checkout');
					jQuery(selector+" .cart_totals a#nextpage").attr('class','shipping');
					
					/* SLIDER */
					jQuery("#process_container #content #left #sliderContainer").animate({
						left: '-662.4px'
					}, 2000, function() {
					// Animation complete.
					});
			}	
			else if(myClass == 'payment') {
					/* Active Menu */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","");
					jQuery("#process_nav li a#step3").attr("class","");
					jQuery("#process_nav li a#step4").attr("class","active");
					jQuery("#process_nav li a#step5").attr("class","pending");
					
					/* Update Calass */
					jQuery(this).attr('class','shipping');
					jQuery(selector+" .cart_totals a#nextpage").attr('class','payment');
					
					/* SLIDER */
					jQuery("#process_container #content #left #sliderContainer").animate({
						left: '-1324.4px'
					}, 2000, function() {
					// Animation complete.
					});
			}
		}
		else {
			/*UPDATE CLASS*/
			if(myClass == 'cart') {
				window.location = href;
			}
			else if(myClass == 'cart') {
				jQuery(this).attr('class','checkout');
				
				/* HIDE THE CONTAINER*/
				// jQuery(mainContainer).slideUp(2500);
				jQuery(mainContainer).fadeOut(3000);
				/* SET LOADING MODAL HEIGHT */
				var loading = "#loading_modal";
				var wHeight = jQuery(document).height();
				var css = "background: none repeat scroll 0 0 #000000;display: none; height: "+wHeight+"px;opacity: 0.3;position: absolute;text-align: center;vertical-align: middle;width: 100%;z-index: 99999;";
				jQuery(loading).attr("style",css);
				/* SHOW MODAL */
				jQuery(loading).fadeIn();
				
						/* REQUEST PAGE */
						jQuery.ajax({
							type: "POST",
							url: href + "?r=ajax",
						/* data: {"field": field,"sort":sort}, */
							dataType: "html"
						}).done(function(data) {
							
							
							/* UPDATE CONTENT */
							jQuery(mainContainer).html(data);
							/* SHOW THE CONTAINER*/
							// jQuery(mainContainer).slideDown(2500);
							jQuery(mainContainer).fadeIn(2500);
							/* HIDE MODAL*/
							jQuery(loading).fadeOut();
							return false;
							
						});
			
			}
			else if(myClass == 'checkout') {
				var errmsg = '';
				if(jQuery.trim(jQuery("form.checkout input[name=billing_first_name]").val()) == '') {
					errmsg = 'Billing First Name is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_last_name]").val()) == '') {
					errmsg = 'Billing Last Name is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_address_1]").val()) == '') {
					errmsg = 'Billing Address is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_city]").val()) == '') {
					errmsg = 'Billing City is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_postcode]").val()) == '') {
					errmsg = 'Billing Zipcode is required';
				}
				else if(jQuery.trim(jQuery("form.checkout #billing_country_chzn a span").html()) == 'Select a country…') {
					errmsg = 'Billing Country is required';
				}
				else if(jQuery.trim(jQuery("form.checkout #billing_state_chzn a span").html()) == 'Select a state…') {
					errmsg = 'Billing State is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_email]").val()) == '') {
					errmsg = 'Billing Email address is required';
				}
				else if(jQuery.trim(jQuery("form.checkout input[name=billing_phone]").val()) == '') {
					errmsg = 'Billing Phone is required';
				}
				
				// Display Error Message
				if(errmsg) {
					jQuery('div#process_container #left #errmsg').html(errmsg);
					jQuery('div#process_container #left #errmsg').fadeIn();
				}
				else {
				
					jQuery("#process_container #content #left #sliderContainer p#errmsg").css("width","1987.2px");
				
					/* ACTIVE MENU HEADER */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","");
					jQuery("#process_nav li a#step3").attr("class","active");
					jQuery("#process_nav li a#step4").attr("class","pending");
					jQuery("#process_nav li a#step5").attr("class","pending");
					
					jQuery('div#process_container #left #errmsg').fadeOut();
					jQuery(this).attr('class','shipping');
					jQuery(selector+" .cart_totals a#previouspage").attr('class','checkout');
					// jQuery("form.checkout #billing").fadeOut();
					// jQuery("form.checkout #shipping").fadeIn();
					
					/* SLIDER */
					jQuery("#process_container #content #left #sliderContainer").animate({
						left: '-662.4px'
					}, 2000, function() {
					// Animation complete.
					});
				}
			}
			else if(myClass == 'shipping') {
			
				var errmsg = '';
				if(jQuery("form.checkout input[name=shiptobilling]").attr("checked") != 'checked') {
				
					if(jQuery.trim(jQuery("form.checkout input[name=shipping_first_name]").val()) == '') {
						errmsg = 'Shipping First Name is required';
					}
					else if(jQuery.trim(jQuery("form.checkout input[name=shipping_last_name]").val()) == '') {
						errmsg = 'Shipping Last Name is required';
					}
					else if(jQuery.trim(jQuery("form.checkout input[name=shipping_address_1]").val()) == '') {
						errmsg = 'Shipping Address is required';
					}
					else if(jQuery.trim(jQuery("form.checkout input[name=shipping_city]").val()) == '') {
						errmsg = 'Shipping City is required';
					}
					else if(jQuery.trim(jQuery("form.checkout input[name=shipping_postcode]").val()) == '') {
						errmsg = 'Shipping Zipcode is required';
					}
					else if(jQuery.trim(jQuery("form.checkout #shipping_country_chzn a span").html()) == 'Select a country…') {
						errmsg = 'Shipping Country is required';
					}
					else if(jQuery.trim(jQuery("form.checkout #shipping_state_chzn a span").html()) == 'Select a state…') {
						errmsg = 'Shipping State is required';
					}
				}
				
				// Display Error Message
				if(errmsg) {
					jQuery('div#process_container #left #errmsg').html(errmsg);
					jQuery('div#process_container #left #errmsg').fadeIn();
				}
				else {
					/* ACTIVE MENU HEADER */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","");
					jQuery("#process_nav li a#step3").attr("class","");
					jQuery("#process_nav li a#step4").attr("class","active");
					jQuery("#process_nav li a#step5").attr("class","pending");
					
					jQuery('div#process_container #left #errmsg').fadeOut();
					jQuery(this).attr('class','payment');
					jQuery(selector+" .cart_totals a#previouspage").attr('class','shipping');
					// jQuery("form.checkout #shipping").fadeOut();
					// jQuery("form.checkout #payment").fadeIn();
					/* SLIDER */
					jQuery("#process_container #content #left #sliderContainer").animate({
						left: '-1324.8px'
					}, 2000, function() {
					// Animation complete.
					});
				}
			
			}
			else if(myClass == 'payment') {
			
				jQuery('div#process_container #left #errmsg').fadeOut();
				
				var payment = jQuery(selector+" form#order_review").css('display');
				if(payment) {
					/* ACTIVE MENU HEADER */
					jQuery("#process_nav li a#step1").attr("class","");
					jQuery("#process_nav li a#step2").attr("class","");
					jQuery("#process_nav li a#step3").attr("class","");
					jQuery("#process_nav li a#step4").attr("class","");
					jQuery("#process_nav li a#step5").attr("class","active");
					
					jQuery("form#order_review").submit();
				}
				else {
					jQuery("form.checkout").submit();
				}
			}			
			
		}
		return false;
	});
/* PROCESS ORDER LINKS ******************************************/
});