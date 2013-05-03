<?php
/**
 * Template Name Posts: Collections (Main)
 * Description: Main Collections page
 *
 */

get_header('collections'); ?>
	<div class="collections-header">
		<?php echo $cfs->get('gallery'); ?>
	</div>	
	
      <section class="middle">
            <div class="nav-container">      	
				<ul class="nav nav-tabs span8" id="myTab" data-spy="affix" data-offset-top="500">
  					<li class="active"><a data-target="#theparty">The Party</a></li>
  					<li><a data-target="#whatsinthebox">What's in the Box?</a></li>
  					<li><a data-target="#tipsandtricks">Tips & Tricks</a></li>
				</ul>
			</div>
				
        <div class="row">

          <article class="blog-single span8">
		  
			<div <?php post_class();?>>
			<div class="tab-content">
			
  				<div class="tab-pane fade in active" id="theparty">
					<h3><?php echo $cfs->get('the_party_title'); ?></h3>
				<?php if ( is_single() ) : ?>
					<?php 
						echo $cfs->get('the_party_content');
					?>
                <?php else : ?>
                	<?php the_excerpt(); ?>
                <?php endif; ?>
				
				</div>
  				<div class="tab-pane fade in" id="whatsinthebox">
					<?php
						echo $cfs->get('whats_in_the_box');
					?>
				</div>
				
  				<div class="tab-pane fade in" id="tipsandtricks" data-spy="scroll" data-target=".nav-list">
					<?						
						$fields = $cfs->get('tips_and_tricks', false, array('format' => 'raw'));
						
						$count = 1;
						
						$sectionNav = '<div class="section-nav"><ul class="nav nav-list">';
						$sectionContent = '';
						
						foreach ($fields as $field) {
						
							// parse for gallery shortcode and change it to modal
							$field['tips_and_tricks_content'] = preg_replace('#\[gallery#', '[rhmodal', $field['tips_and_tricks_content']);	
							
							$sectionNav .= '<li><a href="#section-'. $count .'">'. apply_filters('the_content', $field['tips_and_tricks_title']) .'</a></li>
								';
							
							$sectionContent .= '<div id="section-'. $count .'" class="section section-' . $count . '">';
    						$sectionContent .= '<h3>' . $field['tips_and_tricks_title'] .'</h3>';
    						$sectionContent .= do_shortcode($field['tips_and_tricks_content']);
							$sectionContent .= '</div>';
							
							$count++;
						}
						$sectionNav .= '</ul></div>';
	  					
	  					echo $sectionNav;
	  					echo $sectionContent;
						
					?>
				</div>
			</div>
				
				
		
			         
</div><!-- end post class -->
			
          </article><!-- end .blog-single -->

        </div><!-- end .row -->
          
      </section><!-- end .middle -->

    </div><!-- end .container -->
	
	
			<?php echo do_shortcode('[social_share/]'); ?>
	
	
	
	 
	<div class="collections-footer">
		<div class="collections-footer-container">
		<?php
					$args = array('post_type' => 'collections', 'posts_per_page' => 3, 'orderby' => 'rand', 'post__not_in' => array($post->ID));
      				$loop = new WP_Query($args);
      				while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      					<article class="latest-article inline-blocks">

      						<div class="view view-first">
      							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> 
      							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '365x268' ); } ?>
      				        	</a>  
      						</div><!-- end .view view-first --> 
      					</article><!-- end .latest-article -->
      	
      			<?php endwhile; 
						wp_reset_query();			
				?>				
		</div>
	</div><!-- end collections-footer --> 
				

<?php get_footer(); ?>
