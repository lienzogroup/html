<?php
/**
 *
 * Description: Page template to display all single post items.
 *
 */

get_header(); ?>

      <section class="middle">
      
        <div class="row">
        
          <article class="blog-single span8">         

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
     
            <hr class="dotted" />
           
          <?php comments_template(); ?>

          <?php gt_content_nav('nav-below');?>

          </article><!-- end .blog-single -->

<?php get_sidebar(); ?>

        </div><!-- end .row -->
          
      </section><!-- end .middle -->

    </div><!-- end .container -->

<?php get_footer(); ?>
