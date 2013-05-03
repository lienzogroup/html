<?php
/**
 *
 * Template Name: Homepage
 * Description: Page template to display the custom homepage.
 *
 */

get_header(); ?>

	<section class="middle row">

          <?php
          $layout = $data['homepage_blocks']['enabled'];

          if ($layout):

          foreach ($layout as $key=>$value) {

              switch($key) {

              case 'slider_block':
          ?>
        
          <div class="flex-container span12">
	          
	          <div class="flexslider">
	         
	          		<div class="overlay-container">
	          			<div class="left-overlay"></div>
	            		<div class="main-overlay"></div>
	            		<div class="right-overlay"></div>
	            	</div>
	          
	            <ul class="slides">
	            
	               <?php
	               global $data;
	               $count = 0;
	               $args = array('post_type' => 'slider', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $data['slider_select']);
	               $loop = new WP_Query($args);
	               while ($loop->have_posts()) : $loop->the_post(); ?>     
	               <li class="<?php echo 'slide-'.$count;?>">
	               		<a href="<?php echo get_post_meta($post->ID, 'gt_slide_url', true) ?>"><?php the_post_thumbnail('1100x600'); ?></a>
                  <h1 class="flex-title"><span><?php the_title(); ?></span></h1>
                  <?php if(get_post_meta($post->ID, "gt_slide_caption", true)): ?>
		           	<p class="flex-caption"><span><?php echo get_post_meta($post->ID, 'gt_slide_caption', true) ?></span></p>
                <?php endif; ?>
	               </li>
	             <?php 
	             $count++;
	             endwhile;
	             
	             while ($loop->have_posts()) : $loop->the_post(); ?>     
	               <li class="<?php echo 'slide-'.$count;?>">
	               		<a href="<?php echo get_post_meta($post->ID, 'gt_slide_url', true) ?>"><?php the_post_thumbnail('1100x600'); ?></a>
                  <h1 class="flex-title"><span><?php the_title(); ?></span></h1>
                  <?php if(get_post_meta($post->ID, "gt_slide_caption", true)): ?>
		           	<p class="flex-caption"><span><?php echo get_post_meta($post->ID, 'gt_slide_caption', true) ?></span></p>
                <?php endif; ?>
	               </li>
	             <?php 
	             $count++;
	             endwhile; ?>
	            </ul><!-- end .slides -->
	          
	          </div><!-- end .flexslider -->
     		
     	  </div><!-- end .flex-container -->
     	  
          <?php
          break;
          case 'mission_statement_block':
          ?>

          <aside style="border:none;" class="mission-statement span12">

            <div class="row">
			
			<img align="center" style="margin:50px auto 30px;" src="<?php bloginfo('template_url'); ?>/img/balloon-placeholder.png">	
			
			
              <!-- <div class="span12"><h3><php $data; echo (stripslashes($data['textarea_mission'])) ?></h3></div> -->

            </div>

          </aside><!-- end .mission-statement -->
		  
		  
		  
		  

          <?php
          break;
          case 'latest_work_block':
          ?>

          <section id="latest-work" class="span12">

            <?php global $data; if($data["text_work_title"]){ ?>
          
            <div class="row">
          
              <header class="section-title span12">
              	<div class="ribbon">
                	<h1><span><?php $data; echo (stripslashes($data['text_work_title'])) ?></span></h1>
               	</div><!-- end .ribbon -->
              </header>

            </div><!-- end .row -->

            <?php } ?>

            <div class="row">
              
              <div class="span12">

                <?php if($data["latest_work_filterable"]){ ?>
                      
                        <div id="portfolio-filter">
                      
                        <ul id="filters" class="btn-group ">
                            <li class="filter"><i class="icon-th icon-large"></i></li>
                                <li><a href="#" data-filter="*" class="mybutton"><?php _e('All', 'reboot'); ?></a></li>
                                <?php
                                $categories = get_categories(array(
                                    'type' => 'post',
                                    'taxonomy' => 'project-type'
                                ));
                                foreach ($categories as $category) {
                                    $group = $category->slug;
                                    echo "<li class='project-type'><a href='#' data-filter='.$group'>" . $category->cat_name . "</a></li>";
                                }
                                ?>
                            </ul><!-- end #filters -->

                      </div><!-- end #portfolio-filter -->

                <?php } ?>

              </div><!-- end .span1-->

            </div><!-- end .row -->
            
            <div id="portfolio-items" class="row">
            
            <?php
            query_posts(array(
                'post_type' => 'portfolio',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => $data['latest_select_work']
            ));
            ?>

               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
               <?php 
                   $terms =  get_the_terms( $post->ID, 'project-type' ); 
                   $term_list = '';
                   if( is_array($terms) ) {
                       foreach( $terms as $term ) {
               	        $term_list .= urldecode($term->slug);
               	        $term_list .= ' ';
               	    }
                   }
               ?>
                      
                      <div <?php post_class("$term_list media-box span4 block"); ?> id="post-<?php the_ID(); ?>"> 

                        <div class="view view-first">
                        
                          <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('latest-thumb'); ?></a>
                          
                          <div class="mask">
                            <h2><i class="icon-link"></i><br /><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                            <p class="project-cat"><?php the_terms($post->ID, 'project-type', '', ', ', ''); ?></p>
                          </div>

                        </div><!-- end .view view-first -->
                      
                      </div>  
  
                <?php endwhile; endif; ?>
              
            </div><!-- end .row -->

            <hr class="dotted" />
          
          </section><!-- end #latest-work -->  

          <?php
          break;
          case 'services_block':
          ?>

          <section id="services" class="span12">
          
          	<div class="row">
              
			    <?php
      		global $data;
      									
      		$args = array('post_type' => 'services', 'posts_per_page' => '4');
      		$loop = new WP_Query($args);
      		while ($loop->have_posts()) : $loop->the_post(); ?>
      			
      			<div class="span3">
      				
      				<a href="<?php echo get_post_meta($post->ID, 'gt_service_url', true) ?>"><?php the_post_thumbnail('services-thumb'); ?></a>
      				
      				<h2><a href="<?php echo get_post_meta($post->ID, 'gt_service_url', true) ?>"><?php the_title(); ?></a></h2>
      				
   					<?php the_excerpt(); ?>
   					
   				</div>
    	
      		<?php endwhile; ?>
                
          	</div><!-- end row -->

            <hr class="dotted" />
            
          </section><!-- end #services -->

          

          <aside id="homepage-widgets" class="span12">

            <div class="row">
    
              <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("homepage-sidebar-1") ) : ?>
                <?php endif; ?>
              </div>
              
              <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("homepage-sidebar-2") ) : ?>
                <?php endif; ?>
              </div>
              
              <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("homepage-sidebar-3") ) : ?>
                <?php endif; ?>
              </div>
              
              <div class="span3">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("homepage-sidebar-4") ) : ?>
                <?php endif; ?>
              </div>
                
            </div><!-- end .row -->

          </aside><!-- end #homepage-widgets -->

          <?php
          break;
          case 'featured_area_block':
          ?>
			
			
			
          <section id="featured" class="span12">
				
				
		<div class="hr-line-bg">	
		 <img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
		</div>
		
            <div>
          
              <div class="row-fluid">
                                          
