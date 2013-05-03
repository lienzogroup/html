<?php
get_header();
 ?> 
<script type="text/javascript">
jQuery(document).ready(function($) {
$(window).scroll(function(){
    if  ($(window).scrollTop() >= 620){
         $('#sticky').css({position:'fixed',top:94});
		 $("#sticky").removeClass('slideDown-0_2s');
		 $("#sticky").addClass('slideDown-1_5s');
		 $("#nav-wrapper ul").css({height:'0px'})
    } else {
		 $("#sticky").removeClass('slideDown-1_5s');
		 $("#sticky").addClass('slideDown-0_2s');
         $('#sticky').css({position:'relative',top:0});
		 $("#nav-wrapper ul").css({height:'112px'})
        }
});
});
 </script>
<div class="clear"></div>
<div class="magazine-promoted">
<?php 

// get page number from url
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

// display promoted posts
	$excludePosts = array();
	$args = array(
			'post_type' => 'magazine', 
			'posts_per_page' => 1, 
			'category_name' => 'promoted',
			'paged'	=>	$page
		);
    $loop = new WP_Query($args);
    if ($loop->have_posts()) : 
    	$loop->the_post();
    	$excludePosts[] = get_the_ID();
    	
    	// display the featured image
    	the_post_thumbnail('full'); 
?>
		<a class="promoted-magazine-link" href="<?php echo the_permalink(); ?>" title="READ THE STORY">READ THE STORY</a>
<?php 
	// if there are no promoted magazine article, grab a random magazine article
    else :
    	$args = array(
    			'post_type' => 'magazine', 
    			'posts_per_page' => 1, 
    			'orderby' => 'rand',
    			'paged'	=>	$page
    		);
    $loop = new WP_Query($args);
	    if ($loop->have_posts()) : 
	    	$loop->the_post();
	    	$excludePosts[] = get_the_ID();
	    	
	    	// display the featured image
			the_post_thumbnail('full'); 
?>
			<a class="promoted-magazine-link" href="<?php echo the_permalink(); ?>" title="READ THE STORY">READ THE STORY</a>
<?php	
	    endif; 
    endif;
?> 
</div>


<?php
// display navigation links for magazine pages
$magazineId = 383;
$magazinePermalink = esc_url( get_permalink( get_page_by_title( 'magazine' ) ) );
$args = array(
			'sort_column'	=>	'id',
			'title_li'	=>	'',
			'child_of'	=>	$magazineId,
			'echo'	=>	0,
			'paged'	=>	$page,
		'sort_column'  => 'menu_order',
		);
$pages = wp_list_pages($args); 
if ($pages) 
{
	echo '<div class="magazine-categ-banner-container"><div id="sticky"><ul class="magazine-article-type"><li><a href="'. $magazinePermalink .'">everything</a></li>';
	echo $pages; 
	echo '</ul></div></div>';
} 
?>

<div class="center-this">

<div class="middle" style="width:960px;margin:auto;margin-bottom: 40px;min-height:100%;">
<div class="articles">
<?php
// let's display all the other posts
$args = array(
		'post_type' => 'magazine', 
		'posts_per_page' => 13,
		'post__not_in'	=>	$excludePosts,
		'paged'	=>	$page	
		);
