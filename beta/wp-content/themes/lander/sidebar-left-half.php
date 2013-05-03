<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Left Sidebar Half Template
 *
 *
 * @file           left-sidebar-half.php
 */
?>
        <div id="widgets" class="grid-right col-460 rtl-fit">
        <?php responsive_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('left-sidebar-half')) : ?>
            <div class="widget-wrapper">
            
                <div class="widget-title"><?php _e('In Archive', 'responsive'); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>

            </div><!-- end of .widget-wrapper -->
            <?php endif; //end of left-sidebar-half ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
        </div><!-- end of #widgets -->