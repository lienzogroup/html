<?php
/***************** AJAX REQUEST FUNCTIONS ***************************/
if(isset($_GET['a'])) {

	switch ($_GET['a']) {
	
		// Login Request
		case 'login':
			login();
			break;
			
		// Logout Request
		case 'logout':
			wp_logout();
			break;
			
		// Logout Request
		case 'join':
			$user_id = username_exists( $_POST['user_email'] );
			if ( !$user_id and email_exists($_POST['user_email']) == false ) {
				$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$user_id = wp_create_user( $_POST['user_email'], $_POST['user_pass'], $_POST['user_email'] );
				
				$data = array(
					"ID" => $user_id,
					"display_name" =>$_POST['user_name']
				);
				wp_update_user( $data );
				login();
			} else {
				echo 'User Email already exists.';
			}
			break;
			
		// CHECK USER LOGIN
		case 'check_user_login':
			check_user_login();
			break;
			
		// Change Password
		case 'forgot_pass':
			forgot_pass();
			break;
	}
	
exit;	
}
/* LOGIN*/
function login() {
	$creds['user_login'] = isset($_POST['user_email']) ? $_POST['user_email'] : $_POST['email'];
	$creds['user_password'] = isset($_POST['user_pass']) ? $_POST['user_pass'] : $_POST['password'];
	$creds['remember'] = true;
	
		$user = wp_signon( $creds, false );
		if ( is_wp_error($user) ) {
			//echo $user->get_error_message(); 
			echo 'Invalid email and password.';
		}
		else {
			echo 1;
		}
}
/* CHANGE PASSWORD */
function change_pass() {
	// check password
	$user = get_user_by( 'id', $_POST['user_id'] );		
	if ( $user && wp_check_password( $_POST['user_pass'], $user->data->user_pass, $user->ID) ) {
		wp_set_password($_POST['new_pass'],$user->ID);
		echo 1;
	}
	else {
	   echo "Invalid password."; }
}
/* CHECK USER LOGIN */
function check_user_login() {
	
	if ( email_exists($_POST['email']) ) {
		echo 1;
	}
	else {
	   echo "Invalid email address."; }
}

/***************** AJAX REQUEST FUNCTIONS ***************************/

