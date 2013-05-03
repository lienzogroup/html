<?php
/**
 * Reboot functions and definitions
 */

/*-----------------------------------------------------------------------------------*/
/* Declaring the content width based on the theme's design and stylesheet
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
  $content_width = 940; /* pixels */

/*-----------------------------------------------------------------------------------*/
/* Declaring the theme language domain (for language translations)
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('reboot');

/*-----------------------------------------------------------------------------------*/
/* Enqueue & Register JS and CSS
/*-----------------------------------------------------------------------------------*/

function queue_assets() {
	$data = get_option("reboot_options");
	
	$body_font = ucwords($data['body_font']['face']);
	$mission_font = ucwords($data['mission_font']['face']);
	$headings_font = ucwords($data['headings_font']['face']);
	$logo_font = ucwords($data['logo_font']['face']);
	$alt_stylesheet = ($data['alt_stylesheet']);

if ( !is_admin() ) {
	wp_deregister_script('jquery');
    
  	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
  	wp_enqueue_script('bootstrap-js', get_template_directory_uri() .'/js/bootstrap.js');
	wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/modernizr-2.0.min.js');
	wp_enqueue_script('superfish', get_template_directory_uri() .'/js/superfish.js');
	wp_enqueue_script('custom-js-settings', get_template_directory_uri() .'/js/jquery.custom.settings.js');
	wp_enqueue_script('fancybox-js', get_template_directory_uri() .'/js/jquery.fancybox.min.js');
	wp_enqueue_script('fancybox-settings', get_template_directory_uri() .'/js/jquery.fancybox.settings.js');
	
  // Enqueue Scripts
  	wp_enqueue_script('isotope', get_template_directory_uri() .'/js/jquery.isotope.min.js');
	wp_enqueue_script('wait-for-images', get_template_directory_uri() .'/js/jquery.waitforimages.js'); 
	wp_enqueue_script('flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js');
  	wp_enqueue_script('flexslider-settings', get_template_directory_uri() .'/js/jquery.flexslider-settings.js');
	wp_enqueue_script('jquery-easing', get_template_directory_uri() .'/js/jquery.easing-1.3.js');
	wp_enqueue_script('jquery-validate', get_template_directory_uri() .'/js/jquery.validate.min.js');
	wp_enqueue_script('jquery-verify', get_template_directory_uri() .'/js/verif.js');
	
  // Enqueue Styles
  	wp_enqueue_style('fancybox', get_template_directory_uri().'/css/fancybox/fancybox.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap/bootstrap.css');
	wp_enqueue_style('responsive', get_template_directory_uri().'/css/bootstrap/bootstrap-responsive.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome/font-awesome.css');
	wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider/flexslider.css');
	wp_enqueue_style("body-font", "http://fonts.googleapis.com/css?family={$body_font}");
	wp_enqueue_style("mission-font", "http://fonts.googleapis.com/css?family={$mission_font}");
	wp_enqueue_style("headings-font", "http://fonts.googleapis.com/css?family={$headings_font}");
	wp_enqueue_style("logo-font", "http://fonts.googleapis.com/css?family={$logo_font}");
  	wp_enqueue_style('main-styles', get_template_directory_uri().'/style.css');
  	wp_enqueue_style('alt-styles', get_template_directory_uri().'/joestyle.css');
  	wp_enqueue_style('options-css', get_template_directory_uri().'/css/dynamic-css/options.css');
  	wp_enqueue_style("alt-stylesheet", get_template_directory_uri()."/css/{$alt_stylesheet}");

} else {
  wp_register_script('reboot-admin-custom', get_template_directory_uri() . '/js/jquery.custom.admin.js');
  }
}
add_action("init", "queue_assets");

// Load Custom admin script (Portfolio type chooser) 
function gt_admin_scripts() {
    wp_enqueue_script('reboot-admin-custom');
}
add_action('wp_print_scripts', 'gt_admin_scripts');

/*-----------------------------------------------------------------------------------*/
/* Register Custom Menus
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_nav_menus') ) :
	register_nav_menus( array(
		  'Header' => __('Header Navigation Menu', 'reboot')
		) );
endif;

function gt_fallback() {
	echo '<ul id="nav" class="group">';
	wp_list_pages('title_li=&');
	echo '</ul>';
}

/*-----------------------------------------------------------------------------------*/
/* Enable Dropdown Select Box Menu for smaller screen sizes (Smartphone, Tablet etc...)
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/dropdown-menus.php' );

/*-----------------------------------------------------------------------------------*/
/* Register Sidebars/Widget Areas
/*-----------------------------------------------------------------------------------*/

