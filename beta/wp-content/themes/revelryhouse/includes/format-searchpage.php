<div <?php post_class(); ?>>
            
            <div class="row">
              
              <div class="span12">
              	     
					 
					 <?php get_search_form(); ?>
					 
					 
              <?php if ( has_post_thumbnail() ) ?>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
              <?php the_post_thumbnail('post-index');?></a>
              </div>
              
              <div class="span12">
                <?php if ( is_single() ) : ?>
                	<?php the_content(); ?>
                <?php else : ?>
                	<?php the_excerpt(); ?>
                <?php endif; ?>
                <?php get_template_part( 'includes/post', 'searchpage' ); ?>
                
                <p class="tags" style="display:none"><i class="icon-tags"></i> <?php the_tags(' ',' '); ?></p>
               
              </div><!-- end .span12 -->
           
            </div><!-- .row -->
         
            </div><!-- end post class -->