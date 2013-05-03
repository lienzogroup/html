<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("1","2","3","4","5","6","7","8","9");
		$of_options_latest_work_select = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15");
		$of_options_latest_news_select = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16");
		$of_options_slider_select = array("2","3","4","5","6","7","8","9","10");
		$of_options_portfolio_select = array("3","6","9","12","15","18","21","24","27","30","33","36","39");
		
		//Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"slider_block"		=> "Slider",
				"mission_statement_block"		=> "Mission Statement",
				"latest_work_block"	=> "Latest Work",
				"services_block"	=> "Services",
				"featured_area_block"	=> "Featured",
				"latest_news_block"	=> "Latest News",
			),
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = get_stylesheet_directory(). '/css/';
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) {
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
		            if(stristr($alt_stylesheet_file, ".css") !== false) {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/img/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}

		$of_options_portfolio_columns = array("1" => "2 Column Portfolio","2" => "3 Column Portfolio","3" => "4 Column Portfolio");

		$of_options_portfolio_layout = array("1" => "1 Column", "2" => "2 Column");

		$of_options_featured_button_style = array("btn-default" => "Grey", "btn-primary" => "Dark Blue", "btn-info" => "Light Blue", "btn-success" => "Green", "btn-warning" => "Orange", "btn-danger" => "Red", "btn-inverse" => "Black");

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" => "Home Settings",
					"type" => "heading");
					
$of_options[] = array( "name" => "Introduction",
					"desc" => "",
					"id" => "introduction",
					"std" => "<strong>Welcome to the Theme Options panel.</strong><br /> Here you will find various options to easily customise your theme. If you need further help, please refer to the documentation supplied with this theme.",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Homepage Layout Manager",
					"desc" => "Organize how you want the layout to appear on the homepage.<br /><br />You can choose to enable/disable sections via drag & drop, or re-order their stacking order on the homepage.",
					"id" => "homepage_blocks",
					"std" => $of_options_homepage_blocks,
					"type" => "sorter");

$of_options[] = array( "name" => "Slider",
					"desc" => "Please select how many items you would like featured on your homepage Slider.",
					"id" => "slider_select",
					"std" => "3",
					"type" => "select",
					"class" => "tiny",
					"options" => $of_options_slider_select);

$of_options[] = array( "name" => "Mission Statement",
					"desc" => "You can add a short mission statement to appear on your homepage.",
					"id" => "textarea_mission",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => "Latest Work",
					"desc" => "Please enter a title for the latest work section. (eg; Our Latest Work)",
					"id" => "text_work_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "desc" => "Please select how many items you would like to show on the 'Latest Work' section.",
					"id" => "latest_select_work",
					"std" => "3",
					"type" => "select",
					"class" => "tiny",
					"options" => $of_options_latest_work_select);

$of_options[] = array( "desc" => "Choose to enable the 'Latest Work' filter option (Default is 'disabled').",
					"id" => "latest_work_filterable",
					"std" => false,
					"type" => "checkbox");

$of_options[] = array( "name" => "Latest News",
					"desc" => "Please enter a title for the latest news section. (eg; Our Latest News)",
					"id" => "text_news_title",
					"std" => "",
					"type" => "text");

$of_options[] = array( "desc" => "Please select how many items you would like to show on the 'Latest News' section.",
					"id" => "latest_select_news",
					"std" => "4",
					"type" => "select",
					"class" => "tiny",
					"options" => $of_options_latest_news_select);

$of_options[] = array( "name" => "Featured Area",
					"desc" => "Add a short excerpt of text to appear in the 'Featured' area.",
					"id" => "textarea_featured",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "desc" => "Please choose a button color for the 'Featured' area Call to Action.",
					"id" => "featured_select_button",
					"std" => "btn-inverse",
					"type" => "select",
					"class" => "tiny",
					"options" => $of_options_featured_button_style);

$of_options[] = array( "desc" => "Please enter the text for your button (eg; Find Out More)",
					"id" => "text_featured_button",
					"std" => "",
					"type" => "text");

$of_options[] = array( "desc" => "Please enter a URL for your button to point to.",
					"id" => "url_featured_button",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "General Settings",
                    "type" => "heading");

$of_options[] = array( "name" => "Text Logo",
					"desc" => "Choose to use just a text logo. If you choose not to, you can upload a logo below.",
					"id" => "text_logo",
					"std" => true,
					"type" => "checkbox");

$of_options[] = array( "name" => "Custom Logo",
					"desc" => "Upload your own logo to use on the site.",
					"id" => "custom_logo",
					"std" => "",
					"mod" => "min",
					"type" => "upload");

$of_options[] = array( "name" => "Twitter Username",
					"desc" => "Add your Twitter username to use in the theme. (eg; davesmith)",
					"id" => "text_twitter_user",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Facebook ID",
					"desc" => "Add your Facebook name, or ID to use in the theme. (eg; davesmith or 100000150670326)",
					"id" => "text_facebook_id",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "Dribbble Username",
					"desc" => "Add your Dribbble username to use in the theme. (eg; davesmith)",
					"id" => "text_dribble_user",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "Vimeo Username",
					"desc" => "Add your Vimeo Username to use in the theme. (eg; davesmith)",
					"id" => "text_vimeo_user",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "Flickr Username/ID",
					"desc" => "Add your Flickr ID to use in the theme. (You can enter either your username, or your ID).",
					"id" => "text_flickr_id",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "RSS Feed Address",
					"desc" => "Add your RSS Feed Address to use in the theme. (eg; myfeedname)",
					"id" => "text_rss_feed",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Linkedin Username",
					"desc" => "Add your Linkedin username to use in the theme. (eg; davesmith)",
					"id" => "text_linkedin_user",
					"std" => "",
					"type" => "text");	
					
