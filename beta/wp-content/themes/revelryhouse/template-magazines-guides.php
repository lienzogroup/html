<?php

/**

 *

 * Template Name: Magazine Guides Page

 * Description: Page template to display the custom Magazine Guides.

 *

 */



get_header(); ?>



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

			'category__and' => array( 31, 36 ),

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

			'paged'	=>	$page

		);

$pages = wp_list_pages($args); 

if ($pages) 

{

	echo '<ul class="magazine-article-type"><li><a href="'. $magazinePermalink .'">everything</a></li>';

	echo $pages; 

	echo '</ul>';

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

		'orderby'	=>	'date',

		'post__not_in'	=>	$excludePosts,

		'category_name' => 'guide',

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

							

				<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

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