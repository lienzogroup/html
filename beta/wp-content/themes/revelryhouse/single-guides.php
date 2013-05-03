<?php
/**
 * Template Name Posts: Guides (single)
 * Description: Single Guides posts
 *
 */

get_header('collections'); ?>
	
	<div class="guides-header"> 
		<?php echo $cfs->get('guide-header-area'); ?>
	</div>
	<div class="guides-header-text-container"> 
		<div class="guides-header-text">  
		<?php echo $cfs->get('guide-header-text'); ?>
		
		<div class="guide-top-social">	
		<?php echo do_shortcode('[social_share/]'); ?> 
		</div> 
		
		</div>
	</div>
	 
	 
      <section class="middle">
				
        <div class="row"> 

          <article class="guides_h2 blog-single span12" style="margin:auto !important;float:none !important;">
		  <div style="clear:both;"></div>
  				<div class="tab-pane fade in" id="tipsandtricks" data-spy="scroll" data-target=".nav-list">
					<?php						
						$fields = $cfs->get('tips_and_tricks', false, array('format' => 'raw'));
						
						$count = 1;
						
						$sectionNav = '<div class="section-nav" style="background:#fff;margin-top:-110px !important;right: 56px !important;"><div class="inside-section-nav"><h4>CONTENTS</h4><ul class="nav nav-list">';
						$sectionContent = '';
						
						foreach ($fields as $field) {
						
							// parse for gallery shortcode and change it to modal
							$field['tips_and_tricks_content'] = preg_replace('#\[gallery#', '[rhmodal', $field['tips_and_tricks_content']);	
							
							$sectionNav .= '<li style="display:block !important;"><a href="#section-'. $count .'">'. apply_filters('the_content', $field['tips_and_tricks_title']) .'</a></li>
								';
							
							$sectionContent .= '<div id="section-'. $count .'" class="tips-tricks-paragraphs section section-' . $count . '"><div class="inside-tips-tricks-paragraphs">';
    						$sectionContent .= '<h3 style="display:none;">' . $field['tips_and_tricks_title'] .'</h3>';
    						$sectionContent .= do_shortcode($field['tips_and_tricks_content']);
							$sectionContent .= '<div class="hr-line-bg"><img src="../../wp-content/themes/revelryhouse/img/arrow-emblem.png"></div></div></div>';
							
							$count++;
						}
						$sectionNav .= '</ul></div></div>';
	  					
	  					echo $sectionNav;
	  					echo $sectionContent;
						
					?>
				</div>
			
				        
</div><!-- end post class -->
			
          </article><!-- end .blog-single -->

        </div><!-- end .row -->
          
      </section><!-- end .middle -->

    </div><!-- end .container -->
	
	
			<?php echo do_shortcode('[social_share/]'); ?>
		<div class="other-guides-wrapper"><div class="other-guides"></div></div>
	
	
	 
	<div class="collections-footer">
		<div class="collections-footer-container">
		<?php
					$args = array('post_type' => 'guides', 'posts_per_page' => 3, 'orderby' => 'rand', 'post__not_in' => array($post->ID));
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
				
				
			
<script>
	jQuery(function(){
		jQuery(".section-nav .inside-section-nav a").click(function(){
			var href= jQuery(this).attr('href');
			jQuery('#tipsandtricks.tab-pane div.section').css("padding-top:","220px");
		});
		
		// set width
		var windowW = jQuery(window).width()
		 
		//jQuery(".single-guides .nav-container").css({"min-width":windowW+"px","left":"0px"});
		jQuery(".single-guides .nav-container").css({"min-width":windowW+"px","width":"100%"});
		jQuery("section.middle div.row article").css({"max-width":"1100px","left":"0px"});
		jQuery(".transparent-spots").css("width","1100px");
	})
</script>
<?php get_footer(); ?>
<style>
	.tab-content {overflow:hidden;}
	.container{ margin-top: 105px;}
	.container#condensed{ margin-top: 98px;}
	.top-logo#big {}
	#condensed.top-logo {margin-top: -57px !important;}
</style>