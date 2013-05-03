<?php
	$class1= '';
	$class2= '';
	$class3= '';
	$class4= '';
	if($slug == 'profile') {
		$class1 = 'active';
	}
	else if($slug == 'orders' || $slug == 'order_details') {
		$class4 = 'active';
	}
	if($slug == 'edit-address' && isset($_GET['address'])) {
		if(trim(strtolower($_GET['address'])) == 'billing') {
			$class2 = 'active';
		}
		else {
			$class3 = 'active';
		}
	}
?>

<div id="user_menu">
	<ul>
		<li>
			<a href="<?=get_home_url()?>/profile" id="profile" class="<?php echo $class1;?>">Profile</a>
		</li>
		<li>
			<a href="<?=get_home_url()?>/my-account/edit-address/?address=billing" id="billing" class="<?php echo $class2;?>">Billing</a>
		</li>
		<li>
			<a href="<?=get_home_url()?>/my-account/edit-address/?address=shipping" id="shipping" class="<?php echo $class3;?>">Shipping</a>
		</li>
		<li>
			<a href="<?=get_home_url()?>/orders" id="orders" class="<?php echo $class4;?>">Orders</a>
		</li>
	</ul>
</div>