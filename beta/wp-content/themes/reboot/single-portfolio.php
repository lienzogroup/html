<?php
$title = get_the_title();
if ( $title == "1 Column")  $data['select_portfolio_layout'] = "1 Column";
if ( $title == "2 Column")  $data['select_portfolio_layout'] = "2 Column";
?>

<?php get_header(); ?>
						
			<section class="middle">
				single-portfolio
				<div class="row">
								
					<header id="project-title" class="span12">
						<div class="ribbon">
							<h1><span><?php the_title(); ?></span></h1>
						</div>
					</header>
								
				</div><!-- end .row -->

				<div class="project-nav row">
					
					<div class="span12">
						<span class="arrow-left"><?php next_post_link('%link', '<i class="icon-arrow-left icon-large"></i>'); ?></span>
						<span class="arrow-right"><?php previous_post_link('%link', '<i class="icon-arrow-right icon-large"></i>'); ?></span>
					</div>
								
				</div><!-- end .project-nav -->

				<?php if ($data['select_portfolio_layout'] == "1 Column") { ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								
				<section class="content">
								
				<?php $mediaType = get_post_meta($post->ID, 'gt_portfolio_type', true); ?>
								
								<?php
								switch ($mediaType) {
								    case "Image":
								        gt_image($post->ID, 'feature-image');
								        break;
								    
								    case "Slideshow":
								        gt_gallery($post->ID, 'slideshow');
								        break;
								    
								    case "Video":
								        $embed = get_post_meta($post->ID, 'gt_portfolio_embed_code', true);
								        if (!empty($embed)) {
								            echo "<div class='video-frame'>";
								            echo stripslashes(htmlspecialchars_decode($embed));
								            echo "</div>";
								        }
								    
								    default:
								  break;
								}
				?>

					<div class="row">
													
						<div class="span2">

							<aside id="client-details-left-column">
							
								<?php if ( get_post_meta($post->ID, 'gt_client_name', true) ) : ?>
									<p><strong><i class="icon-user"></i></strong> <?php echo get_post_meta($post->ID, 'gt_client_name', true) ?></p>
								<?php endif; ?>
														
								<?php if ( get_post_meta($post->ID, 'gt_project_date', true) ) : ?>
									<p><strong><i class="icon-calendar"></i></strong> <?php echo get_post_meta($post->ID, 'gt_project_date', true) ?></p>
								<?php endif; ?>
														
								<?php if ( get_post_meta($post->ID, 'gt_project_role', true) ) : ?>
									<p><strong><i class="icon-group"></i></strong> <?php echo get_post_meta($post->ID, 'gt_project_role', true) ?></p>
								<?php endif; ?>
														
								<?php if ( get_post_meta($post->ID, 'gt_project_url', true) ) : ?>
									<a href="<?php echo get_post_meta($post->ID, 'gt_project_url', true) ?>" class="btn btn-inverse read-more">View Project</a>
								<?php endif; ?>
														
							</aside><!-- end #client-details -->
						
						</div>

						<div class="span10">
							
							<?php the_content(); ?>
							
							<?php wp_link_pages(); ?>

						</div>

					</div><!-- end .row -->
						
					<div class="project-nav row">
						<div class="span12">
							<span class="arrow-left"><?php next_post_link('%link', '<i class="icon-arrow-left icon-large"></i>'); ?></span>
							<span class="arrow-right"><?php previous_post_link('%link', '<i class="icon-arrow-right icon-large"></i>'); ?></span>
						</div>
					</div><!-- end .project-nav -->	
												
				</section><!-- end .content -->			

				<?php endwhile; endif; ?>
        <?php } ?>

        <?php if ($data['select_portfolio_layout'] == "2 Column") { ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	      <section class="content">

	      	<div class="row">

	        	<div class="span8">
									
									<?php $mediaType = get_post_meta($post->ID, 'gt_portfolio_type', true); ?>
									
									<?php
									switch ($mediaType) {
									    case "Image":
									        gt_image($post->ID, 'feature-image');
									        break;
									    
									    case "Slideshow":
									        gt_gallery($post->ID, 'slideshow');
									        break;
									    
									    case "Video":
									        $embed = get_post_meta($post->ID, 'gt_portfolio_embed_code', true);
									        if (!empty($embed)) {
									            echo "<div class='video-frame'>";
									            echo stripslashes(htmlspecialchars_decode($embed));
									            echo "</div>";
									        }
									    
									    default:
									        break;
									}
									?>

						</div>
													
						<div class="span4">
							
							<aside id="client-details-right-column">

								<?php if ( get_post_meta($post->ID, 'gt_client_name', true) ) : ?>
							    	<p><strong><i class="icon-user"></i></strong> <?php echo get_post_meta($post->ID, 'gt_client_name', true) ?></p>
								<?php endif; ?>
							
								<?php if ( get_post_meta($post->ID, 'gt_project_date', true) ) : ?>
							    	<p><strong><i class="icon-calendar"></i></strong> <?php echo get_post_meta($post->ID, 'gt_project_date', true) ?></p>
								<?php endif; ?>
							
								<?php if ( get_post_meta($post->ID, 'gt_project_role', true) ) : ?>
							    	<p><strong><i class="icon-group"></i></strong> <?php echo get_post_meta($post->ID, 'gt_project_role', true) ?></p>
								<?php endif; ?>
							
								<?php if ( get_post_meta($post->ID, 'gt_project_url', true) ) : ?>
							    	<a href="<?php echo get_post_meta($post->ID, 'gt_project_url', true) ?>" class="btn btn-inverse read-more">View Project</a>
								<?php endif; ?>
							
							</aside><!-- end #client-details -->

							<?php the_content(); ?>
							
							<?php wp_link_pages(); ?>

						</div>

					</div><!-- end .row -->
						
					<div class="project-nav row">
						<div class="span12">
							<span class="arrow-left"><?php next_post_link('%link', '<i class="icon-arrow-left icon-large"></i>'); ?></span>
							<span class="arrow-right"><?php previous_post_link('%link', '<i class="icon-arrow-right icon-large"></i>'); ?></span>
						</div>
					</div><!-- end .project-nav -->		
									
				</section><!-- end .content -->

				<?php endwhile; endif; ?>
        <?php } ?>

				<?php if($data["related_projects"]){ ?>
							
				<aside id="related-projects">
					<header>
						<h3><?php $data; echo (stripslashes($data['text_related_title'])) ?></h3>
					</header>
						<ul>
						<?php
						global $post;
						$terms = get_the_terms( $post->ID , 'project-type');
						$do_not_duplicate[] = $post->ID;
												 
						if(!empty($terms)){
							foreach ($terms as $term) {
							query_posts( array(
								'project-type' => $term->slug,
								'showposts' => 3,
								'ignore_sticky_posts' => 0,
								'post__not_in' => $do_not_duplicate ) );
						if(have_posts()){
							while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID; ?>
					
							<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('related-thumb'); ?></a></li>
												       	
						<?php endwhile; wp_reset_query();
									}
								}
							}
						?>
						</ul>
				</aside><!-- end #related-projects -->
							
				<?php } ?>
						
			</section><!-- end .middle -->
	
		</div><!-- end of .container-->			

<?php get_footer(); ?>
