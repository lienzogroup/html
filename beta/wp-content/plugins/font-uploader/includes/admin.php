<?php


function fu_admin_page() {
	add_theme_page( __('Font Uploader', 'fontuploader'), __('Font Uploader', 'fontuploader'), 'manage_options', 'font-uploader', 'fu_render_admin');
}
add_action('admin_menu', 'fu_admin_page');

function fu_render_admin() {

    $options = fu_setup_options();
    $i=0;

    if ( ! empty( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>' . __('Font Uploader settings saved.', 'fontuploader') . '</strong></p></div>';
	?>
	<div class="wrap">

		<h2>Font Uploader</h2>
		<p>Uploaded fonts will appear in the menus below</p>
		<form method="post" enctype="multipart/form-data" action="themes.php?page=font-uploader">
			<p><input type="file" name="font"></p>
			<input type="hidden" name="fu_action" value="upload"/>
			<?php echo wp_nonce_field('font-upload-nonce', 'font-upload-nonce'); ?>
			<div class="description"><em><?php _e('Filetypes accepted: ', 'fontuploader'); ?><strong>.ttf</strong>, <strong>.otf</strong>, and <strong>.eot</strong></em></div>
			<?php echo submit_button(__('Upload Font File', 'fontuploader'), 'secondary' ); ?>
		</form>


	    <form method="post">
	    	<table class="form-table">
			<?php
	        foreach ($options as $value):
	            switch ( $value['type'] ):
	                case "open":  break;
					case "close": ?>
	    					</td>
						</tr>
						<?php
						break;
	                case "title": ?>
						<p><?php _e('Apply your uploaded fonts to elements below:', 'fontuploader'); ?></p>
						<?php
						break;
					case 'text': ?>
						<tr class="form-field">
							<th scope="row" valign="top">
		    					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							</th>
							<td class="fu_input fu_text">
		    					<input name="<?php echo $value['id']; ?>" class="<?php echo $value['class']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != ""){ echo htmlentities(stripslashes(get_option( $value['id']))); } ?>" />
		    					<p class="description"><?php echo $value['desc']; ?></p>
							</td>
						</tr>
						<?php
	                    break;
	                case 'textarea': ?>
						<tr class="form-field">
							<th scope="row" valign="top">
		    					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							</th>
							<td class="fu_input fu_text">
		    					<textarea name="<?php echo $value['id']; ?>" class="<?php echo $value['class']; ?>" rows="10" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != ""){ echo htmlentities(stripslashes(get_option( $value['id']))); } ?></textarea>
		    					<p class="description"><?php echo $value['desc']; ?></p>
							</td>
						</tr>
						<?php
	                    break;
	                case 'select':
						?>
						<tr class="form-field">
							<th scope="row" valign="top">
		    					<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							</th>
							<td class="fu_input fu_select">
							    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="<?php echo $value['class']; ?>">
							    <?php foreach ($value['options'] as $option) { ?>
							        <option <?php if (get_option( $value['id'] ) == $option){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
							    <?php } ?>
							    </select>
							    <span class="description"><?php echo ! empty( $value['desc'] ) ? esc_html( $value['desc'] ) : ''; ?></span>
							</td>
						</tr>
						<?php
	                    break;
	                case "section":
	                    $i++; ?>
						<tr class="form-field">
						    <th scope="row" valign="top">
						    	<h3><?php echo $value['name']; ?></h3>
						   	</th>
						    <td class="fu_options">
	                        <?php
	                    break;
	            endswitch;
	        endforeach;
			?>
			</table>
	        <input type="hidden" name="action" value="save" />
	        <?php echo submit_button(__('Save Changes', 'fontuploader') ); ?>
	    </form>
	</div>
	<?php
}

function fu_setup_options() {

	$sn = 'fu';
	$fonts = fu_load_fonts();
	$font_sizes = fu_get_font_sizes();
	$options = array(

	    array( "name" => __('Font Upader', 'fontuploader'),
	        "type" => "title"),

	    array( "name" => __('Fonts', 'fontuploader'),
	        "type" => "section"),

	    array( "type" => "open"),

		 array(
		 	"name" => __('Headers', 'fontuploader'),
			"desc" => __('Font for header elements, such as h1, h2.', 'fontuploader'),
			"id" => $sn."_header_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),

		array(
		 	"name" => __('Lists', 'fontuploader'),
			"desc" => __('Font for list items', 'fontuploader'),
			"id" => $sn."_lists_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),

		array(
		 	"name" => __('Main Body', 'fontuploader'),
			"desc" => __('Font for the main body text of the website', 'fontuploader'),
			"id" => $sn."_body_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),

	    array( "type" => "close"),

	    array(
	    	"name" => __('Custom Elements', 'fontuploader'),
	        "type" => "section"
	    ),
	    array( "type" => "open"),

		array(
		 	"name" => __('Element Font', 'fontuploader'),
			"id" => $sn."_custom_one_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),
		array(
		 	"name" => __('Element', 'fontuploader'),
			"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
			"id" => $sn."_custom_one",
			"class" => "regular-text",
			"type" => "text"
		),
		array(
		 	"name" => __('Element Font', 'fontuploader'),
			"id" => $sn."_custom_two_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),
		array(
			"name" => __('Element', 'fontuploader'),
			"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
			"id" => $sn."_custom_two",
			"class" => "regular-text",
			"type" => "text"
		),
		array(
		 	"name" => __('Element Font', 'fontuploader'),
			"id" => $sn."_custom_three_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),
		array(
			"name" => __('Element', 'fontuploader'),
			"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
			"id" => $sn."_custom_three",
			"class" => "regular-text",
			"type" => "text"
		),
		array(
		 	"name" => __('Element Font', 'fontuploader'),
			"id" => $sn."_custom_four_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),
		array(
		 	"name" => __('Element', 'fontuploader'),
			"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
			"id" => $sn."_custom_four",
			"class" => "regular-text",
			"type" => "text"
		),
		array(
			"name" => __('Element Font', 'fontuploader'),
			"id" => $sn."_custom_five_font",
			"class" => "fu_font_list",
			"type" => "select",
			"options" => $fonts
		),
		array(
			"name" => __('Element', 'fontuploader'),
			"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
			"id" => $sn."_custom_five",
			"class" => "regular-text",
			"type" => "text"
		),

	    array( "type" => "close"),

	    array( "name" => __('Google Fonts', 'fontuploader'),
        "type" => "section"),
    array( "type" => "open"),

	 array( "name" => __('Google Font URLs', 'fontuploader'),
		"desc" => __('Enter the URLs to your Google fonts with each link on a new line.<br />The links should look like: &lt;link&gt; . . . &lt;/link&gt;', 'fontuploader'),
		"id" => $sn."_google_font_urls",
		"class" => "google_font_url large-text",
		"type" => "textarea"),
	 array( "name" => __('Google Font Name - Headers', 'fontuploader'),
		"desc" => __('Enter the name of the font. For example, if Google tells you <em>font-family: <strong>Tangerine</strong></em>, you type <em>Tangerine</em>', 'fontuploader'),
		"id" => $sn."_google_header_font_name",
		"type" => "text"),

	 array( "name" => __('Google Font Name - Body', 'fontuploader'),
		"desc" => __('Enter the name of the font. For example, if Google tells you <em>font-family: <strong>Lobster</strong></em>, you type <em>Lobster</em>', 'fontuploader'),
		"id" => $sn."_google_body_font_name",
		"type" => "text"),

	 array( "name" => __('Google Font Name - Lists', 'fontuploader'),
		"desc" => __('Enter the name of the font. For example, if Google tells you <em>font-family: <strong>Reanie Beanie</strong></em>, you type <em>Reanie Beanie</em>', 'fontuploader'),
		"id" => $sn."_google_lists_font_name",
		"type" => "text"),

    array( "type" => "close"),

    array( "name" => __('Internet Explorer (7,8,9) Fonts', 'fontuploader'),
        "type" => "section"),
    array( "type" => "open"),

	 array( "name" => __('IE Headers', 'fontuploader'),
		"desc" => __('Font for IE header elements, such as h1, h2. This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"id" => $sn."_ie_header_font",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $fonts),
	 array( "name" => __('Lists', 'fontuploader'),
		"desc" => __('Font for IE list items. This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"id" => $sn."_ie_lists_font",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $fonts),
	 array( "name" => __('IE Main Body', 'fontuploader'),
		"desc" => __('Font for the main body text of the website. This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"id" => $sn."_ie_body_font",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $fonts),

    array( "type" => "close"),

    array( "name" => __('IE (7,8,9) Custom Elements', 'fontuploader'),
        "type" => "section"),
    array( "type" => "open"),

	array( "name" => __('Element', 'fontuploader'),
		"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
		"id" => $sn."_ie_custom_one",
		"type" => "text"),
	array( "name" => __('Element Font', 'fontuploader'),
		"id" => $sn."_ie_custom_one_font",
		"class" => "fu_font_list",
		"type" => "select",
		"desc" => __('This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"options" => $fonts),

	array( "name" => __('Element', 'fontuploader'),
		"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
		"id" => $sn."_ie_custom_two",
		"type" => "text"),
	array( "name" => __('Element Font', 'fontuploader'),
		"id" => $sn."_ie_custom_two_font",
		"class" => "fu_font_list",
		"type" => "select",
		"desc" => __('This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"options" => $fonts),

	array( "name" => __('Element', 'fontuploader'),
		"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
		"id" => $sn."_ie_custom_three",
		"type" => "text"),
	array( "name" => __('Element Font', 'fontuploader'),
		"id" => $sn."_ie_custom_three_font",
		"class" => "fu_font_list",
		"type" => "select",
		"desc" => __('This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"options" => $fonts),

	array( "name" => __('Element', 'fontuploader'),
		"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
		"id" => $sn."_ie_custom_four",
		"type" => "text"),
	array( "name" => __('Element Font', 'fontuploader'),
		"id" => $sn."_ie_custom_four_font",
		"class" => "fu_font_list",
		"type" => "select",
		"desc" => __('This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"options" => $fonts),

	array( "name" => __('Element', 'fontuploader'),
		"desc" => __('Enter the ID or class selector for the element you\'d like to <em>fontify</em>. For example, <em>#navigation</em>, or <em>.element p</em>', 'fontuploader'),
		"id" => $sn."_ie_custom_five",
		"type" => "text"),
	array( "name" => __('Element Font', 'fontuploader'),
		"id" => $sn."_ie_custom_five_font",
		"class" => "fu_font_list",
		"type" => "select",
		"desc" => __('This must be a <strong>.eot</strong> file.', 'fontuploader'),
		"options" => $fonts),

	array( "type" => "close"),

    array( "name" => __('Font Sizes', 'fontuploader'),
        "type" => "section"),
    array( "type" => "open"),

	array( "name" => __('Header Size', 'fontuploader'),
		"desc" => __('Font size for header elements, such as h1, h2.', 'fontuploader'),
		"id" => $sn."_header_font_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),
	array( "name" => __('List Size', 'fontuploader'),
		"desc" => __('Font size for list items', 'fontuploader'),
		"id" => $sn."_lists_font_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),
	array( "name" => __('Main Body Size', 'fontuploader'),
		"desc" => __('Font size for the main body text of the website', 'fontuploader'),
		"id" => $sn."_body_font_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),

	array( "name" => __('Custom Font Sizes', 'fontuploader'),
        "type" => "section"),
    array( "type" => "open"),

	array( "name" => __('Custom Element One', 'fontuploader'),
		"desc" => __('Enter the element id that you would like to control the size of. Example: <span style="font-style:normal;"">.navigation li</span>', 'fontuploader'),
		"id" => $sn."_custom_one_size_element",
		"type" => "text"),
	array( "name" => __('Element Font Size', 'fontuploader'),
		"desc" => __('Choose the font size for the custom element defined above.', 'fontuploader'),
		"id" => $sn."_custom_one_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),

	array( "name" => __('Custom Element Two', 'fontuploader'),
		"desc" => __('Enter the element id that you would like to control the size of. Example: <span style="font-style:normal;"">.navigation li</span>', 'fontuploader'),
		"id" => $sn."_custom_two_size_element",
		"type" => "text"),
	array( "name" => __('Element Font Size', 'fontuploader'),
		"desc" => __('Choose the font size for the custom element defined above.', 'fontuploader'),
		"id" => $sn."_custom_two_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),

	array( "name" => __('Custom Element Three', 'fontuploader'),
		"desc" => __('Enter the element id that you would like to control the size of. Example: <span style="font-style:normal;"">.navigation li</span>', 'fontuploader'),
		"id" => $sn."_custom_three_size_element",
		"type" => "text"),
	array( "name" => __('Element Font Size"', 'fontuploader'),
		"desc" => __('Choose the font size for the custom element defined above.', 'fontuploader'),
		"id" => $sn."_custom_three_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),

	array( "name" => __('Custom Element Four', 'fontuploader'),
		"desc" => __('Enter the element id that you would like to control the size of. Example: <span style="font-style:normal;"">.navigation li</span>', 'fontuploader'),
		"id" => $sn."_custom_four_size_element",
		"type" => "text"),
	array( "name" => __('Element Font Size', 'fontuploader'),
		"desc" => __('Choose the font size for the custom element defined above.', 'fontuploader'),
		"id" => $sn."_custom_four_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),

	array( "name" => __('Custom Element Five', 'fontuploader'),
		"desc" => __('Enter the element id that you would like to control the size of. Example: <span style="font-style:normal;"">.navigation li</span>', 'fontuploader'),
		"id" => $sn."_custom_five_size_element",
		"type" => "text"),
	array( "name" => __('Element Font Size', 'fontuploader'),
		"desc" => __('Choose the font size for the custom element defined above.', 'fontuploader'),
		"id" => $sn."_custom_five_size",
		"class" => "fu_font_list",
		"type" => "select",
		"options" => $font_sizes),


    array( "type" => "close"),


	);

	return $options;
}

function fu_save_options() {

	global $pagenow;

    $options = fu_setup_options();

    if ( isset( $_GET['page'] ) && $_GET['page'] == 'font-uploader'  && $pagenow == 'themes.php') {

        if ( ! empty( $_REQUEST['action'] ) && 'save' == $_REQUEST['action'] ) {

            foreach ( $options as $value ) {
            	if( isset( $value['id'] ) )
                update_option( $value['id'], $_REQUEST[ $value['id'] ] );
            }

            foreach ( $options as $value ) {

                if( isset( $value['id'] ) && isset( $_REQUEST[ $value['id'] ] ) ) {

                    update_option( $value['id'], $_REQUEST[ $value['id'] ]  );

                } elseif( isset( $value['id'] ) ) {

                    delete_option( $value['id'] );

                }

            }
        }
    }
}
add_action('admin_init', 'fu_save_options');