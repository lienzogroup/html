<?php
/**
 * Template Name: Search Page
 * Description: Template for the Search Results page.
 *
 */

get_header(); ?>


      <section class="middle"> 
  
        <div class="row">

          <div class="blog-index span12">

            <div class="posts">

    				<?php if ( ! have_posts() ) : ?>
    					<div class="not-found">
    						<h1><?php echo __( 'Nothing Found!', 'reboot' ); ?></h1>
    						<p><?php echo __( 'Sorry, but no results were found. Please try the search again?', 'reboot' ); ?></p>
    					</div>
    				<?php endif; ?>

    				<?php
    				     if (have_posts()) :
    				     while (have_posts()) : the_post();
    				     if(!get_post_format()) {
    				     	get_template_part('includes/format', 'searchpage');
    				     } else {
    				        get_template_part('includes/format', get_post_format());
    				     }
    				     endwhile;
    				     endif;
    						?>
    				
    				     <?php if(function_exists('wp_pagenavi')) { ?>
    				     <?php wp_pagenavi(); ?>   
    				     <?php } else { ?>      
    				       <div class="post-navigation"><p><?php posts_nav_link('&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;'); ?></p></div>
    				     <?php } ?> 
               
            </div><!-- end .posts -->

          </div><!-- end .content -->

<?php get_sidebar(); ?>
         
      </section><!-- end .middle -->

    </div><!-- end .container -->

	



<?php get_footer(); ?>
