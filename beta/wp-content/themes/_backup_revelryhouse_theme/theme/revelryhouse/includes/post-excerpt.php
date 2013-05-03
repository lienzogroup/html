					<article id="post-<?php the_ID(); ?>" role="article" class="span8">
						
						<header>
							
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
							<p class="meta"><?php _e("Added", "reboot"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "reboot"); ?> <?php the_author_posts_link(); ?>.</p>
						
						</header>
					
						<section class="post_content">
						
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-index'); ?></a>
						
							<?php the_excerpt(); ?>
					
						</section><!-- end of .post_content -->
					
					</article><!-- end of article -->