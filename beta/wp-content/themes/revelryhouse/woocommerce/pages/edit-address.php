<div id="billing">
	<?php
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post();
				the_content(); 
			endwhile;  
		endif; 
	?>
</div>

<style>
	#content #billing label {
		text-transform: uppercase;
		margin-bottom: 10px;
		color: #A08F64;
		font-family: 'UniversLTW01-49LightUlt';
		font-size: 18px;
	}
	
	#content #billing input {
	border: none;
	border-bottom: 1px solid;
	border-radius: 0;
	font-size: 32px;
	overflow: visible;
	color: #000;
	}
	
	#content #billing #city{
	float:left;	
	margin-right: 40px;
	}
	
	#content #billing #input1 {
		width:500px;
	}
	
	#content #billing #input2 {
		width:320px;
	}
	
	#content #billing #input3 {
		width:130px;
	}
	
	
	#content #billing select#shipping_country,
	#content #billing select#billing_country {
		border-radius: none;
		border: none;
		border-bottom: 1px solid black;
		font-size: 32px;
		height: 53px;
		margin: 27px 0 0 -420px;
		position: absolute;
		width: 418px;
		font-family: 'Didot W01 Bold';
	}
	
	#content #billing select#shipping_state,
	#content #billing select#billing_state {
		border-radius: none;
		border: none;
		border-bottom: 1px solid black;
		font-size: 32px;
		height: 53px;
		margin: -27px 0 0;
		position: absolute;
		width: 418px;
		font-family: 'Didot W01 Bold';
		border-radius: 0;
	}
	#content #billing h3 {
	}
</style>

<script>
jQuery(function(){

/* USER ADDRESS SUBMIT ******************************************/

	/* CHEHCK FORM BILLING OR SHIPPING */
	var userContainerData = '';
	var mainContainer = "#user_container #content #sliderContainer";
	if(userCurrentPage == 'billing') {
		userContainerData = mainContainer + " > #billing";
	}
	else if(userCurrentPage == 'shipping') {
		userContainerData = mainContainer + " #shipping";
	}
	
	/* for Billing and Shipping Form */
	if(userContainerData) {
		
		jQuery(userContainerData+ ' form').submit(function(){ 
		
			/* Validation */
			var errmsg = "";
			if(jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_first_name]").val()) == '') {
				errmsg = 'first name';
			}
			else if(jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_last_name]").val()) == '') {
				errmsg = 'last name';
			}
			else if (jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_address_1]").val()) == '') {
				errmsg = 'address';
			}
			else if( jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_city]").val()) == '') {
				errmsg = 'town/city';
			}
			else if(jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_postcode]").val()) == '') {
				errmsg = 'postcode/zip';
			}
			else if(jQuery.trim(jQuery(userContainerData+" #"+userCurrentPage+"_country").val()) == '') {
				errmsg = 'first name';
			}
			else if(jQuery.trim(jQuery(userContainerData+" #"+userCurrentPage+"_state").val()) == '') {
				errmsg = 'state/country';
			}
			else if(userCurrentPage == 'billing') {
				if(jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_email]").val()) == '') {
					errmsg = 'email address';
				}
				if(jQuery.trim(jQuery(userContainerData+" input[name="+userCurrentPage+"_phone]").val()) == '') {
					errmsg = 'phone';
				}
			}			
			/* End Validation */
			
			if(errmsg) {
					/* GET HREF VALUE */
					var myClass = jQuery(this).attr("class");
					formAction = jQuery(userContainerData + ' form').attr('action');
					form = jQuery.trim(jQuery(userContainerData + ' form h3').html()).toLowerCase();
					
					/* SHOW MODAL */
					showModal();
				
					/* REQUEST PAGE */
					jQuery.ajax({
						type: "POST",
						url: formAction + "&r=ajax",
						data: jQuery(this).serialize(),
						dataType: "html"
					}).done(function(data) {
					
						/* UPDATE CONTENT */
						jQuery(userContainerData).html(data);
				
						/* Set Height */
						var pageHeight = jQuery(userContainerData).css('height');
						//jQuery(mainContainer).css('height',pageHeight);
						jQuery(mainContainer).animate({
							height: pageHeight
						}, 1000, function() {
						// Animation complete.
						});
						
							/* HIDE MODAL */
							hideModal();
							return false;
					});
					
				return false;
			}
		});
	
	}
/* USER ADDRESS SUBMIT ******************************************/

	// Auto Clear	
	// var lastInputValue = '';
	// jQuery(function(){ 
		// jQuery('input[type=input],input[type=text]').focus(function() { 
			// lastInputValue = jQuery(this).val();
			// jQuery(this).val('');
		// });
		// jQuery('input[type=input],input[type=text]').focusout(function() {
			// var current_val = jQuery.trim(jQuery(this).val());
			// if(current_val == '') {
				// jQuery(this).val(lastInputValue);
			// }
		// });
	// });
})
</script>
