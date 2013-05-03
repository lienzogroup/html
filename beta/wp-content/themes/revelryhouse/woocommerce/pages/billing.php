<?php
$user_meta = get_user_meta($current_user->ID);
$billing['nickname'] = isset($user_meta['nickname']) ? $user_meta['nickname'] : '';
$billing['first_name'] = isset($user_meta['first_name']) ? $user_meta['first_name'] : '';
$billing['last_name'] = isset($user_meta['last_name']) ? $user_meta['last_name'] : '';

$billing['shipping_last_name'] = isset($user_meta['shipping_last_name']) ? $user_meta['shipping_last_name'] : '';
$billing['shipping_first_name'] = isset($user_meta['shipping_first_name']) ? $user_meta['shipping_first_name'] : '';
$billing['shipping_company'] = isset($user_meta['shipping_company']) ? $user_meta['shipping_company'] : '';
$billing['shipping_address_1'] = isset($user_meta['shipping_address_1']) ? $user_meta['shipping_address_1'] : '';
$billing['shipping_address_2'] = isset($user_meta['shipping_address_2']) ? $user_meta['shipping_address_2'] : '';
$billing['shipping_city'] = isset($user_meta['shipping_city']) ? $user_meta['shipping_city'] : '';
$billing['shipping_postcode'] = isset($user_meta['shipping_postcode']) ? $user_meta['shipping_postcode'] : '';
$billing['shipping_state'] = isset($user_meta['shipping_state']) ? $user_meta['shipping_state'] : '';
$billing['shipping_country'] = isset($user_meta['shipping_country']) ? $user_meta['shipping_country'] : '';

$billing['billing_email'] = isset($user_meta['billing_email']) ? $user_meta['billing_email']  : '';
$billing['billing_phone'] = isset($user_meta['billing_phone']) ? $user_meta['billing_phone'] : '';
$billing['billing_country'] = isset($user_meta['billing_country']) ? $user_meta['billing_country'] : '';
$billing['billing_state'] = isset($user_meta['billing_state']) ? $user_meta['billing_state'] : '';
$billing['billing_postcode'] = isset($user_meta['billing_postcode']) ? $user_meta['billing_postcode'] : '';
$billing['billing_city'] = isset($user_meta['billing_city']) ? $user_meta['billing_city'] : '';
$billing['billing_address_2'] = isset($user_meta['billing_address_2']) ? $user_meta['billing_address_2'] : '';
$billing['billing_company'] = isset($user_meta['billing_company']) ? $user_meta['billing_company'] : '';
$billing['billing_address_1'] = isset($user_meta['billing_address_1']) ? $user_meta['billing_address_1'] : '';
$billing['billing_last_name'] = isset($user_meta['billing_last_name']) ? $user_meta['billing_last_name'] : '';
$billing['billing_first_name'] = isset($user_meta['billing_first_name']) ? $user_meta['billing_first_name'] : '';
// print '<pre>';
// print_r($billing);
// print '</pre>';
?>
<div id="billing">
	<label>NAME</label><br />
	<input id="input1" type="text" value=""/><br />
	<label>ADDRESS</label><br />
	<input id="input1" type="text" value=""/><br />
	<label>APT. #, FLOOR, ETC.</label><br />
	<input id="input1" type="text" value=""/><br />
	<div id="city">
		<label>CITY</label><br />
		<input id="input2" type="text" value=""/>
	</div>
	
	<label>STATE</label><br />
	<input id="input3" type="text" value=""/><br />
	<label>ZIP CODE</label><br />
	<input id="input2" type="text" value=""/><br />
	<label>WHERE IS THIS?</label><br />
	<input id="input2" type="text" value="e.g. 'work'" style="color:#b2b2b2"/>
</div>

<style>
	#content #billing {
		margin-left: 70px;
	}
	
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
	font-size: 25px;
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
	
</style>