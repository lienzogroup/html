<?php
/*
Template Name:Signup Page
*/
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb, $user_ID;
//Check whether the user is already logged in
if (!$user_ID) {

	if($_POST){
		//We shall SQL escape all inputs
		$username = $wpdb->escape($_REQUEST['username']);
		if(empty($username)) {
			echo "User name should not be empty.";
			exit();
		}
		$email = $wpdb->escape($_REQUEST['email']);
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
			echo "Please enter a valid email.";
			exit();
		}

			$random_password = wp_generate_password( 12, false );
			$status = wp_create_user( $username, $random_password, $email );
			if ( is_wp_error($status) )
				echo "Username already exists. Please try another one.";
			else {
				$from = get_option('admin_email');
		                $headers = 'From: '.$from . "\r\n";
		                $subject = "Registration successful";
		                $msg = "Registration successful.\nYour login details\nUsername: $username\nPassword: $random_password";
		                wp_mail( $email, $subject, $msg, $headers );
				echo "Please check your email for login details.";
			}

		exit();

	} else {
		get_header('splash');
?>
<!-- <script src="http://code.jquery.com/jquery-1.4.4.js"></script> -->
<!-- Remove the comments if you are not using jQuery already in your theme -->
<div id="container">
<div id="content">
<?php if(get_option('users_can_register')) { 
//Check whether user registration is enabled by the administrator ?>

<h1><?php the_title(); ?></h1>
<div id="result"></div> <!-- To hold validation results -->
<form action="" method="post">
    <div id='availability_result'></div>

<label>email address</label><input type="text" id="useremail" class="textfill" onblur="javascript:if(this.value==''){ this.value='lauren@revelryhouse.com'; }" onfocus="javascript:if(this.value=='lauren@revelryhouse.com'){this.value='';}" value="lauren@revelryhouse.com" name="name">
    
<label>Password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='********'; }" onfocus="javascript:if(this.value=='********'){this.value='';}" value="********" name="pass1" id="pass1">

<label>confirm password</label><input type="password" class="password" onblur="javascript:if(this.value==''){ this.value='00000000'; }" onfocus="javascript:if(this.value=='00000000'){this.value='';}" value="00000000" name="pass2" id="pass2">

<input type="button" id="submitbtn" name="submit" value="SignUp" />
</form>

<?php } else echo "Registration is currently disabled. Please try again later."; ?>
</div>
</div>
<?php
    get_footer();
 } //end of if($_post)

}
else {
	wp_redirect( home_url() ); exit;
}
?>

