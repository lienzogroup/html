<?php
/**
 *
 * Description: Page template to display archived portfolio projects.
 *
 */

get_header(); ?>

      <section class="middle">
          
        <div class="row">
          
          <header id="page-title" class="span12">
						<div class="ribbon">
              <h1><span><?php _e('Project-Type Archives:', 'reboot'); ?> <?php single_cat_title(); ?></span></h1>
            </div>
          </header>
                    
        </div><!-- end .row -->
                   
        <div class="row">

        <div class="blog-index span8">
          <?php global $query_string; query_posts( $query_string . '&posts_per_page=-1&orderby=menu_order&order=ASC'); ?>
	
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
			<div id="taxonomy-listing">
            
	            <div <?php post_class(); ?>>
	            
		            <div class="row">
		              
		              <div class="span8">
		              	<header>
		                	<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a></h1>
		                </header>
		              <?php if ( has_post_thumbnail() ) ?>
		                <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		              <?php the_post_thumbnail('post-index');?></a>
		              </div>
		              
		              <div class="span8">
		                <?php the_excerpt();?>
		               
		              </div><!-- end .span8 -->
		           
		            </div><!-- .row -->
	         
            	</div><!-- end post class -->
            
            </div><!-- end #taxonomy-listing -->
  
            <?php endwhile; endif; ?>
       
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