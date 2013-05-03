<?php

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 250, 210, true );
}

add_action('init', 'services_register');  

function services_register() {
    $labels = array(
        'name' => __('Services', 'reboot'),
        'add_new' => __('Add New', 'reboot'),
        'add_new_item' => __('Add New Service', 'reboot'),
        'edit_item' => __('Edit Service Item', 'reboot'),
        'new_item' => __('New Service Item', 'reboot'),
        'view_item' => __('View Service Item', 'reboot'),
        'search_items' => __('Search Service Items', 'reboot'),
        'not_found' => __('No items found', 'reboot'),
        'not_found_in_trash' => __('No items found in Trash', 'reboot'), 
        'parent_item_colon' => '',
        'menu_name' => 'Services'
        );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'rewrite' => true,
        'exclude_from_search' => true,
        'supports' => array('title','thumbnail','editor')
       );  

    register_post_type( 'services' , $args );
}

add_action('contextual_help', 'services_help_text', 10, 3);
function services_help_text($contextual_help, $screen_id, $screen) {
    if ('services' == $screen->id) {
        $contextual_help =
        '<h3>' . __('Things to remember when adding a Service:', 'reboot') . '</h3>' .
        '<ul>' .
        '<li>' . __('Give the Service a title. (ie; Website Development or Mobile Development).', 'reboot') . '</li>' .
        '<li>' . __('Add a short excerpt to describe your service.', 'reboot') . '</li>' .
        '<li>' . __('Add a featured image to appear above your service title. This could be an icon, or small thumbnail.', 'reboot') . '</li>' .
        '</ul>';
    }
    elseif ('edit-services' == $screen->id) {
        $contextual_help = '<p>' . __('A list of all services items appear below. To edit an item, click on the items\'s title.', 'reboot') . '</p>';
    }
    return $contextual_help;
}

?>