<?php

/*
Plugin Name: Hotspot Map for WordPress
Plugin URI: http://www.nikolaydyankovdesign.com/
Version: 1.0.3
Author: Nikolay Dyankov
Description: The hottest way to add annotations, text, or other stuff to an image.
*/

if (!class_exists('Hotspot_Map')) {
	class Hotspot_Map {
		function __construct() {
			$this->admin_options_name = 'hotspot-admin-options';
			$this->default_settings = array();
			$this->pagename = 'hotspot';
			$this->new_pagename = 'new_hotspot';
			
			$this->default_settings = array(
				'show_on' => 'mouseover'
			);
			$this->default_content = array(
				'imgurl' => NULL,
				'html' => NULL,
				'js' => NULL
			);
		}
		function get_admin_options() {
			// delete_option($this->admin_options_name);
			
			$loaded_options = get_option($this->admin_options_name);

			if (!empty($loaded_options)) {
				foreach ($loaded_options as $key => $option) {
					$admin_options[$key] = $option;
				}
			}
			update_option($this->admin_options_name, $admin_options);
			return $admin_options;
		}
		function init_pages() {
			add_menu_page(
				"Hotspot Map",
				"Hotspot Map",
				"manage_options",
				$this->pagename,
				array($this, 'print_options_page')
			);
			
			add_submenu_page(
				$this->pagename,
				"Add New Map",
				"Add New",
				"manage_options",
				$this->new_pagename,
				array($this, 'print_instance_options')
			);
		}
		
		function admin_includes() {
			wp_enqueue_script('jquery');
			wp_enqueue_script('hotspot-admin-js', plugins_url('/js/admin.js', __FILE__), false, '1.0', true);
			wp_enqueue_style('hotspot-admin-css', plugins_url('/css/admin.css', __FILE__), false, '1.0', false);
			
			wp_enqueue_script('hotspot-editor-js', plugins_url('/js/hotspot.editor.js', __FILE__), false, '1.0', true);
			wp_enqueue_style('hotspot-editor-css', plugins_url('/css/hotspot.editor.css', __FILE__), false, '1.0', false);
			
			wp_enqueue_script('hotspot-js', plugins_url('/js/hotspot.js', __FILE__), false, '1.0', true);
			wp_enqueue_style('hotspot-css', plugins_url('/css/hotspot.css', __FILE__), false, '1.0', false);
			
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('my-upload');
		}
		function user_includes() {
			wp_enqueue_script('jquery');
			wp_enqueue_script('hotspot-js', plugins_url('/js/hotspot.js', __FILE__), false, '1.0', true);
			wp_enqueue_style('hotspot-css', plugins_url('/css/hotspot.css', __FILE__), false, '1.0', false);
		}
		
		function print_options_page() {
			$options = $this->get_admin_options();
			
			if (isset($_GET['action'])) {
				if ($_GET['action'] == 'edit') {
					$this->print_instance_options();
				}
				if ($_GET['action'] == 'delete') {
					$this->delete_instance();
					$this->print_main_options();
				}
			} else {
				$this->print_main_options();
			}
		}
		function print_main_options() {
			$options = $this->get_admin_options();
			
			?>
			
			<div class="as">
				<header>
					<img width="80" src="<?php  $site_url = network_site_url( '/' ); echo $site_url; ?>/wp-content/themes/revelryhouse/img/rev_logo.png">
					<h2>Revelry House > Collections</h2>
					<h1> Hotspot Image</h1>
				</header>
				
				<div class="as-c">
					
					<?php if (count($options['maps']) == 0) { ?>
						<div class="greetings">Hey! Seems like you haven't created any maps yet. Start by clicking the big green button below!</div>
					<?php } else { ?>
					<table class="ndd-clean-table ndd-yellow-rows">
						<thead>
							<tr>
								<th class="ndd-column-name">Image Name</th>
								<th class="ndd-column-shortcode">Shortcode</th>
								<th class="ndd-column-delete">Delete</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
								$count = count($options['maps']);
								$i=0;
								foreach ($options['maps'] as $map) {
									$yellow_class = '';
									if ($map['new']) {
										$yellow_class = 'ndd-new-row';
									}
									$options['maps'][$map['id']]['new'] = false;
									update_option($this->admin_options_name, $options);
									
									$lastrow_class = '';
									if ($i == $count - 1) {
										$lastrow_class = 'lastrow';
									}
										
									$i++;
							?>
							
									<tr class="<?php echo $yellow_class; echo ' ' . $lastrow_class; ?>">
										<td class="ndd-column-name"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $map['id']; ?>&action=edit"><?php echo $map['title']; ?></a></td>
										<td class="ndd-column-shortcode"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $map['id']; ?>&action=edit">[hsmap name="<?php echo $map['shortcode']; ?>"]</a></td>
										<td class="ndd-column-delete"><div class="ndd-delete-cell-wrap"><a href="?page=<?php echo $this->pagename; ?>&id=<?php echo $map['id']; ?>&action=delete" class="ndd-delete-row"></a></div></td>
									</tr>
							
							<!-- END FOREACH -->
							<?php } ?>
							
						</tbody>
					</table>
					<div class="table-border-bottom"></div>
					
					<!-- END ELSE -->
					<?php }  ?>
					
					<a href="?page=<?php echo $this->new_pagename; ?>" class="ndd-button-green-regular"><span class="icon-plus"></span> New map</a>
				</div>
				
				<footer>
					<ul>
						<li><span>Designed and developed by</span><a href="http://www.kithent.com"><img width="100" src="http://kithent.com/images/kith_logo.png"></a></li>
						<li><span>In partnership with</span><a href="http://www.vexterdesign.com/"><img src="http://www.vexterdesign.com/images/logo.png"></a></li>
						
					</ul>
					
				</footer>
				<div class="clear"></div>
			</div>
			
			<?php
			
			$this->admin_includes();
		}
		function print_instance_options() {
			if (isset($_POST['save_options'])) {
				$this->save_options();
			}

			$options = $this->get_admin_options();
			
			// Change the title of the page if action is "New" or "Edit"
			
			if ($_GET['page'] == $this->new_pagename) {
				$submit_name = "Create Map";
				$pagetitle = 'New Map';
				$title = '';
				$shortcode = '';
				$id = rand(0, 10000);
				
				$settings = $this->default_settings;
				$content = $this->default_content;
			} else {
				$submit_name = "Save Changes";
				$id = $_GET['id'];
				$map = $options['maps'][$id];
				$pagetitle = 'Edit Map';
				$title = $map['title'];
				$shortcode = $map['shortcode'];
				
				$settings = $map['settings'];
				$content = $map['content'];
			}
			
			$uri = $_SERVER["REQUEST_URI"];
			$uri_ar = explode('?', $uri);

			$uri = $uri_ar[0] . '?page=' . $this->pagename . '&id=' . $id . '&action=edit';
			
			
			?>
			<form action="<?php echo $uri; ?>" method="post">
			<div class="as">
				<header class="ndd-subpage-header">
					<a href="?page=<?php echo $this->pagename; ?>" class="ndd-back-link">Back</a>
					<h1><?php echo $pagetitle; ?></h1>
					<div class="ndd-button-submit-wrap">
						
						<!-- OUTPUT FIELDS -->
						
						<input type="text" class="ndd-invisible" id="imgurl" name="imgurl" value="<?php if ($map['content']['imgurl'] != NULL) echo $map['content']['imgurl']; ?>">
						<textarea class="ndd-invisible" id="spots-json" name="spots-json"><?php echo stripslashes($map['content']['spots-json']); ?></textarea>
						
						<!--  -->
						
						<input class="ndd-button-submit" name="save_options" type="submit" class="button-primary" id="save_options" value="<?php echo $submit_name; ?>">
					</div>
					<?php if (isset($_POST['save_options'])) { ?>
						<div class="updated"><p><strong> <?php echo _e("Settings Updated!", "CommentWordFilter"); ?> </strong></p></div>
					<?php } ?>
				</header>
				
				<div class="as-c">
					<div class="ndd-tab-group">
						<ul>
							<li class="active">General</li>
							<li>Settings</li>
							<li id="editor-tab">Editor</li>
							<li class="preview-tab">Preview</li>
						</ul>
						
						<div class="ndd-tab active">
							<?php 
								if ($pagetitle == 'New Map') {
									echo '<div class="greetings">Start by filling in the title and shortcode, then head over to the Content and Settings tabs above to further setup your map.</div>';
								}
							?>
							<table class="form-table ndd-yellow-rows">
								<tr>
									<td>
									<h2><label for="title">Title</label></h2>
									<input type="text" name="title" id="title" value="<?php echo $title; ?>" class="ndd-large-input">
									<div class="ndd-form-help">The title is used only for convenience in the admin panel. It will not be visible for the page visitor.</div>
									</td>
								</tr>
								<tr class="blank">
									<td>
										&nbsp;
									</td>
								</tr>
								<tr>
									<td>
									<h2><label for="shortcode">Shortcode</label></h2>
									<input type="text" name="shortcode" id="shortcode" value="<?php echo $shortcode; ?>" class="ndd-large-input">
									<div class="ndd-form-help">This is the shortcode that you will use to include this map in a page or a template.</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="ndd-tab">
							
							<table class="form-table ndd-yellow-rows">
								<tr valign="top">
									<th scope="row"><label for="show_on">Show popups on:</label></th>
									<td>
										<select id="show_on" name="show_on" autocomplete="off">
											<option value="mouseover" <?php if ($settings['show_on'] == 'mouseover') echo 'selected'; ?>>Mouseover</option>
											<option value="click" <?php if ($settings['show_on'] == 'click') echo 'selected'; ?>>Click</option>
											<option value="always" <?php if ($settings['show_on'] == 'always') echo 'selected'; ?>>Always Visible</option>
										</select>
										<div class="form-help">This option determines how the user will trigger the tooltips - when he clicks on the spot, when he hovers the mouse over it, or the tooltips will be visible all the time. This is not active in the content builder.</div>
									</td>
								</tr>
							</table>
							
						</div>
						<div class="ndd-tab">
							<?php 
								if ($pagetitle == 'New Map') {
									echo '<div class="greetings">Start by inserting an image. Then click the on the image to add a new hotspot, or click and drag to add a rectangular hotspot.</div>';
								}
							?>
							<h2 class="with-margin">1. Choose an image</h2>
							<div class="choose-image-wrap">
								<div class="hb-change-image">Pick an image...</div>
								<div class="hb-paste-url">
									<label for="new-image-url">Or paste image url: </label>
									<input type="text" id="new-image-url">
									<div class="ndd-form-help">Use this field if you are having problems with the image uploader, or if you wish to use an external image.</div>
								</div>
							</div>
							<h2 class="with-margin">2. Edit the map</h2>
							<div id="hb-main-wrap" class="hb-main-wrap">
								<div id="hb-settings-wrap">
									<table>
										<tr>
											<td width="100">Spot visibility: </td>
											<td>
												<select id="visible-select">
													<option value="visible">Visible</option>
													<option value="invisible" selected>Invisible</option>
												</select>
												<div class="form-help">Determines the visibility of the spot. If set to "invisible", the user will not know that there is a spot, unless he triggers it. <br />The spot will not look the same in the final product as it looks in the content builder.</div>
											</td>
										</tr>
										<tr>
											<td width="100">Tooltip width: </td>
											<td>
												<input type="text" id="tooltip-width">
												<!-- <br /> -->
												<input type="checkbox" id="tooltip-auto-width" checked value="Auto"><label for="tooltip-auto-width">Auto</label>
												<div class="form-help">If you need a fixed value for the tooltip set a number in pixels (without "px") in the text field. If you don't, then check "Auto".</div>
											</td>
										</tr>
										<tr>
											<td>Popup position: </td>
											<td>
												<select id="position-select">
													<option value="left" selected>Left</option>
													<option value="right">Right</option>
													<option value="top">Top</option>
													<option value="bottom">Bottom</option>
												</select>
												<div class="form-help">Choose where you want the popup to appear, relative to the spot that it belongs to.</div>
											</td>
										</tr>
										<tr>
											<td>Content: </td>
											<td>
												<textarea id="content" autocomplete="off"></textarea>
											</td>
										</tr>
										<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
										<tr>
											<td>Delete?</td>
											<td><input type="button" id="delete" value="Delete Spot"></td>
										</tr>
									</table>
								</div>
								<?php if ($content['imgurl'] == NULL || $content['imgurl'] == 'undefined') { ?>
								
									<div id="hb-map-wrap" class="noimage">
										<p>No image selected.</p>
									</div>
								
								<?php } else { ?>
									
									<div id="hb-map-wrap">
										<img src="<?php echo $content['imgurl']; ?>">
									</div>

									
								<?php } ?>
								<div class="clear"></div>
							</div>
						</div>
						<div class="ndd-tab preview-tab-c">
							<?php do_shortcode('[hsmap name="' . $map['shortcode'] . '"]'); ?>
						</div>
					</div>
					
				</div>
				
				<footer>
					<ul>
						<li><span>Designed and developed by</span><a href="http://www.kithent.com"><img width="100" src="http://kithent.com/images/kith_logo.png"></a></li>
						<li><span>In partnership with</span><a href="http://www.vexterdesign.com/"><img src="http://www.vexterdesign.com/images/logo.png"></a></li>
						
					</ul>
				</footer>
			</div>
			
			<?php
			
			$this->admin_includes();
			$this->call_plugins();
		}

		function save_options() {
			$options = $this->get_admin_options();
			$id = $_GET['id'];

			if (!isset($_GET['id'])) {
				$id = str_replace(' ', '-', strtolower($_POST['title']));
				$map = array();
			} else {
				$map = $options['maps'][$id];
			}
			
			if (!isset($map['id'])) {
				$map['new'] = true;
			}
			
			$map['id'] = $id;
			$map['title'] = $_POST['title'];
			$map['shortcode'] = $_POST['shortcode'];
			
			// Settings 
			
			if (isset($_POST['show_on'])) {
				$map['settings']['show_on'] = $_POST['show_on'];
			}
			
			// --------
			
			// Content
			if (isset($_POST['imgurl'])) {
				$map['content']['imgurl'] = $_POST['imgurl'];
			}
			if (isset($_POST['spots-json'])) {
				$map['content']['spots-json'] = $_POST['spots-json'];
			}
			
			// -------
			
			$options['maps'][$id] = $map;
			update_option($this->admin_options_name, $options);
		}
		function delete_instance() {
			$options = $this->get_admin_options();
			unset($options['maps'][$_GET['id']]);
			update_option($this->admin_options_name, $options);
		}
	
		function shortcodes() {
			$options = $this->get_admin_options();

			add_shortcode('hsmap', array($this, 'print_shortcode'));
		}
		function print_shortcode($atts) {
			$options = $this->get_admin_options();
			$shortcode = $atts['name'];
			
			foreach($options['maps'] as $result) {
				if ($result['shortcode'] == $shortcode) {
					$map = $result;
				}
			}
			
			$html = '';
			$spots = json_decode(stripslashes($map['content']['spots-json']));

			if ($spots) {
				$html = '<div id="hotspot-' . $map['id'] . '" class="hs-wrap hs-loading">';
				$html .= '<img src="' . $map['content']['imgurl'] . '">';
				foreach ($spots as $spot) {
					// Correct some settings
					$spot->settings->tooltip_auto_width = ($spot->settings->tooltip_auto_width == 1) ? "true" : "false";
					
					// Html
					$html .= '<div class="hs-spot-object" data-type="' . $spot->type . '" data-x="' . $spot->x . '" data-y="' . $spot->y . '" data-width="' . $spot->width . '" data-height="' . $spot->height . '" data-popup-position="' . $spot->settings->popup_position . '" data-visible="' . $spot->settings->visible . '" data-tooltip-width="' . $spot->settings->tooltip_width . '" data-tooltip-auto-width="' . $spot->settings->tooltip_auto_width . '">' . "\n";
					$html .= stripslashes($spot->settings->content) . "\n";
					$html .= '</div>';
				}
				$html .= '</div>';
			}

			if ($_GET['page'] == $this->pagename) {			
				echo $html;
			} else {
				return $html;
			}
		}
		function call_plugins() {
			$options = $this->get_admin_options();
			
			?>
			
			<script>
				(function($, undefined) {
					$(document).ready(function() {
						
						<?php 
							foreach($options['maps'] as $map) { 
								$show_on = $map['settings']['show_on'];
						?>
						
						$('#hotspot-<?php echo $map['id']; ?>').hotspot({
							'show_on' : "<?php echo $show_on; ?>",
						});
						
						<?php } ?>
					});
				})(jQuery);
			</script>
			
			<?php
		}
	}
}

if (class_exists('Hotspot_Map')) {
	$map = new Hotspot_Map();
	$map->shortcodes();
}

add_action('admin_menu', array($map, 'init_pages'));
add_action('wp_enqueue_scripts', array($map, 'user_includes'));
add_action('wp_footer', array($map, 'call_plugins'));