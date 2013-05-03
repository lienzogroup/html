=== Plugin Name ===
Contributors:      myphpmaster
Plugin Name:       Form Lightbox
Plugin URI:        http://www.myphpmaster.com/form-lightbox/
Tags:              form lightbox,pop-up
Author URI:        http://www.myphpmaster.com/
Author:            myphpmaster
Donate link:       http://www.myphpmaster.com/donate/
Requires at least: 2.8.1 
Tested up to:      3.2.1
Stable tag:        1.1.2
Version:           1.1.2

This plugin will turn the form to lightbox. Support Gravity Form and Contact Form 7 shortcode.

== Description ==
If you need the pop-up or lightbox for your form or any other inline content. Here the plugin!!


Please visit plugin site <a href="http://www.myphpmaster.com/form-lightbox/">here</a>

== Installation ==

1. Upload `form-lightbox` folder to the `/wp-content/plugins/` directory
2. Activate the `Form Lightbox` plugin through the 'Plugins' menu in WordPress
3. Place caller shortcode [formlightbox_call title="lightbox form" class="1322379893472"]Click here[/formlightbox_call] and object shortcode
[formlightbox_obj id="1322379893472" style="" onload="false"][form shortcode here][/formlightbox_obj] in your post/page or use button in text-editor.
4. Edit setting in pugin admin setting page under Settings > Form Lightbox.

== Frequently Asked Questions ==

= Is it support Gravity Form and Contact Form 7 =

This plugin support shortcode, so it support CF7 and Gravity Form.

= What about custom html form? =

Absolutely yes.

== Screenshots ==
1. Front-end
2. Back-end


== Changelog ==

= 1.1.2 =
* auto updating issue

= 1.1.1 =
* solved onload='false' problem

= 1.1 =
* New admin page to control settings
* Two type of lightbox: Fancybox and Colorbox
* New id structure to avoid conflict
* Option to add lightbox to WP Menu

= 1.0.1.1 =
* Update fancybox.css z-index value.

= 1.0.1 =
* Add new shortcode [formlightbox_call] and [formlightbox_obj]
* Use class for caller which can be called multiple times.