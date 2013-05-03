
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
		else {
			
			// SET CONTAIMER
			var containerPos = 0;
			if(myClass == 'profile') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = 0;
				userCurrentPage = 'profile';
			}
			else if(myClass == 'billing') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -960;
				userCurrentPage = 'billing';
			}
			else if(myClass == 'shipping') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -1920;
				userCurrentPage = 'shipping';
			}
			else if(myClass == 'orders') {
				mainContainerData  = mainContainer+ " #"+myID;
				containerPos = -2880;
				userCurrentPage = 'orders';
			}
			
			/*Check if data is alredy exist*/
			if(jQuery.trim(jQuery(mainContainerData).html()) != '') {
						
						//Reset Active Pages Color
						jQuery("#user_menu a").attr("style","color: #000");
						jQuery("#user_menu a."+myClass).attr("style","color: #a08f64");
						
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
					|| myClass == 'billing'
					|| myClass == 'shipping') {
						var url = href + "&r=ajax";
					}
					else {
						var url = href + "?r=ajax";
					}
				
					/* SHOW MODAL */
					showModal();
					
					/* REQUEST PAGE */
					jQuery.ajax({
						type: "POST",
						url: url,
					/* data: {"field": field,"sort":sort}, */
						dataType: "html"
					}).done(function(data) {
					
							
							//Reset Active Pages Color
							jQuery("#user_menu a").attr("style","color: #000");
							jQuery("#user_menu a."+myClass).attr("style","color: #a08f64");
							
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

/* HIDE SHIPPING AND PAYMENT CONTAINER ******************************************/
		/* Billing Contailer*/
		//jQuery("form.checkout #billing").css();
		/* Shipping Contailer*/
		//jQuery("form.checkout #shipping").css("display","none");
		/* Payment Contailer*/
		//jQuery("form.checkout #payment").css("display","none");
/* HIDE SHIPPING AND PAYMENT CONTAINER ******************************************/

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
