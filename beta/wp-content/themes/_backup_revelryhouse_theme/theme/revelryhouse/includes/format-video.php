<div <?php post_class(); ?>>
            
            <div class="row">
              
              <div class="span8">
              	<header>
                	<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a><i class="icon-film pull-right"></i></h1>
                </header>
              </div>
              
              <div class="span8">
                <?php the_content();?>
                <?php get_template_part( 'includes/post', 'meta' ); ?>
                
                <p class="tags"><i class="icon-tags"></i> <?php the_tags(' ',' '); ?></p>
               
              </div><!-- end .span8 -->
           
            </div><!-- .row -->
         
            </div><!-- end post class -->