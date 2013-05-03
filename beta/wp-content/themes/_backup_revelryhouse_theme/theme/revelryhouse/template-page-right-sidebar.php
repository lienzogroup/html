<?php
/**
 *
 * Template Name: Page (Sidebar Right)
 * Description: Template for general pages, with a right sidebar.
 *
 */

get_header(); ?>

      <section class="middle">

        <div class="row"> 

          <header id="page-title" class="span12">
            <div class="ribbon">
              <h1><span><?php the_title();?></span></h1>
          	</div><!-- end .ribbon -->
          </header>

        </div><!-- end .row -->

        <div class="row">

          <section class="span8">   
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>              
          <?php the_content(); ?>
          <?php endwhile;  ?> 
          <?php endif; ?>
                  
          </section>

<?php get_sidebar() ?>

        </div><!-- end .row -->
         
      </section><!-- end .middle -->
    
    </div><!-- end .container -->

<?php get_footer() ?>