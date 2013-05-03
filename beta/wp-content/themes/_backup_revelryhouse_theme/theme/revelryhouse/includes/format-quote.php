<div <?php post_class(); ?>>
            
            <div class="row">
              
              <div class="span8">
                <?php the_content();?>
                <?php get_template_part( 'includes/post', 'meta' ); ?>
               
              </div><!-- end .span8 -->
           
            </div><!-- .row -->
         
            </div><!-- end post class -->