function gt_widgets_init() {
  
  register_sidebar( array(
    'name' => 'Page Sidebar',
    'id' => 'sidebar-page',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));

  register_sidebar( array(
    'name' => 'Blog Sidebar',
    'id' => 'sidebar-blog',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ));

  register_sidebar( array(
    'name' => 'Footer Sidebar #1',
    'id'   => 'footer-sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>'
  ));
  
  register_sidebar( array(
    'name' => 'Footer Sidebar #2',
    'id'   => 'footer-sidebar-2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>'
  ));
  
  register_sidebar( array(
    'name' => 'Footer Sidebar #3',
    'id'   => 'footer-sidebar-3',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>'
  ));
  
  register_sidebar( array(
    'name' => 'Footer Sidebar #4',
    'id'   => 'footer-sidebar-4',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>'
  ));

}

add_action( 'init', 'gt_widgets_init' );

add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Call Custom Post Types
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/custom-post-types/portfolio-type.php' );
require_once( get_template_directory() . '/functions/custom-post-types/slider-type.php' );
require_once( get_template_directory() . '/functions/custom-post-types/services-type.php' );

/*-----------------------------------------------------------------------------------*/
/* Setup custom Metaboxes
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/theme-portfoliometa.php' );
require_once( get_template_directory() . '/functions/theme-slidermeta.php' );
require_once( get_template_directory() . '/functions/theme-servicesmeta.php' );

/*-----------------------------------------------------------------------------------*/
/* Call to Custom Theme Functions
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/theme-functions.php' );

/*-----------------------------------------------------------------------------------*/
/* Call to Custom (Twitter Bootstrap) Shortcodes
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/shortcodes.php' );

/*-----------------------------------------------------------------------------------*/
/* Add support, and configure Thumbnails (for WordPress 2.9+)
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 200, true ); // Normal post thumbnails
}

if ( function_exists( 'add_image_size' ) ) { 
add_image_size( 'large', 632, 290, true ); // Large thumbnails
add_image_size( 'small', 125, '', true ); // Small thumbnails

//VEXTER ADDS
add_image_size( '1400x800', 1400, 800, true ); //
add_image_size( '1100x600', 1100, 600, true ); //
add_image_size( '1100x380', 1100, 380, true ); //
add_image_size( '910xVariable', 910,'', true ); //
add_image_size( '910x380', 910, 380, true ); //
add_image_size( '530x380', 530, 380, true ); // 
add_image_size( '340x380', 340, 380, true ); //
add_image_size( '365x268', 365, 268, true ); //

/*
add_image_size( 'gallery-slide', '', 722, true ); // 
add_image_size( 'wide', 1020, 352, true ); //

add_image_size( 'gallery-thumbnail', 800, 320, true ); // WP Gallery shortcode thumbnails
add_image_size( 'latest-thumb', 400, 225, true ); // Latest Work/Latest News Thumbnails (appears on Homepage)
add_image_size( 'post-index', 780, 320, true ); // Post Thumbnail (appears on Blog index)
add_image_size( 'single-post', 800, 460, true ); // Fullsize Image (appears on Single Post page)
add_image_size( 'feature-image', 1200, 550, true ); // Fullsize Image (appears on Portfolio page)
add_image_size( 'portfolio-thumb', 400, 225, true ); // Portfolio Thumbnail (appears on Portfolio page)
add_image_size( 'related-thumb', 100, 100, true ); // Related Projects Thumbnail (appears on Single Portfolio page)
add_image_size( 'large-slider-thumb', 1200, 550, true ); // Large Slider Thumbnail (appears on the homepage)
add_image_size( 'services-thumb', 65, 65, true ); // Thumbnails for the Service descriptions (appears on the homepage)
*/

}

/*-----------------------------------------------------------------------------------*/
/* Custom Excerpt function
/*-----------------------------------------------------------------------------------*/

function gt_excerpt($more) {
  global $post;
  return '&nbsp; &nbsp;<br /><br /><a href="'. get_permalink($post->ID) . '" class="btn btn-inverse btn-small read-more">Continue Reading</a>';
}

