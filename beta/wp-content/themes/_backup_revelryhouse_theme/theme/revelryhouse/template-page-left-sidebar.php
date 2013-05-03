<?php
/**
 *
 * Template Name: Page (Sidebar Left)
 * Description: Template for general pages, with a left sidebar.
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

          <?php get_sidebar() ?>

          <section class="span8">   
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>              
          <?php the_content(); ?>
          <?php endwhile;  ?> 
          <?php endif; ?>
                  
          </section>

        </div><!-- end .row -->
         
      </section><!-- end .middle -->
    
    </div><!-- end .container -->

<?php get_footer() ?>