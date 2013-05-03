<?php

/*-----------------------------------------------------------------------------------*/
/* Add Custom Taxonomies to post_class
/*-----------------------------------------------------------------------------------*/

function gt_post_class($classes) {
	
    global $post;
    
    $terms = wp_get_object_terms($post->ID, "project-type");
    
    foreach($terms as $project_type){ $classes[] = "project-type-" . $project_type->term_taxonomy_id; }
    
    return $classes;
}

add_filter("post_class", "gt_post_class");

/*-----------------------------------------------------------------------------------*/
/* Output Image
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'gt_image' ) ) {
    function gt_image($postid, $imagesize) {
        // get the featured image for the post
        $thumbid = 0;
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }

        $image_ids_raw = get_post_meta($postid, 'gt_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $temp_id = $postid;
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => 10
        );
        $attachments = get_posts($args);

        $postid = ( isset($temp_id) ) ? $temp_id : $postid;

        if( !empty($attachments) ) {
            foreach( $attachments as $attachment ) {
                // if current image is featured image reloop
                if( $attachment->ID == $thumbid ) continue; 
                $full = wp_get_attachment_image_src( $attachment->ID, 'full', false, false );  
                $large = wp_get_attachment_image_src( $attachment->ID, 'feature-image', false, false );
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                $title = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<section class='portfolio-thumbs'>";
                echo '<a class="fancybox" rel="gallery" title="'.$title.'" href="'.$full[0].'"><img src="'.$large[0].'" alt="'.$alt.'" /></a>';
                echo "</section>";
                // got image, time to exit foreach
                break;
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/* Output Slideshow
/*-----------------------------------------------------------------------------------*/

function gt_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery(".slider").flexslider({
                    preload: true,
                    preloadImage: jQuery(".flexslider-<?php echo $postid; ?>").attr('data-loader')
                });
            });
        </script>
    <?php 
        $loader = 'loader.gif';
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
        echo "<!-- BEGIN #slider-$postid -->\n<div class='flexslider' data-loader='" . get_template_directory_uri() . "/img/$loader'>";
        
        $image_ids_raw = get_post_meta($postid, 'gt_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $temp_id = $postid;
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }

        // get all of the attachments for the post
        $args = array(
            'include' => $include,
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);
        
        if( !empty($attachments) ) {
            echo '<ul class="slides">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $large = wp_get_attachment_image_src( $attachment->ID, 'large-slider-thumb', false, false );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? "<div class='slider-desc'>$caption</div>" : '';
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li>$caption<img height='$src[2]' width='$src[1]' src='$large[0]' alt='$alt' /></li>";
                $i++;
            }
            echo '</ul>';
        }
        echo "</div>";
    }

/*-----------------------------------------------------------------------------------*/
/* Numbered Post Navigation (*Quick note: you can not have this function, and the plugin 'WP-Pagenavi' active at the same time!!)
/*-----------------------------------------------------------------------------------*/

function wp_pagenavi() {
  
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $args['total'] = $max;
  $args['current'] = $current;
 
  $total = 1;
  $args['mid_size'] = 3;
  $args['end_size'] = 1;
  $args['prev_text'] = '<i class="icon-arrow-left icon-large"></i>';
  $args['next_text'] = '<i class="icon-arrow-right icon-large"></i>';
 
  if ($max > 1) echo '</pre>
    <div class="wp-pagenavi">';
 if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>';
 echo $pages . paginate_links($args);
 if ($max > 1) echo '</div>';

}

/*-----------------------------------------------------------------------------------*/
/* TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once( get_template_directory() . '/functions/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'gt_register_required_plugins' );

function gt_register_required_plugins() {

	$plugins = array(

		array(
			'name'     => 'Really Simple Twitter Feed Widget',
			'slug'     => 'really-simple-twitter-feed-widget',
			'source'   => get_template_directory() . '/plugins/really-simple-twitter-feed-widget.1.3.8.zip',
			'required' => false
		),

		array(
			'name'     => 'Simple Flickr Photostream Widget',
			'slug'     => 'simple-flickr-photostream-widget',
			'source'   => get_template_directory() . '/plugins/simple-flickr-photostream-widget.zip',
			'required' => false
		),

        array(
            'name'     => 'Advanced Recent Posts Widget',
            'slug'     => 'advanced-recent-posts-widget',
            'source'   => get_template_directory() . '/plugins/advanced-recent-posts-widget.1.1.zip',
            'required' => false
        ),

	);

	$theme_text_domain = 'reboot';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'reboot',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'reboot' ),
			'menu_title'                       			=> __( 'Install Plugins', 'reboot' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'reboot' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'reboot' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'reboot' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'reboot' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'reboot' ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );

}