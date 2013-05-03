<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Colophon Widget Template
 *
 *
 * @file           sidebar-colophon.php
 */
?>
    <?php
        if (! is_active_sidebar('colophon-widget')
	    )
            return;
    ?>
    <div id="colophon-widget" class="grid col-940">
        <?php responsive_widgets(); // above widgets hook ?>
        
            <?php if (is_active_sidebar('colophon-widget')) : ?>
            
            <?php dynamic_sidebar('colophon-widget'); ?>

            <?php endif; //end of colophon-widget ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
    </div><!-- end of #colophon-widget -->