<?php 
				$args = array('post_type' => 'collections', 'posts_per_page' => 1); 
      			$loop = new WP_Query($args);
      			while ($loop->have_posts()) : $loop->the_post(); ?>
      	
      				<article class="latest-article span8">

      					<div class="view view-first" style="padding:30px 0;" >
      						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      						<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '910x380' ); } ?>
      				         </a>      		
      					</div><!-- end .view view-first -->
      				</article><!-- end .latest-article -->
      	
      			<?php endwhile; ?>
                  
              </div><!-- end row -->
            
            </div><!-- end .well -->

          </section><!-- end #featured -->
		  
		<div class="hr-line-bg">	
		 <img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
		</div>

          <?php
          break;
          case 'latest_news_block':
          ?>
          
          <section id="latest-news" class="span12">

            <?php global $data; if($data["text_news_title"]){ ?>
          
          	<div class="row">

              <header class="section-title span12">
              	<div class="ribbon">
                	<h1><span><?php $data; echo (stripslashes($data['text_news_title'])) ?></span></h1>
                </div><!-- end .ribbon -->
              </header>
          
          	</div><!-- end .row -->
			
			  

            <?php } ?>
          	          	
          	<div class="row">
          	
          		<div id="latest-articles" style="margin-top:30px;">
          			<div class="center 3columns">
      			<?php
      			global $data;
      			
      			$postcount = 0;						
      			$args = array('post_type' => 'any', 'posts_per_page' => $data['latest_select_news']);
      			$loop = new WP_Query($args);
      			while ($loop->have_posts()) : $loop->the_post(); ?>
      	
<?php 		if($postcount < 3) :?> 
					<article class="latest-article"> 
      					<div class="view view-first">
      						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
      							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( '340x380' ); } ?>
      						</a>
      					</div><!-- end .view view-first -->
<?php 		else : ?>      	
				
					<article class="latest-article span3">	
<div style="background: url(<?php bloginfo('template_url'); ?>/img/hr-line-3.png) no-repeat center center;height:28px;min-width:328px;"></div>						
      					<div class="latest-news-excerpt">
      						<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      						
      						<?php the_excerpt(); ?>
      									
      					</div>
<?php endif; ?>
      				</article><!-- end .latest-article -->
<?php 

$postcount++;
if($postcount % 3 == 0) :      	
?>
	<div class="clear"></div>
<?php endif; ?>
      			<?php endwhile; ?>
      				</div>
      			</div><!-- end #latest-articles -->
          									         		
          	</div><!-- end row -->

		<div class="hr-line-bg-magazine">	
			<a href="<?php echo site_url(); ?>/magazine"><h2 class="go-to-the-magazine center">GO TO THE MAGAZINE</h3></a>
		</div> 
          
          </section><!-- end #latest-news -->

          <?php
          break;
              }

          } endif; ?>

      </section><!-- end .middle -->
          
    </div><!-- end .container -->
  
<?php get_footer(); ?>