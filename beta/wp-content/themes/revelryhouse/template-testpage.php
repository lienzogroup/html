<?php
/**
 *
 * Template Name: Splash
 * Description: Template for general pages, with no sidebar.
 *
 */
?>

 <head>
	<link rel="stylesheet" type="text/css" href="http://s159842.gridserver.com/beta/wp-content/themes/revelryhouse/style.css?ver=3.5.1">
 </head>

 <div id="splashTemplate">
      <section class="middle">

        <div class="row"> 

          <header id="page-title" class="span12">
            
              <h1><span><?php the_title();?></span></h1>
           
          </header>

        </div><!-- end .row -->

        <div class="row">

          <section class="span12">

            <div <?php post_class(); ?>>

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>             
            <?php the_content(); ?>
          <?php endwhile;  ?> 
          <?php endif; ?>

            </div><!-- end post class -->
                
          </section><!-- end .span12 -->

        </div><!-- end .row -->

      </section><!-- end .middle -->
 </div>
    
    </div><!-- end .container -->