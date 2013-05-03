<?php
define('WP_USE_THEMES',false);
require_once('beta/wp-load.php'); 
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
global $wpdb, $user_ID;

/**
 * Home Page
 *
 * Note: You can overwrite home.php as well as any other Template in Child Theme.
 * Create the same file (name) include in /responsive-child-theme/ and you're all set to go!
 * @see            http://codex.wordpress.org/Child_Themes
 *
 * @file           home.php
 */
?>
<?php get_header('splash');?>

<?php //displaying check boxs as image ?>

<?php //echo "test"; print_r($_POST) ?>
<div id="featured" class="grid col-940">
<div class="sign-in-sec">

<div class="sign-in-header">
<div class="logo">
    <img src="<?php bloginfo('template_url') ?>/images/top-logo.png" />
</div>
<div class="line">
    <img src="<?php bloginfo('template_url') ?>/images/vertical.png" />
</div>
</div>
     
<div class="splash">
     <h1>Welcome to Revelry House!</h1>
<p>Thank you for Joining The Party.  We created Revelry House for the modern host and hostess who love to throw parties as much as we do.  We’re so excited to share our beautiful products (all-in-one party boxes!), along with recipes, design ideas, amazing playlists, and more. </p>
<p>We appreciate your support and can’t wait to celebrate with you!  We’re launching ASAP and you’ll be the first to know.</p>
 <p>Love,<br />
Your Fave Party Girls (and Co-Founders)<br />
Christianne and Lo</p>

</div>

</div>
       
</div><!-- end of #featured -->


<?php //get_sidebar('home'); ?>
<?php get_footer(); ?>
