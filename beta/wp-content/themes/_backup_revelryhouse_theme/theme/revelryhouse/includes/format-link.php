<div <?php post_class(); ?>>
            
            <div class="row">
              
              <div class="span8">
              	<header>
                	<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title();?></a><i class="icon-link pull-right"></i></h1>
                </header>
              </div>
              
              <div class="span8">
                <?php the_content();?>
                <?php get_template_part( 'includes/post', 'meta' ); ?>
               
              </div><!-- end .span8 -->
           
            </div><!-- .row -->
         
            </div><!-- end post class -->