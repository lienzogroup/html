<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Top Widget Template
 *
 *
 * @file           sidebar-top.php
 */
?>
    <?php
        if (! is_active_sidebar('top-widget')
	    )
            return;
    ?>
    <div id="top-widget" class="top-widget">
        <?php responsive_widgets(); // above widgets hook ?>
        
            <?php if (is_active_sidebar('top-widget')) : ?>
            
            <?php dynamic_sidebar('top-widget'); ?>

            <?php endif; //end of top-widget ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
    </div><!-- end of #top-widget -->