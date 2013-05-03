
/* DOCUMENT READY */
jQuery(function() {
	
/* USER PROFILE **********************************************/
	
	jQuery("#user_container form#profile").submit(function() {
		var user_email = jQuery("#user_container form#profile input[name=user_email]").val();
		var user_pass = jQuery("#user_container form#profile input[name=user_pass]").val();
		var new_pass = jQuery("#user_container form#profile input[name=new_pass]").val();
		var confirm_pass = jQuery("#user_container form#profile input[name=confirm_pass]").val();
		// VALIDATION
		var errmsg = '';
		if(user_pass == '') {
			errmsg = 'Current password is requierd';
		}
		else if(new_pass == '') {
			errmsg = 'New password is requierd';
		}
		else if(new_pass != confirm_pass) {
			errmsg = 'New password not match';
		}
		
		if(errmsg) {
			jQuery("#user_container form#profile #errmsg").html(errmsg);
			jQuery("#user_container form#profile #errmsg").fadeIn();
		}
		else {
		
			jQuery("#user_container form#profile #errmsg").html('Trying to change password.');
			jQuery("#user_container form#profile #errmsg").fadeIn();
				/* REQUEST LOGIN */
				jQuery.ajax({
					type: "POST",
					url: apiURL + "change_pass",
					data: jQuery(this).serialize(),
					dataType: "html"
				}).done(function(data) {
					if(data == 1) {
						data = 'Password change success.';
						setTimeout(function() {
							window.location = homeURL + '/login';
						},1000);
					}
					jQuery("#user_container form#profile #errmsg").html(data);
					jQuery("#user_container form#profile #errmsg").fadeIn();
					return false;
				});
		}
		return false;
	});

/* USER PROFILE **********************************************/

	
	// /* PROFILE ******************************************/
	// jQuery("#rt_user_header a#profile").click(function() {
		// var mainContainer = "user_container";
		// var href = jQuery(this).attr("href");
		
		// /* CHECK IF THE CONTAINER EXIST */
		// var checkContainer = jQuery("#"+mainContainer).css('display');
		// if(checkContainer) {
			// /* HIDE THE CONTAINER*/
			// jQuery("#"+mainContainer).slideUp(1500);
		// }
		// else {
			// /* HIDE THE CONTAINER*/
			// jQuery(".container section").slideUp(1500);
		// }
		// /* SET LOADING MODAL HEIGHT */
		// var loading = "#loading_modal";
		// var wHeight = jQuery(document).height();
		// var css = "background: none repeat scroll 0 0 #000000;display: none; height: "+wHeight+"px;opacity: 0.3;position: absolute;text-align: center;vertical-align: middle;width: 100%;z-index: 99999;";
		// jQuery(loading).attr("style",css);
		// /* SHOW MODAL */
		// jQuery(loading).fadeIn();
		// /* REQUEST PAGE */
		// jQuery.ajax({
			// type: "POST",
			// url: href + "?r=ajax",
			// /* data: {"field": field,"sort":sort}, */
			// dataType: "html"
		// }).done(function(data) {
		
			// /* CHECK IF THE CONTAINER EXIST */
			// var checkContainer = jQuery("#"+mainContainer).css('display');
			// if(checkContainer) {
				// jQuery("#"+mainContainer).html(data);
				// /* SHOW THE CONTAINER*/
				// jQuery("#"+mainContainer).slideDown(1500);
			// }
			// else {(2);
				// jQuery(".container section").attr("style","margin:0 !important;width:100% !important; text-align:none !important;display:none;");
				// jQuery(".container section").html("<div id='"+mainContainer+"'>"+data+"</div>");
				// /* SHOW THE CONTAINER*/
				// jQuery(".container section").slideDown(1500);
			// }
			// /* HIDE MODAL*/
			// jQuery(loading).fadeOut();
			// return false;
		// });
		// return false;
	// })

	// /* CART *******************************************************/
	// jQuery("#rt_user_header a#cart").click(function() {
		// var mainContainer = "process_container";
		// var href = jQuery(this).attr("href");
		
		// /* CHECK IF THE CONTAINER EXIST */
		// var checkContainer = jQuery("#"+mainContainer).css('display');
		// if(checkContainer) {
			// /* HIDE THE CONTAINER*/
			// jQuery("#"+mainContainer).slideUp(1500);
		// }
		// else {
			// /* HIDE THE CONTAINER*/
			// jQuery(".container section").slideUp(1500);
		// }
		// /* SET LOADING MODAL HEIGHT */
		// var loading = "#loading_modal";
		// var wHeight = jQuery(document).height();
		// var css = "background: none repeat scroll 0 0 #000000;display: none; height: "+wHeight+"px;opacity: 0.3;position: absolute;text-align: center;vertical-align: middle;width: 100%;z-index: 99999;";
		// jQuery(loading).attr("style",css);
		// /* SHOW MODAL */
		// jQuery(loading).fadeIn();
		// /* REQUEST PAGE */
		// jQuery.ajax({
			// type: "POST",
			// url: href + "?r=ajax",
			// /* data: {"field": field,"sort":sort}, */
			// dataType: "html"
		// }).done(function(data) {
		
			// /* CHECK IF THE CONTAINER EXIST */
			// var checkContainer = jQuery("#"+mainContainer).css('display');
			// if(checkContainer) {
				// jQuery("#"+mainContainer).html(data);
				// /* SHOW THE CONTAINER*/
				// jQuery("#"+mainContainer).slideDown(1500);
			// }
			// else {(2);
				// jQuery(".container section").attr("style","margin:0 !important;width:100% !important; text-align:none !important;display:none;");
				// jQuery(".container section").html("<div id='"+mainContainer+"'>"+data+"</div>");
				// /* SHOW THE CONTAINER*/
				// jQuery(".container section").slideDown(1500);
			// }
			// /* HIDE MODAL*/
			// jQuery(loading).fadeOut();
			// return false;
		// });
		// return false;
	// });
});