add_filter('excerpt_more', 'gt_excerpt');

/*-----------------------------------------------------------------------------------*/
/* Add support for Post Formats
/*-----------------------------------------------------------------------------------*/

add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'quote', 'video', 'audio'));

/*-----------------------------------------------------------------------------------*/
/* Remove inline styling for WP Gallery shortcode
/*-----------------------------------------------------------------------------------*/

add_filter( 'use_default_gallery_style', '__return_false' );

/*-----------------------------------------------------------------------------------*/
/* Assign custom WP Gallery shortcode and function
/*-----------------------------------------------------------------------------------*/

remove_shortcode( 'gallery', 'gallery_shortcode');
add_shortcode( 'gallery' , 'custom_gallery' );
add_shortcode( 'rhmodal' , 'custom_gallery_2' );
/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function custom_gallery($attr) {
	global $post, $wp_locale;

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'div',
		'columns'    => 1,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'div';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'div';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'div';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery carousel slide galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'><div class='carousel-inner'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<{$itemtag} class='gallery-item item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
	}

	$output .= "
			</div>
			<a class='carousel-control left' href='#$selector' data-slide='prev'>&lsaquo;</a>
  			<a class='carousel-control right' href='#$selector' data-slide='next'>&rsaquo;</a>
		</div>";

	return $output;
}

function custom_gallery_2($attr) {
	global $post, $wp_locale;

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'div',
		'columns'    => 1,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'div';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'div';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'div';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$modalselector = "modal-{$instance}";
	$selector = "ttgallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$modalselector' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
						<div class='modal-header'>
    							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
  						</div>
  						<div class='modal-body'>
							<div id='$selector' class='gallery carousel slide galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'><div class='carousel-inner'>
	";

	$i = 0;
	$showimage = true;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		if($showimage)
		{
			$theimage = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, '365x268' , false, false) : wp_get_attachment_image($id, '365x268', true, false);
			$output .= "<a href='#$modalselector' role='button' class='btn' data-toggle='modal'>". $theimage ."</a>";
	$output .= apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
			$showimage = false;
		}
		
		$output .= "<{$itemtag} class='gallery-item item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
	}

	$output .= "
				</div>
				<a class='carousel-control left' href='#$selector' data-slide='prev'>&lsaquo;</a>
  				<a class='carousel-control right' href='#$selector' data-slide='next'>&rsaquo;</a>
			</div>
		</div>
		<div class='modal-footer'>
              <button class='btn' data-dismiss='modal'>Close</button>
              <button class='btn btn-primary'>Save changes</button>
            </div>
	</div>";

	return $output;
}
/*-----------------------------------------------------------------------------------*/
/* Custom Navigation for Single Posts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'gt_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function gt_content_nav( $nav_id ) {
	global $wp_query;

	?>

	<?php if ( is_single() ) : // navigation links for single posts ?>
<ul class="pager">
		<?php previous_post_link( '<li class="previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'reboot' ) . '</span> %title' ); ?>
		<?php next_post_link( '<li class="next">%link</li>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'reboot' ) . '</span>' ); ?>
</ul>
	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
<ul class="pager">
		<?php if ( get_next_posts_link() ) : ?>
		<li class="next"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'reboot' ) ); ?></li>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<li class="previous"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'reboot' ) ); ?></li>
		<?php endif; ?>
</ul>
	<?php endif; ?>

	<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Call to the Options Framework
/*-----------------------------------------------------------------------------------*/

require_once ('admin/index.php');




/**
 * Hooks the WP cpt_post_types filter 
 *
 * @param array $post_types An array of post type names that the templates be used by
 * @return array The array of post type names that the templates be used by
 **/
function my_cpt_post_types( $post_types ) {
	$post_types[] = 'collections';

	return $post_types;
}
add_filter( 'cpt_post_types', 'my_cpt_post_types' );


/**
 * @param string $code name of the shortcode
 * @param string $content
 * @return string content with shortcode striped
 */
function strip_shortcode($code, $content)
{
    global $shortcode_tags;

    $stack = $shortcode_tags;
    $shortcode_tags = array($code => 1);

    $content = strip_shortcodes($content);

    $shortcode_tags = $stack;
    return $content;
}

add_filter('show_admin_bar', '__return_false'); 