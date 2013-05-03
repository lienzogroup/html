<div class="meta span12" style="display:none;">
	<ul>
		<li class="post-date">
		<i class="icon-calendar"></i> 
		<?php the_time('F jS, Y'); ?></li>
		<li>
		<i class="icon-user"></i>
		<?php the_author_posts_link(); ?></li>
		<li>
		<i class="icon-list"></i>
		<?php the_category(', '); ?></li>
		<li>
		<i class="icon-comment-alt"></i> 
		<a href="<?php comments_link(); ?>"><?php $commentscount = get_comments_number(); echo $commentscount; ?> <?php _e('Comments', 'reboot'); ?></a></li>
	</ul>
</div>