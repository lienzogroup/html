<?php

/**

 * Template Name Posts: Collections (Main)

 * Description: Main Collections page

 *

 */



get_header();

?>

</div>

<div class="clear"></div>



<section class="middle">

	<div <?php post_class();?>>

	    <div class="row">
        
          <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
        

			<article class="magazine-article post-<?php the_ID();?>">




	      

				<div class="single-magazine-article-top">

					<div class="magazine-category">

				
					</div>	
<div class="spacer60"></div>
<p><img src="<?php echo bloginfo('template_url');?>/img/article-icon.jpg" /></p>
<div class="spacer20"></div>


					<header>

						<h1><?php the_title();?></h1>
<p><span>by <?php the_author() ?></span></p>
					</header>

					

				</div>
                <div class="spacer20"></div>
<hr />
				<div class="magazine-single-content">

					<?php the_content(); ?>

				</div>


			</article>

		</div>
        <?php endwhile; ?>
        <?php else : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>


        

	</div>

</section>
<div class="spacer60"></div>
	<div class="related">
    <div class="related-logo"></div>
    <div class="spacer50"></div>
    <div class="container-related">
<ul>    
     <?php
          
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID,
                    'category', array('fields' => 'ids') );
        // arguments
        $args = array(
        'post_type' => 'magazine',
        'post_status' => 'publish',
        'posts_per_page' => 2, // you may edit this number
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $custom_taxterms
            )
        ),
        'post__not_in' => array ($post->ID),
        );
        $related_items = new WP_Query( $args );
        // loop over query
        if ($related_items->have_posts()) :
        while ( $related_items->have_posts() ) : $related_items->the_post();
        ?>
            <li>
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> 
      							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'related' ); } ?>
      				        	</a>  
<!--<img src="<?php echo bloginfo('template_url');?>/img/1a.jpg" />-->
</li>
        <?php
        endwhile;
        endif;
        // Reset Post Data
        wp_reset_postdata();
        ?>
   
 
   
    </div>
    </div>

<?php get_footer(); ?>

