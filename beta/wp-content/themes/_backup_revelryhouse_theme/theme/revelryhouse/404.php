<?php
/**
 *
 * Description: Template for the 404 (Error/Not Found) page.
 *
 */

get_header(); ?>

      <section class="middle">

        <div class="row"> 

          <header id="page-title" class="span12">
            <div class="ribbon">
              <h1><span><?php _e( '404 - Page Not Found!', 'reboot' ); ?></span></h1>
            </div><!-- end .ribbon -->
          </header>

        </div><!-- end .row -->

        <div class="row">

          <section class="span8">   
                 
            <h1><?php _e( 'Oh! This is embarrasing.', 'reboot' ); ?></h1>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Please try using one of the navigation links above.', 'reboot' ); ?></p>
                    
          </section><!-- end section -->

<?php get_sidebar() ?>

        </div><!-- end .row -->
             
          </section><!-- end .middle -->
        
    </div><!-- end .container -->

<?php get_footer() ?>