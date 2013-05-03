<?php
/**
 *
 * Description: Page template to display all archived posts.
 *
 */

get_header(); ?>

      <section class="middle">

				<div class="row">
	
					<?php if (is_category()) { ?>
				  <header id="page-title" class="span12">
            <div class="ribbon">
              <h1><span><?php _e('Posts in the Category:', 'reboot'); ?> <?php single_cat_title(); ?></span></h1>
            </div>
          </header>
					<?php } elseif (is_tag()) { ?> 
					<header id="page-title" class="span12">
					
              <h1><span><?php _e('Posts Tagged with:', 'reboot'); ?> <?php single_tag_title(); ?></span></h1>

          </header>
					<?php } elseif (is_author()) { ?>
					<header id="page-title" class="span12">
					
              <h1><span><?php _e('Posts By:', 'reboot'); ?> <?php $curauth = get_userdata( get_query_var('author') );  ?><?php echo $curauth->display_name; ?></span></h1>
        
          </header>
					<?php } elseif (is_day()) { ?>
					<header id="page-title" class="span12">
					
              <h1><span><?php _e('Daily Archives:', 'reboot'); ?> <?php the_time('F jS, Y'); ?></span></h1>
         
          </header>
					<?php } elseif (is_month()) { ?>
					<header id="page-title" class="span12">
         
              <h1><span><?php _e('Monthly Archives:', 'reboot'); ?> <?php the_time('F, Y'); ?></span></h1>
         
          </header>
					<?php } elseif (is_year()) { ?>
					<header id="page-title" class="span12">
          
              <h1><span><?php _e('Yearly Archives:', 'reboot'); ?> <?php the_time('Y'); ?></span></h1>
        
          </header>
					<?php } ?>

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



        </div><!-- end .row -->

      </section><!-- end .middle -->
        
    </div><!-- end .container -->

<?php get_footer(); ?>