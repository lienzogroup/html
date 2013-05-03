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
				
  				<div class="tab-pane fade in" id="tipsandtricks">
					<?
						$fields = $cfs->get('tips_and_tricks');
						foreach ($fields as $field) {
    						echo $field['tips_and_tricks_title'];
    						echo $field['tips_and_tricks_content'];
						}
					?>
				</div>
			</div>
				
				
			<?php
					$args = array('post_type' => 'collections');
      				$loop = new WP_Query($args);
      				while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      					<article class="latest-article">

      						<div class="view view-first">
      							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"> 
      							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium' ); } ?>
      				        	</a>  
      						</div><!-- end .view view-first -->
      					</article><!-- end .latest-article -->
      	
      			<?php endwhile; 
						wp_reset_query();			
				?>				
			         
</div><!-- end post class -->