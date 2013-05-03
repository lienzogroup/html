<?php
/**
 *
 * Template Name: Portfolio
 * Description: Page template to display the portfolio index.
 *
 */

get_header(); ?>

<?php
query_posts(array(
    'post_type' => 'portfolio',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => $data['select_portfolio']
));
?>

<?php
$title = get_the_title();
if ($title == "2 Column Portfolio")  $data['select_portfolio_columns'] = "2 Column Portfolio";
if ($title == "3 Column Portfolio")  $data['select_portfolio_columns'] = "3 Column Portfolio";
if ($title == "4 Column Portfolio")  $data['select_portfolio_columns'] = "4 Column Portfolio";
?>
            
      <section class="middle">
      	template-portfolio
        <div class="row">
      
          <header id="page-title-portfolio" class="span12">
          	<div class="ribbon">
              <h1><span><?php the_title();?></span></h1>
            </div><!-- end .ribbon -->
          </header>
      
        </div><!-- end .row -->
      
        <div class="row">
          
          <div class="span12">

          <?php if($data["portfolio_filterable"]){ ?>
      	        
            <div id="portfolio-filter">
          
              <ul id="filters">
                <li class="filter"><i class="icon-th icon-large"></i></li>
                <li><a href="#" data-filter="*"><?php _e('All', 'reboot'); ?></a></li>
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

          </div><!-- end .span12 -->
      	
        </div><!-- end .row -->
          
        <section id="portfolio-projects">
          <div class="row">
            <div class="span12">
              <div id="portfolio-items" class="row">
                <?php if ($data['select_portfolio_columns'] == "4 Column Portfolio") { ?>
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
                        
                  <div <?php post_class("$term_list media-box span3 block"); ?> id="post-<?php the_ID(); ?>"> 
                              
                    <div class="view view-first">
                                          
                      <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-thumb'); ?></a>
                                            
                      <div class="mask">
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                          <h2><i class="icon-link"></i><br /><?php the_title(); ?></h2>
                          <p class="project-cat"><?php the_terms($post->ID, 'project-type', '', ', ', ''); ?></p>
                        </a>
                      </div><!-- end .mask -->
                                            
                    </div><!-- end .view view-first -->
                                                    
                  </div><!-- end .media-box --> 
                          
                <?php endwhile; endif; ?>
                <?php } ?>
  
                  
                <?php if ($data['select_portfolio_columns'] == "3 Column Portfolio") { ?>
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
                                          
                      <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-thumb'); ?></a>
                                            
                      <div class="mask">
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                          <h2><i class="icon-link"></i><br /><?php the_title(); ?></h2>
                          <p class="project-cat"><?php the_terms($post->ID, 'project-type', '', ', ', ''); ?></p>
                        </a>
                      </div><!-- end .mask -->
                                            
                    </div><!-- end .view view-first -->
                                            
              	  </div><!-- end .media-box --> 
                    
                <?php endwhile; endif; ?>
                <?php } ?>
                  
                <?php if ($data['select_portfolio_columns'] == "2 Column Portfolio") { ?>
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
                  
                  <div <?php post_class("$term_list media-box span6 block"); ?> id="post-<?php the_ID(); ?>"> 
                      
                    <div class="view view-first">
                                          
                      <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('portfolio-thumb'); ?></a>
                                            
                      <div class="mask">
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                          <h2><i class="icon-link"></i><br /><?php the_title(); ?></h2>
                          <p class="project-cat"><?php the_terms($post->ID, 'project-type', '', ', ', ''); ?></p>
                        </a>
                      </div><!-- end .mask -->
                                            
                    </div><!-- end .view view-first -->
                                            
                  </div><!-- end .media-box --> 
                    
                <?php endwhile; endif; ?>
                <?php } ?>
          
          </section>
          
        </div>
      
      </section><!-- end .middle -->  
    
    </div><!-- end.container -->   

<?php get_footer(); ?>