$loop = new WP_Query($args);
$count = 1;
while($loop->have_posts()) : 
    $loop->the_post();
    $categories = get_the_category();
    
    switch($count)
    {
		case $count == 1:	// first post has a different style
?>

<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?>">
			<div class="magazine-featured-image magazine-image-<?php echo $count; ?>">
				<a title="<?php echo the_title(); ?>" href="<?php echo the_permalink(); ?>">
					<?php echo the_post_thumbnail('910x380'); ?>
				</a>
			</div>			
		</article>
<div class="magazine-separator"></div>
			<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>	


		
<?php	
		break;
		
		case $count >= 2 && $count <= 4 :
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?> thirty-percent">
			
			<div class="latest-news-excerpt">
							<div class="the_home_categories"> 
							<?php 
								foreach($categories as $key => $category) :
								if (!($category->name=='promoted')) echo '<span>'. $category->name .'</span>';
								endforeach;
							?>
							</div>
      						<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      						
      						</div>
							<div style="clear:both"></div>
				
			<div class="magazine-featured-image magazine-image-<?php echo $count; ?>">
				<a title="<?php echo the_title(); ?>" href="<?php echo the_permalink(); ?>">
					<?php echo the_post_thumbnail('340x380'); ?>
				</a>
			</div>
		</article>
		<?php if($count == 4): ?>
			<div class="magazine-separator"></div>
			<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>	
		<?php endif; ?>
		
		
<?php	
		break;
		
		case $count >= 5 && $count <= 7 :
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?> thirty-percent">
				<div class="the_home_categories"> 
							<?php 
								foreach($categories as $key => $category) :
								if (!($category->name=='promoted')) echo '<span>'. $category->name .'</span>';
								endforeach;
							?>
				</div>
				<h3 style="font-size: 30px;line-height: 1em;min-height: 110px;"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
			
		</article>
		<?php if($count == 7): ?>
			<div class="magazine-separator"></div>
			<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>	
		<?php endif; ?>

		
		
<?php	
		break;
		
		case $count == 8 :	// first post has a different style
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?>">
			<div class="magazine-featured-image magazine-image-<?php echo $count; ?>">
				<a title="<?php echo the_title(); ?>" href="<?php echo the_permalink(); ?>">
					<?php echo the_post_thumbnail('910x380'); ?>
				</a>
			</div>			
		</article> 
		<div class="magazine-separator"></div>
		<div class="hr-line-bg">	
		<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
		</div>	
<?php	
		break;
		
		case $count >= 9 && $count <= 10 :	// first post has a different style
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?> forty-eight">
			<div class="magazine-featured-image magazine-image-<?php echo $count; ?>">
				<a title="<?php echo the_title(); ?>" href="<?php echo the_permalink(); ?>">
					<?php echo the_post_thumbnail('530x380'); ?> 
				</a>
			</div>			
		</article>
		<?php if($count == 10): ?>
			<div class="magazine-separator"></div>
			<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>
			<?php endif; ?>
		
		
		
		 
<?php	
		break;
		
		case $count == 11 :
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?>">
			
			<div class="the_home_categories" style="color:#000;margin-bottom:30px;"> 
				<?php 
				foreach($categories as $key => $category) :
				if (!($category->name=='promoted')) echo '<span style="color:#000 !important;border:2px solid #000;padding:6px 12px;">'. $category->name .'</span>';
				endforeach;
				?>
			</div>
							
				<h3><a style="font-size: 50px;font-style: italic;letter-spacing: 3px;" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="forty-eight" style="margin:auto"><?php the_excerpt(); ?></a>
			
		</article>
		<div class="magazine-separator"></div>
					<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>	
		
		
		
		
<?php	
		break;
		
		case $count >= 12 && $count <= 13 :	// first post has a different style
?>
		<article class="magazine-article post-<?php the_ID();?> magazine-landing-post-<?php echo $count; ?> forty-eight">
			<div class="magazine-featured-image magazine-image-<?php echo $count; ?>">
				<a title="<?php echo the_title(); ?>" href="<?php echo the_permalink(); ?>">
					<?php echo the_post_thumbnail('530x380'); ?>
				</a>
			</div>			
		</article>
		<?php if($count == 13): ?>
			<div class="magazine-separator"></div>
			<div class="hr-line-bg">	
			<img src="<?php bloginfo('template_url'); ?>/img/arrow-emblem.png">
			</div>	
		<?php endif; ?>
		
		
		
		
		
<?php	
		break;
    }
   
$excludePosts[] = get_the_ID();
$count++;
endwhile;
?>
</div>
</div>
<div class="loader">
	<img src="<?php echo get_template_directory_uri() .'/img/ajax-loader.gif'; ?>" alt="loading..."/>
</div>
<div class="showmore">
	<div class="line"></div>
	<span>SHOW ME MORE</span>
	<div class="line"></div>
</div>
</div></div></div></div></div></div></div></div></div></div></div></div>
<?php get_footer(); ?>
<style>
	article h3 {min-height: 104px;}
</style>