$of_options[] = array( "name" => "Google + ID",
					"desc" => "Add your Google + ID to use in the theme. (eg; 103059444512412546381)",
					"id" => "text_google_id",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "Pinterest Username",
					"desc" => "Add your Pinterest username to use in the theme. (eg; envato)",
					"id" => "text_pinterest_user",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => "YouTube Username",
					"desc" => "Add your YouTube username to use in the theme. (eg; envato)",
					"id" => "text_youtube_user",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Google Analytics Tracking Code",
					"desc" => "Paste your Google Analytics tracking code here. This will be added into the footer template of your theme.<br /><br />Don't have Google Analytics? Visit this <a href=\"http://www.google.com/analytics\">link</a> to find out more.",
					"id" => "google_analytics",
					"std" => "",
					"type" => "textarea");   

$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px PNG/GIF image that will represent your website's favicon.",
					"id" => "custom_favicon",
					"std" => "",
					"mod" => "min",
					"type" => "upload");                                                        
    
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme. (Default is 'light').",
					"id" => "alt_stylesheet",
					"std" => "light.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$of_options[] = array( "name" => "Text Logo Styling",
					"desc" => "Specify the text logo font properties (if you chose this option on the previous page).",
					"id" => "logo_font",
					"std" => array('size' => '39px','face' => 'oswald','style' => 'normal','color' => '#000000'),
					"type" => "typography");
					
$of_options[] = array( "name" => "Body Font Styling",
					"desc" => "Specify the body font properties.",
					"id" => "body_font",
					"std" => array('size' => '13px','face' => 'muli','style' => 'normal','color' => '#000000'),
					"type" => "typography");

$of_options[] = array( "name" => "'Mission Statement' Styling",
					"desc" => "Specify the 'Mission Statement' font properties.",
					"id" => "mission_font",
					"std" => array('size' => '22px','face' => 'oswald','style' => 'normal','color' => '#000000'),
					"type" => "typography");
					
$of_options[] = array( "name" => "Headings Styling",
					"desc" => "Specify the h1, h2, h3, h4, h5 font properties.",
					"id" => "headings_font",
					"std" => array('face' => 'oswald','style' => 'normal','color' => '#000000'),
					"type" => "typography");
					
$of_options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme (default: #fff).",
					"id" => "body_color",
					"std" => "",
					"type" => "color");

$of_options[] = array( "name" =>  "Accent Color",
					"desc" => "Pick an accent color for your theme.",
					"id" => "accent_color",
					"std" => "#000",
					"type" => "color");  
					
$of_options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => "Portfolio Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Disable/Enable Filterable Portfolio",
					"desc" => "Choose to disable the filtered Portfolio option (Default is 'enabled').",
					"id" => "portfolio_filterable",
					"std" => true,
					"type" => "checkbox");

$of_options[] = array( "name" => "Portfolio Columns",
					"desc" => "Choose the column count for your Portfolio display.",
					"id" => "select_portfolio_columns",
					"std" => "2",
					"type" => "select",
					"options" => $of_options_portfolio_columns);

$of_options[] = array( "name" => "Portfolio Item Count",
					"desc" => "Please select how many items you would like to show on your Portfolio page.",
					"id" => "select_portfolio",
					"std" => "6",
					"type" => "select",
					"class" => "tiny",
					"options" => $of_options_portfolio_select);

$of_options[] = array( "name" => "Portfolio Layout",
					"desc" => "Choose the layout for your single Portfolio items.",
					"id" => "select_portfolio_layout",
					"std" => "1",
					"type" => "select",
					"options" => $of_options_portfolio_layout);

$of_options[] = array( "name" => "Related Projects",
					"desc" => "Choose to display 'Related Projects' on the single Portfolio pages.",
					"id" => "related_projects",
					"std" => true,
					"type" => "checkbox");

$of_options[] = array( "desc" => "Please enter a title for the related projects section. (eg; Related Projects or Other Work)",
					"id" => "text_related_title",
					"std" => "",
					"type" => "text");	   

$of_options[] = array( "name" => "Contact Page Settings",
					"type" => "heading");

$of_options[] = array( "name" => "Contact Address",
					"desc" => "Please enter your company address (eg; 123 Some Street, Washington.)",
					"id" => "text_contact_address",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Contact Telephone Number",
					"desc" => "Please enter your company telephone number (eg; 0800 345007.)",
					"id" => "text_contact_telephone",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Contact Fax Number",
					"desc" => "Please enter your company fax number (eg; 0800 345008.)",
					"id" => "text_contact_fax",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => "Contact Email",
					"desc" => "Please enter your company email address (eg; davesmith@mysite.com.)",
					"id" => "text_contact_email",
					"std" => "",
					"type" => "text");
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
