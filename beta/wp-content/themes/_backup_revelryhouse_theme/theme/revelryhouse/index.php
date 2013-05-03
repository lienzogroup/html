<?php
/**
 *
 * Description: Page template to display all blog posts.
 *
 */

get_header(); ?>

      <section class="middle">
          
        <div class="row">
                    
          <header id="page-title" class="span12">
            <div class="ribbon">
              <h1><span><?php wp_title(''); ?></span></h1>
            </div>
          </header>
                    
        </div><!-- end .row -->
                   
        <div class="row">

          <div class="blog-index span8">
	        <?php
	        if (have_posts()) :
	        while (have_posts()) : the_post();
	        if(!get_post_format()) {
	        	get_template_part('includes/format', 'standard');
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

          </div><!-- end .blog-index -->

<?php get_sidebar(); ?>

        </div><!-- end .row -->

      </section><!-- end .middle -->
        
    </div><!-- end .container -->

<?php get_footer(); ?>