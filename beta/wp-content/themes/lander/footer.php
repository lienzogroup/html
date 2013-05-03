<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 */
?>
    </div><!-- end of #wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>
  
<div id="footer" class="footer clearfix">
<div class="foot-cont" id="footer-wrapper">
<div class="foot-left">
<a href="#">party@revelryhouse.com </a>
</div>

<ul class="foot-right">
<li><a href="#"><img src="<?php echo bloginfo('template_url');?>/images/last.png" /></a></li>
<li><a href="#"><img src="<?php echo bloginfo('template_url');?>/images/t.png" /></a></li>
<li><a href="#"><img src="<?php echo bloginfo('template_url');?>/images/twitt.png" /></a></li>
<li><a href="#"><img src="<?php echo bloginfo('template_url');?>/images/fb-img.png" /></a></li>
</ul>
</div>
</div><!-- end #footer -->
<!-- This script creates a new CanvasLoader instance and places it in the canvasloader div -->
	<script type="text/javascript">
		var cl = new CanvasLoader('canvasloader-container');
		cl.show(); // Hidden by default
		
		// This bit is only for positioning - not necessary
		  var loaderObj = document.getElementById("canvasLoader");
  		loaderObj.style.position = "absolute";
  		loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
  		loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    </script>
<?php wp_footer(); ?>
 
</body>
</html>