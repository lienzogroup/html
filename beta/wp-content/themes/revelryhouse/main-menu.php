<?php
	$active1 = '';
	$active2 = '';
	$active3 = '';
	$active4 = '';
	$active5 = '';
	$active6 = '';
	$active7 = '';
	
	$url = $_SERVER["REQUEST_URI"];
	if(strstr($url,'collections')) {
		$active1 = 'active';
	}
	else if(strstr($url,'guides')) {
		$active2 = 'active';
	}
	else if(strstr($url,'magazine')) {
		$active3 = 'active';
	}
	else if(strstr($url,'decorations')) {
		$active4 = 'active';
	}
	else if(strstr($url,'tableware')) {
		$active5 = 'active';
	}
	else if(strstr($url,'novelty')) {
		$active6 = 'active';
	}
	else if(strstr($url,'magazines')) {
		$active7 = 'active';
	}
?>
<style>
	#nav-wrapper ul li.active{
		background: url(<?=get_template_directory_uri();?>/woocommerce/img/header-bottom-line-1.jpg) no-repeat transparent;
		background-position: bottom;
		padding-bottom: 10px;;
		background-size: 100% 6px;
	}
	#nav-wrapper ul li.active a{color:#bfb497;}
</style>
  
  <div class="top-logo fadeOut" id="small">
	  <a href="<?php bloginfo('url'); ?>">
		<img class="logo-image" src="<?php bloginfo('template_url'); ?>/img/condensed_main_logo.png">
	  </a>
  </div>
  
  <div class="top-logo" id="big">
	  <a href="<?php bloginfo('url'); ?>">
		<img class="logo-image" src="<?php bloginfo('template_url'); ?>/img/rev_logo.png">
	  </a>
  </div>

		
  
  
  
  <div id="nav-wrapper-under">
  
  </div><!-- end #nav-wrapper-under -->	
  
  
   
<div id="nav-wrapper">
<div style="width:100%;height:40px;position:absolute;" class=""></div>


<div id="sticky-main">
<ul>
	<div id="top-nav-left" style="width:40%;float:left; text-align: left;position: relative;top:66px;">
		<li class="<?=$active1?>"><a href="<?php bloginfo('url'); ?>/collections">COLLECTIONS</a></li>
		<li class="<?=$active2?>"><a href="<?php bloginfo('url'); ?>/guides/">GUIDES</a></li>
		<li class="<?=$active3?>"><a href="<?php bloginfo('url'); ?>/magazine">MAGAZINE</a></li>
	</div>
	
	<div style="width:20%;float:left;position: relative;top: 50%;">&nbsp;</div>
	
	<div id="top-nav-right" style="width:40%;float:right; text-align: right;position: relative;top:66px;">
		<li class="<?=$active4?>"><a href="#">DECORATIONS</a></li>
		<li class="<?=$active5?>"><a href="#">TABLEWARE</a></li>
		<li class="<?=$active6?>"><a href="#">NOVELTY</a></li>
		<li><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/search_btn.png"></a></li>
	</div>
</ul>
</div><!-- end sticky-main -->
		  			  		
</div><!-- end .row -->
