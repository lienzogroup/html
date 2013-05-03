<div <?php post_class();?>>

            <div class="row">
              
              <div class="span8">
              	<header>
                	<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a><i class="icon-file pull-right"></i></h1>
                </header>
              <?php if ( has_post_thumbnail() ) ?>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
              <?php the_post_thumbnail('post-index');?></a>
              </div>
              
              <div class="span8">
                <?php if ( is_single() ) : ?>
                	<?php the_content(); ?>
                <?php else : ?>
                	<?php the_excerpt(); ?>
                <?php endif; ?>
                <?php get_template_part( 'includes/post', 'meta' ); ?>
                
                <p class="tags"><i class="icon-tags"></i> <?php the_tags(' ',' '); ?></p>
               
              </div><!-- end .span8 -->
           
            </div><!-- .row -->
         
            </div><!-- end post class -->