<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Image Attachment Template
 *
 *
 * @file           image.php
 * @package        Responsive 
 */
?>
<?php get_header(); ?>

        <div id="content-images" class="grid col-620">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
          
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="post-title"><?php the_title(); ?></h1>
                <p><?php _e('&#8249; Return to', 'responsive'); ?> <a href="<?php echo get_permalink($post->post_parent); ?>" rel="gallery"><?php echo get_the_title($post->post_parent); ?></a></p>

                <div class="post-meta">
                <?php responsive_post_meta_data(); ?>
                
				    <?php if ( comments_open() ) : ?>
                        <span class="comments-link">
                        <span class="mdash">&mdash;</span>
                    <?php comments_popup_link(__('No Comments &darr;', 'responsive'), __('1 Comment &darr;', 'responsive'), __('% Comments &darr;', 'responsive')); ?>
                        </span>
                    <?php endif; ?> 
                </div><!-- end of .post-meta -->
                                
                <div class="attachment-entry">
                    <a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a>
					<?php if ( !empty($post->post_excerpt) ) the_excerpt(); ?>
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->

               <div class="navigation">
	               <div class="previous"><?php previous_image_link( 'thumbnail' ); ?></div>
			      <div class="next"><?php next_image_link( 'thumbnail' ); ?></div>
		       </div><!-- end of .navigation -->
                        
                <?php if ( comments_open() ) : ?>
                <div class="post-data">
				    <?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
                    <?php the_category(__('Posted in %s', 'responsive') . ', '); ?> 
                </div><!-- end of .post-data -->
                <?php endif; ?>             

            <div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div>             
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
			<?php comments_template( '', true ); ?>
            
        <?php endwhile; ?>  

	    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
        <p><?php _e('Don\'t panic, we\'ll get through this together. Let\'s explore our options here.', 'responsive'); ?></p>
        <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'home', 'responsive' ); ?>"><?php _e( '&larr; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
        <?php get_search_form(); ?>

<?php endif; ?>  
      
        </div><!-- end of #content-image -->

<?php get_sidebar('gallery'); ?>
<?php get_footer(); ?>
