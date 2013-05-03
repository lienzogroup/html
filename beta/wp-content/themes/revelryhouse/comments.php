<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php echo __( 'This post is password protected. Enter the password to view comments.', 'reboot' ); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
 
<?php if ( have_comments() ) : ?>

<h3 id="comments" class="comments-title"><?php comments_number( __( 'No Comments', 'reboot' ), __( '1 Comment', 'reboot' ), __( '% Comments', 'reboot' ) );?></h3>
 
<div class="navigation">
    <div class="alignleft"><?php previous_comments_link() ?></div>
    <div class="alignright"><?php next_comments_link() ?></div>
</div>
 
<ol class="commentlist">
    <?php wp_list_comments( array( 'avatar_size' => 60 ) ); ?>
</ol>

<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php echo __( 'Comments are closed.', 'reboot' ); ?></p>
 
<?php endif; ?>
<?php endif; ?>
 
<?php if ('open' == $post->comment_status) : ?>
 
<div id="respond" class="respond row">

    <div class="span8">
        <h3><?php echo __( 'Leave a Comment', 'reboot' ); ?></h3>
    </div>
    
    <div class="span8">
 
        <div class="cancel-comment-reply">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>
     
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
            <p><?php echo __( 'You must be', 'reboot' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php echo __( 'logged in', 'reboot' ); ?></a> <?php echo __( 'to post a comment.', 'reboot' ); ?></p>
        <?php else : ?>
     
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="validate-form">
     
            <?php if ( $user_ID ) : ?>
         
            <p><?php echo __( 'Logged in as', 'reboot' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php echo __( 'Log out &raquo;', 'reboot' ); ?></a></p>
         
            <?php else : ?>
         
            <p>
                <label for="author"><?php echo __( 'Your name', 'reboot' ); ?> <span class="required"><?php if ($req) echo "*"; ?></span></label>
                <input type="text" name="author" id="author" class="input required span5" placeholder="<?php echo __( 'Please enter your name.', 'reboot' ); ?>" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
            </p>
         
            <p>
                <label for="email"><?php echo __( 'Your email', 'reboot' ); ?> <span class="required"><?php if ($req) echo "*"; ?></span></label>
                <input type="text" name="email" id="email" class="input required email span5" placeholder="<?php echo __( 'This will not be published.', 'reboot' ); ?>" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
            </p>
         
            <p>
                <label for="url"><?php echo __( 'Website', 'reboot' ); ?></label>
                <input type="text" name="url" id="url" class="input span5" placeholder="<?php echo __( 'Your website (optional)', 'reboot' ); ?>" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
            </p>
         
            <?php endif; ?>
         
            <p>
                <label for="comment"><?php echo __( 'Your message', 'reboot' ); ?> <span class="required"><?php if ($req) echo "*"; ?></span></label>
                <textarea name="comment" id="comment" class="input textarea required span5" placeholder="<?php echo __( 'Please leave a reply...', 'reboot' ); ?>" cols="100%" rows="10" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?>></textarea>
            </p>
         
            <p>
                <input name="submit" type="submit" id="submit" class="btn-inverse btn-large" tabindex="5" value="Submit comment" />
                <?php comment_id_fields(); ?>
            </p>
            
            <?php do_action('comment_form', $post->ID); ?>
            
        </form>
     
        <?php endif; // If registration required and not logged in ?>
    
    </div>
</div>
 
<?php endif; // if you delete this the sky will fall on your head ?>