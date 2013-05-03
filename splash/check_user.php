<?php
define('WP_USE_THEMES',false);
require_once('../beta/wp-load.php'); 
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//get the username
//$_POST['useremail']="mahesh@ritwik.com";
$username = mysql_real_escape_string($_POST['useremail']);

//mysql query to select field username if it's equal to the username that we check '
$result = mysql_query('select * from wp_users where user_login = "'.$username.'" OR  user_email="'.$username.'"');
//print_r($result);
//if number of rows fields is bigger them 0 that means it's NOT available '
if(mysql_num_rows($result)>0){
	//and we send 0 to the ajax request
	echo 0;
}else{
	//else if it's not bigger then 0, then it's available '
	//and we send 1 to the ajax request
	echo 1;
}
?>
