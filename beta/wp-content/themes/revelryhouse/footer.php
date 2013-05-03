<?php wp_enqueue_script('custom-js', get_template_directory_uri() .'/js/magazine.js'); ?>




<?php include('footer-main-menu.php'); ?>

		<?php global $data; echo $data['google_analytics']; ?>
		

<?php wp_footer(); ?>
<script>
	var condensed = false;
	jQuery(window).scroll(function() {
		if(jQuery(window).scrollTop() > 80 && condensed == false) { 
		
			condensed = true;
		
				jQuery("#nav-wrapper ul").addClass('');
				// jQuery(".top-logo").attr('id','condensed');
				// jQuery(".top-logo img").attr('src',homeURL+'/wp-content/themes/revelryhouse/img/condensed_main_logo.png');
				jQuery(".top-logo#big").fadeOut(250);
				
				
				// jQuery("#process_nav").addClass('condensed');
				// jQuery("#process_container").addClass('condensed');
				// jQuery(".container").attr('id','condensed');

		
		}
		
		else if(jQuery(window).scrollTop() > 80 && condensed == false) {
		
			condensed = true;
		
				jQuery("#nav-wrapper ul").addClass('');
				// jQuery(".top-logo").attr('id','condensed');
				// jQuery(".top-logo img").attr('src',homeURL+'/wp-content/themes/revelryhouse/img/condensed_main_logo.png');
				jQuery(".top-logo#big").fadeOut(250);
				
				
				// jQuery("#process_nav").addClass('condensed');
				// jQuery("#process_container").addClass('condensed');
				// jQuery(".container").attr('id','condensed');

		
		}
		
		else if(jQuery(window).scrollTop() == 0 && condensed == true){
		
			condensed = false;
		
				jQuery("#nav-wrapper ul").removeClass();
				// jQuery(".top-logo").attr('id','');
				// jQuery(".top-logo img").attr('src',homeURL+'/wp-content/themes/revelryhouse/img/rev_logo.png');
				jQuery(".top-logo#big").fadeIn(250);
				
				// jQuery("#process_nav").removeClass();
				// jQuery("#process_container").removeClass();
				// jQuery(".container").attr('id','');
		}
	});
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
$(window).scroll(function(){
    if  ($(window).scrollTop() >= 80){
         $('#nav-wrapper').css({position:'fixed',top:'40px'});
		 $("#nav-wrapper").removeClass('slideDown-0_2s');
		 $("#nav-wrapper").addClass('slideDown-1_5s');
		 $('#nav-wrapper').css({height:'50px'});
		 
		 $(".top-logo#small").removeClass('slideDown-0_2s');
		 $(".top-logo#small").addClass('slideDown-1_5s');
		 $(".top-logo#small").addClass('fadeIn');
		 $(".top-logo#small").removeClass('fadeOut');
		 $('.top-logo#small').css({top:'52px'});
		 
		 $('#top-nav-left').css({top:'14px'});
		 $('#top-nav-right').css({top:'14px'});
		  
		  

    
	} else {
         $('#nav-wrapper').css({position:'absolute',top:0});
		 $('#nav-wrapper').css({height:'112px'});
		 
		 
		 $('.top-logo#small').css({top:'-32px'});
		 $(".top-logo#small").addClass('fadeOut');
		 $(".top-logo#small").removeClass('fadeIn');
		 
		 $('#top-nav-left').css({top:'66px'});
		 $('#top-nav-right').css({top:'66px'});

		 
		 
        }
});
});
 </script>
 
 
<style>
	<!-- #nav-wrapper ul.condensed { height: 90px !important; transition-duration: 0.5s;
    transition-property: height, padding-top;transition-timing-function: ease-out;}
	 #nav-wrapper ul.condensed div { width: 10% !important;}
	#nav-wrapper ul.condensed div#top-nav-left,
	#nav-wrapper ul.condensed div#top-nav-right 
	{ top: 57px !important; width: 45% !important;}-->
	.top-logo#condensed { height: 49px; margin-top: 61px; width: 50px;}
	.top-logo#condensed img{ margin-top: 13px;}
	
	<!-- 
	#process_nav.condensed {position: fixed; top: -35px; width: 100%; z-index: 99;height: 130px;}
	#process_nav.condensed div{top: 10px;}
	#process_container.condensed{margin-top: 190px;}
	#process_container.condensed div{}
	.container#condensed{margin-top: -20px;} -->
	
	#copyright-and-credits #condensed.container,
	#footer #condensed.container
	{margin-top: 0px !important;}
</style>
</body> 

</html>