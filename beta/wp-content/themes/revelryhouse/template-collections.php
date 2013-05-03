<?php
/**
 *
 * Template Name: Collections Page
 * Description: Page template to display the custom Collections.
 *
 */

get_header(); ?>

<div class="clear"></div>

<section class="middle" style="margin: 185px auto 0;text-align: center;width: 1100px;">

<div class="collections-header-title">
COLLECTIONS
</div>
	 
	  <div style="margin-top: 40px; text-align: center;" class="collections">
      		<div class="new-collections">                                    
<?php 
				$args = array('post_type' => 'collections', 'posts_per_page' => 3, 'category_name' => 'collection-new');
      			$loop = new WP_Query($args);
      			while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      				<article class="latest-article">

      					<div class="view view-first">
      						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> 
							<div class="due-diligence" style="background: url(<?php bloginfo('template_url'); ?>/img/new-order-icon.png) no-repeat 28px 28px; height: 380px; position: absolute; z-index: 1; display: inline;"></div>
      						<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '1100x380' ); } ?>
      				         </a>  
      					</div><!-- end .view view-first -->
      				</article><!-- end .latest-article -->
      	
      			<?php endwhile; ?> 
                  </div>
                  
                
                <div class="preorder-collections">                                    
<?php 
				$args = array('post_type' => 'collections', 'posts_per_page' => 3, 'category_name' => 'collection-pre-order');
      			$loop = new WP_Query($args);
      			while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      				<article class="latest-article">

      					<div class="view view-first">
      						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
							<div class="due-diligence" style="background: url(<?php bloginfo('template_url'); ?>/img/pre-order-icon.png) no-repeat 28px 28px; height: 380px; position: absolute; z-index: 1; display: inline;"></div> 
      						<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '1100x380' ); } ?>
      				        </a>  
      					</div><!-- end .view view-first -->
      				</article><!-- end .latest-article -->
      	
      			<?php endwhile; ?>
                  </div>
                 
				 
				
                  <div class="normal-collections">                                    
<?php 
				$args = array('post_type' => 'collections', 'posts_per_page' => 6, 'category__not_in' => array( 23, 26 ));
      			$loop = new WP_Query($args);
      			while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      				<article class="latest-article">

      					<div class="view view-first" style="display: inline-block;outline:4px solid #FFFFFF;">
      						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      						<!-- <div style="width: 365px; height: 268px; position: absolute; z-index: 99999; outline: 2px solid rgb(255, 255, 255); display: inline;"></div> -->
							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '365x268' ); } ?>
      				        </a>      		
      					</div><!-- end .view view-first -->
      				</article><!-- end .latest-article -->
      			<?php endwhile; ?>  
                  </div>				                               
              </div><!-- end row -->			  
</section><!-- end --> 

<div class="clear"></div> 
<br><br><br><br><br>
   
<?php get_footer(); ?>