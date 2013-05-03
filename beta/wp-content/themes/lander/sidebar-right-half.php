<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Sidebar Right Half Template
 *
 *
 * @file           sidebar-right-half.php
 */
?>
        <div id="widgets" class="grid col-460 fit">
        <?php responsive_widgets(); // above widgets hook ?>
            
            <?php if (!dynamic_sidebar('right-sidebar-half')) : ?>
            <div class="widget-wrapper">
            
                <div class="widget-title"><?php _e('In Archive', 'responsive'); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>

            </div><!-- end of .widget-wrapper -->
			<?php endif; //end of sidebar-right-half ?>

        <?php responsive_widgets_end(); // after widgets hook ?>
        </div><!-- end of #widgets -->