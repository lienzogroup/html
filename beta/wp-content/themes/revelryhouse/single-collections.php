<?php
/****************************************************/



				$custom_values = get_post_custom();
				$custom_values =$custom_values['product'][0];
				
				// Products Stock and Status
				$product = new WC_Product( $custom_values );
				$stock = isset($product->product_custom_fields['_stock'][0]) ? $product->product_custom_fields['_stock'][0] : 0;
				$stockStatus = isset($product->product_custom_fields['_stock_status'][0]) ? $product->product_custom_fields['_stock_status'][0] : '';
				$salePrice = (isset($product->product_custom_fields['_sale_price'][0]) && $product->product_custom_fields['_sale_price'][0] > 0) ? $product->product_custom_fields['_sale_price'][0] : $product->product_custom_fields['_regular_price'][0];
				$salePrice = ($salePrice > 0) ? $salePrice : 0; 
				$currencySymbol = get_woocommerce_currency_symbol();
				
				$label = "Pre-Order";
				if($stockStatus == 'instock') {
					$label = "Buy Now";
				}
				
				
				if($custom_values ) {
						//QUERY
						$sql = "SELECT * FROM wp_posts WHERE post_status='publish' AND post_type='product' AND ID =".$custom_values;
						$result = mysql_query($sql);
						// Loop result
						while($row = mysql_fetch_array($result)) {
							$data = $row;
						}
				}
				/*
				// Button
				if(isset($data) && ($data)) { ?>
					<a class="add_to_cart_button button product_type_simple" data-product_id="<?php echo $custom_values?>" rel="nofollow" href="/beta/shop/?add-to-cart=<?php echo $custom_values?>">Buy Now</a>
				<?php
				}
/****************************************************/
/**
 * Template Name Posts: Collections (Main)
 * Description: Main Collections page
 *
 */
 
get_header('collections'); ?>
	<div class="collections-header">
		<?php echo $cfs->get('gallery'); ?>
	</div>	
	
	
<script type="text/javascript">
jQuery(document).ready(function($) {
$(window).scroll(function(){
    if  ($(window).scrollTop() >= 672){
         $("#sticky").css({position:'fixed',top:94});
		 $("#sticky").css({background:'#000', height:'80px'});
		 $("#sticky").removeClass('slideDown-0_2s');
		 $("#sticky").addClass('slideDown-1_5s');
		 $("#nav-wrapper ul").css({height:'0px'})
    } else {
		 $("#sticky").removeClass('slideDown-1_5s');
		 $("#sticky").addClass('slideDown-0_2s');
         $("#sticky").css({position:'relative',top:0});
		 $("#nav-wrapper ul").css({height:'112px'})
        }
});
});
 </script>
 
 
      <section class="middle">
           
			
			<div class="nav-container">      	
				<div id="sticky">
				<ul class="nav nav-tabs span900" id="myTab">
  					<li class="active"><a data-target="#theparty" href="#theparty">The Party</a></li>
  					<li><a data-target="#whatsinthebox" href="#whatsinthebox">What's in the Box?</a></li>
  					<li><a data-target="#tipsandtricks" href="#tipsandtricks">Tips & Tricks</a></li>
<?php
/****************************************************/
if(isset($data) && ($data)) { ?>
	<li id="add_to_cart_button">
		<a class="add_to_cart_button button product_type_simple" data-product_id="<?php echo $custom_values?>" rel="nofollow"><?php echo $label; ?></a>
		<div id="price" style=""><span><?php echo $currencySymbol; ?></span><?php echo $salePrice; ?></div>
	</li> 
<?php
}
/****************************************************/
?>
				</ul>
				</div> <!-- end sticky -->
			</div>
			
				
        <div class="row">

          <article class="blog-single span12">
		  
			<div <?php post_class();?>>
			
			<div class="tab-content">
			
  				<div class="tab-pane fade in active span8" id="theparty">
					<div class="sixty-percent-centered"> 
						<h3><?php echo $cfs->get('the_party_title'); ?></h3>
					<?php if ( is_single() ) : ?>
						<?php 
							echo $cfs->get('the_party_content');
						?>
					<?php else : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
					</div>
				</div>
  				<div class="tab-pane fade in" id="whatsinthebox">
					<div class="hotspot-toggle-on"></div>
					<div class="hotspot-toggle-off"></div>
					<?php echo $cfs->get('whats_in_the_box'); ?>
				</div>
				<div style="clear:both;"></div>
  				<div class="tab-pane fade in" id="tipsandtricks" data-spy="scroll" data-target=".nav-list">
					<?						
						$fields = $cfs->get('tips_and_tricks', false, array('format' => 'raw'));
						
						$count = 1;
						
						$sectionNav = '<div class="section-nav"><div class="inside-section-nav"><h4>CONTENTS</h4><ul class="nav nav-list">';
						$sectionContent = '';
						
						foreach ($fields as $field) {
						
							// parse for gallery shortcode and change it to modal
							$field['tips_and_tricks_content'] = preg_replace('#\[gallery#', '[rhmodal', $field['tips_and_tricks_content']);	
							
							$sectionNav .= '<li><a href="#section-'. $count .'">'. apply_filters('the_content', $field['tips_and_tricks_title']) .'</a></li>
								';
							
							$sectionContent .= '<div id="section-'. $count .'" class="tips-tricks-paragraphs section section-' . $count . '"><div class="inside-tips-tricks-paragraphs">';
    						$sectionContent .= '<h3>' . $field['tips_and_tricks_title'] .'</h3>';
    						$sectionContent .= do_shortcode($field['tips_and_tricks_content']);
							$sectionContent .= '<div class="hr-line-bg"><img src="../../wp-content/themes/revelryhouse/img/arrow-emblem.png"></div></div></div>';
							
							$count++;
						}
						$sectionNav .= '</ul></div></div>';
	  					
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
	<div class="other-collections-wrapper"><div class="other-collections"></div></div>
	
	
	 
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

				
<script>
	jQuery(function(){
		jQuery(".section-nav .inside-section-nav a").click(function(){
			var href= jQuery(this).attr('href');
			jQuery("div#tipsandtricks.tab-pane div.section").css("padding-top:","220px");
		});
		
		// set width
		var windowW = jQuery(window).width()
		 
		//jQuery(".single-collections .nav-container").css({"min-width":windowW+"px","left":"0px"});
		jQuery(".single-collections .nav-container").css({"min-width":windowW+"px","width":"100%"});
		jQuery("section.middle div.row article").css({"max-width":"1100px","left":"0px"});
		jQuery(".transparent-spots").css("width","1100px");
		
		});
		
		jQuery(".hotspot-toggle-off").click(function() {
		//hide the list
		jQuery(".hotspot-list-overlay").css("opacity", "0.5");
		jQuery(".hotspot-list-overlay").css("z-index", "0");
		jQuery(".hotspot-toggle-on").css("display", "block");
		jQuery(".hotspot-toggle-off").css("display", "none");
		jQuery(".hs-wrap").css("opacity", "1");
		});
		
		jQuery(".hotspot-toggle-on").click(function() {
		//show the list
		jQuery(".hotspot-list-overlay").css("opacity", "1");
		jQuery(".hotspot-list-overlay").css("z-index", "100");
		jQuery(".hotspot-toggle-on").css("display", "none");
		jQuery(".hotspot-toggle-off").css("display", "block");
		jQuery(".hs-wrap").css("opacity", "0.5");
		
		
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