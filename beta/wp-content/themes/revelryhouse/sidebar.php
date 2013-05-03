<?php
/**
 *
 * Description: Sidebar containing the Widget areas.
 *
 */

get_header(); ?>
		
		<div class="span4">
			
			<aside id="sidebar">
				
				<?php if (is_page()): ?>
					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-page') ) : else : ?>
					<?php endif; ?>
				<?php else: ?>
					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-blog') ) : else : ?>
					<?php endif; ?>
				<?php endif; ?>
				
			</aside><!-- end #sidebar -->
			
		</div><!-- end .span4 -->