/***************** PRODUCT FIELD GROUPS*****************************/
	class cfs_product extends cfs_field
	{

		function __construct($parent)
		{
			$this->name = 'product';
			$this->label = __('Product', 'cfs');
			$this->parent = $parent;
		}

		function html($field)
		{
			$multiple = '';

			// Multi-select
			if (isset($field->options['multiple']) && '1' == $field->options['multiple'])
			{
				$multiple = ' multiple';

				if (empty($field->input_class))
				{
					$field->input_class = 'multiple';
				}
				else
				{
					$field->input_class .= ' multiple';
				}
			}
			// Single-select
			elseif (!isset($field->input_class))
			{
				$field->input_class = '';
			}

			// Select boxes should return arrays (unless "force_single" is true)
			if ('[]' != substr($field->input_name, -2) && empty($field->options['force_single']))
			{
				$field->input_name .= '[]';
			}
		?>

	<?php
	/****************************************************/
	// GET ALL PRODUCT PUBLISH
		$sqlQuery = "SELECT * FROM wp_posts WHERE post_status='publish' ";
		$sqlQuery .= "AND post_type='product' ORDER BY ID ASC";
	$result = mysql_query($sqlQuery);
	while($row = mysql_fetch_array($result)) {
		$product[$row['ID']] = $row['post_title'];
	}
	// SET THE VALUE FOR DROPDOWN
	$field->options['choices'] = $product; 
	/****************************************************/
	?>        
			<select name="<?php echo $field->input_name; ?>" class="<?php echo $field->input_class; ?>"<?php echo $multiple; ?>>
			<?php foreach ($field->options['choices'] as $val => $label) : ?>
				<?php $val = ('{empty}' == $val) ? '' : $val; ?>
				<?php $selected = in_array($val, (array) $field->value) ? ' selected' : ''; ?>
				<option value="<?php echo esc_attr($val); ?>"<?php echo $selected; ?>><?php echo esc_attr($label); ?></option>
			<?php endforeach; ?>
			</select>
		<?php
		}

		function input_head()
		{
		?>
			<script>
			(function($) {
				$(function() {
					$(document).on('cfs/ready', '.cfs_add_field', function() {
						$('.cfs_select:not(.ready)').init_select();
					});
					$('.cfs_select').init_select();
				});

				$.fn.init_select = function() {
					this.each(function() {
						var $this = $(this);
						$this.addClass('ready');
					});
				}
			})(jQuery);
			</script>
		<?php
		}

		function options_html($key, $field)
		{
			// Convert choices to textarea-friendly format
			if (isset($field->options['choices']) && is_array($field->options['choices']))
			{
				foreach ($field->options['choices'] as $choice_key => $choice_val)
				{
					$field->options['choices'][$choice_key] = "$choice_key : $choice_val";
				}
				$field->options['choices'] = implode("\n", $field->options['choices']);
			}
			else
			{
				$field->options['choices'] = '';
			}
		?>
			<tr class="field_option field_option_<?php echo $this->name; ?>">
				<td class="label" colspan="2">
					<p class="description"><?php _e('WooCommerce plugin is required for this Field Type.', 'cfs'); ?></p>
				</td>
				<!--
				<td>
					<?php
						$this->parent->create_field(array(
							'type' => 'textarea',
							'input_name' => "cfs[fields][$key][options][choices]",
							'value' => $this->get_option($field, 'choices'),
						));
					?>
				</td>
				-->
			</tr>
			<tr class="field_option field_option_<?php echo $this->name; ?>">
				<td class="label">
					<label><?php _e('Multi-select?', 'cfs'); ?></label>
				</td>
				<td>
					<?php
						$this->parent->create_field(array(
							'type' => 'true_false',
							'input_name' => "cfs[fields][$key][options][multiple]",
							'input_class' => 'true_false',
							'value' => $this->get_option($field, 'multiple'),
							'options' => array('message' => __('This is a multi-select field', 'cfs')),
						));
					?>
				</td>
			</tr>
			<tr class="field_option field_option_<?php echo $this->name; ?>">
				<td class="label">
					<label><?php _e('Validation', 'cfs'); ?></label>
				</td>
				<td>
					<?php
						$this->parent->create_field(array(
							'type' => 'true_false',
							'input_name' => "cfs[fields][$key][options][required]",
							'input_class' => 'true_false',
							'value' => $this->get_option($field, 'required'),
							'options' => array('message' => __('This is a required field', 'cfs')),
						));
					?>
				</td>
			</tr>
		<?php
		}

		function format_value_for_api($value, $field)
		{
			$value_array = array();
			$choices = $field->options['choices'];

			// Return an associative array (value, label)
			foreach ($value as $val)
			{
				$value_array[$val] = isset($choices[$val]) ? $choices[$val] : $val;
			}

			return $value_array;
		}

		function prepare_value($value, $field)
		{
			return $value;
		}

		function pre_save_field($field)
		{
			$new_choices = array();
			$choices = trim($field['options']['choices']);

			if (!empty($choices))
			{
				$choices = str_replace("\r\n", "\n", $choices);
				$choices = str_replace("\r", "\n", $choices);
				$choices = (false !== strpos($choices, "\n")) ? explode("\n", $choices) : (array) $choices;

				foreach ($choices as $choice)
				{
					$choice = trim($choice);
					if (false !== ($pos = strpos($choice, ' : ')))
					{
						$array_key = substr($choice, 0, $pos);
						$array_value = substr($choice, $pos + 3);
						$new_choices[$array_key] = $array_value;
					}
					else
					{
						$new_choices[$choice] = $choice;
					}
				}
			}

			$field['options']['choices'] = $new_choices;

			return $field;
		}
	}
	/**********************************************/
	add_filter('cfs_field_types', 'productFieldType');
	function productFieldType($field_types)
	{
		$product_dir = get_template_directory().'/functions.php';
		$field_types['product'] = $product_dir;
		return $field_types;
	}
/***************** PRODUCT FIELD GROUPS*****************************/

	function btnCollection() {
		$data = '';
		if($custom_values ) {
			//QUERY
			$sql = "SELECT * FROM wp_posts WHERE post_status='publish' AND post_type='product' AND ID =".$custom_values;
			$result = mysql_query($sql);
			// Loop result
			while($row = mysql_fetch_array($result)) {
				$data = $row;
			}
		}
		return $data;
	}
?>