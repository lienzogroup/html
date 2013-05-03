<?php
define('WP_USE_THEMES',false);
require_once('../beta/wp-load.php');
require_once('MCAPI.class.php');
require_once('mcapi-min.php');
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($_POST);
$msg="";
$merge="";
$api_lid=$igs['0']['id'];
$email_type = 'html';
$groupname="";
if(isset($_POST["user_name"])&&$_POST["user_name"]!="")
$merge['FNAME']=$_POST["user_name"];
if(isset($_POST["group_field"])&&$_POST["group_field"]!="")
{
   // print_r($_POST);
$group_field=$_POST["group_field"];
foreach($group_field as $field)
{
   $groupname.= $field.",";
}
$groupname=rtrim($groupname, ",");
//$merge_vars = array('GROUPINGS'=>array(array('id'=>22, 'groups'=>'Trains'),));
//$merge['GROUPINGS'][];
$merge['GROUPINGS'][]=array('id' => $api_lid, 'groups' => $groupname); 

}
$template_url=get_template_directory_uri();
$username = mysql_real_escape_string($_POST["user_email"]);
$password=$_POST["pass1"];
$zipcode = $_POST['zipcode'];
$birthdate = $_POST['yyyy']."-".$_POST['mm']."-".$_POST['dd'];
$double_optin=FALSE;
$update_existing=FALSE;
$replace_interests=TRUE;
$send_welcome=TRUE;
$retval = $api->listSubscribe( $list_id, $username, $merge, $email_type, $double_optin, $update_existing, $replace_interests, $send_welcome);
if (!$retval) {
        switch($api->errorCode) {
                case '105' : 
                        $errs[] = __("Please try again later", 'mailchimp_i18n').'.'; 
                        break;
                case '214' : 
                        $errs[] = __("You are already subscribed, please check your email for your confirmation email", 'mailchimp_i18n').'.'; 
                        break;
                case '250' : 
                        list($field, $rest) = explode(' ', $api->errorMessage, 2);					
                        $errs[] = sprintf(__("You must fill in %s.", 'mailchimp_i18n'), esc_html($mv_tag_keys[$field]['name']));
                        break;
                case '254' : 
                        list($i1, $i2, $i3, $field, $rest) = explode(' ',$api->errorMessage,5);
                        $errs[] = sprintf(__("%s has invalid content.", 'mailchimp_i18n'), esc_html($mv_tag_keys[$field]['name']));
                        break;
                case '270' : 
                        $errs[] = __("An invalid Interest Group was selected", 'mailchimp_i18n').'.';
                        break;
                case '502' : 
                        $errs[] = __("That email address is invalid", 'mailchimp_i18n').'.';
                        break;
                default:
                        $errs[] = $api->errorCode.":".$api->errorMessage;
                        break;
        }
        $success = false;
        if (count($errs) > 0) {
		$msg = '<div class="text"><h2>';
		foreach($errs as $error){
			$msg .= ''.esc_html($error).'<br />';
		}
		$msg .= '</h2></div>';
	}
       }
       	else {
              $status=wp_create_user($username, $password, $username);
               if (is_wp_error($status))
                {
                  $msg='<div class="text"><h2>User registration failed.</h2></div>';
                }
                else
                {
                    update_usermeta( $status, 'first_name', $user_name);
                    update_usermeta( $status, 'mcapi_groupings', $groupname);
                    update_usermeta( $status, 'birth_date', $birthdate);
                    update_usermeta( $status, 'zip_code', $zipcode);
                    $msg='<div class="logo">
    <a href="http://revelryhouse.com"><img src="splash/images/top-logo.png" /></a>
</div>
<div class="line">
    <img src="splash/images/vertical.png" />
</div><div class="text"><h2>'.esc_html(__("Fabulous! You’re In!", 'mailchimp_i18n')).'</h2></div>
                    <div class="tumbler">
                    <p style="font-family:"Didot W01 Roman", sans-serif;">We’re so glad you’ve joined the party. Keep an eye on your inbox for news about our official launch!</p>
                    <h2>Can’t wait a second longer?</h2>
					<h2 style="margin-top:1em;">Share with your friends!</h2>
                    </div>';
                 }
 		
	}
    
    
   echo '<div class="sign-in-header">
    <div class="logo"><img src="'.$template_url.'/images/top-logo.png" /></div>
    <div class="line"><img src="'.$template_url.'/images/vertical.png" /></div>
    </div>'.$msg.'<div class="bottom" style="width:100%;">
    <div class="left-line"><img src="splash/images/line-hor.png" /></div>
    <div class="middle" style="width:220px"><a href="http://www.facebook.com/RevelryHouse" target="_blank" class="fb-icon"></a><a href="https://twitter.com/RevelryHouse" target="_blank" class="tw-icon"></a><a href="http://revelryhouse.tumblr.com//" target="_blank" class="tumb-icon"></a><a href="http://pinterest.com/revelryhouse/" target="_blank" class="p-icon"></a></div>
    <div class="right-line"><img src="splash/images/line-hor.png" /></div> 
    </div>'; 
    
    
?>
