<?php
	$class1 = '';
	$class2 = '';
	$class3 = '';
	$class4 = '';
	$class5 = '';
	// Get WP Page slug
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if($slug == 'cart') {
		$class1 = 'active';
		$class2 = 'pending';
		$class3 = 'pending';
		$class4 = 'pending';
		$class5 = 'pending';
	}
	else if($slug == 'checkout') {
		$class2 = 'active';
		$class3 = 'pending';
		$class4 = 'pending';
		$class5 = 'pending';
	
	}
	else if(isset($_GET['order_id']) && $_GET['order_id'] > 0) {
		$class4 = 'active';
		$class5 = 'pending';
	
	}
	else if($slug == 'confirmation') {
		$class5 = 'active';
	}
?>

<div class="process_logo">
	<a href="<?php bloginfo('url'); ?>">
		<img class="logo-image" src="<?php bloginfo('template_url'); ?>/img/rev_foot_logo.png">
	</a>
</div>

<div id="process_nav">
	<div id="nav_containter">
		<ul>
			<li>
				<a href="#" class="<?php echo $class1; ?>" id="step1" onclick="return false;">YOUR PARTY</a></li>
			<li>
				<a href="#" class="<?php echo $class2; ?>" id="step2" onclick="return false;">BILLING</a></li>
			<li>
				<a href="#" class="<?php echo $class3; ?>" id="step3" onclick="return false;">SHIPPING</a></li>
			<li>
				<a href="#" class="<?php echo $class4; ?>" id="step4" onclick="return false;">PAYMENT</a></li>
			<li>
				<a href="#" class="<?php echo $class5; ?>" id="step5" onclick="return false;">CONFIRMATION</a>			
			</li>			
		</ul>
	</div>
</div><!-- end .row -->

<style>
	#process_nav #nav_containter a.active {
		background: url("http://s159842.gridserver.com/beta/wp-content/themes/revelryhouse/woocommerce/img/header-bottom-line.jpg") no-repeat scroll center bottom transparent;
		color: #A08F64;
	}
	#process_nav #nav_containter a.pending {
		color: #555555;
	}
	#process_nav #nav_containter a {
		cursor: default;
    display: block;
    width: 100%;
	}
</style>