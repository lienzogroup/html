<?php

$api = new MCAPI('6451a33bba19399c015ba55ded336f38-us5');
$list_id = "b5fdf54d52";
$igs = $api->listInterestGroupings($list_id);
// If we don't have any interest groups store an empty array, not (bool) false
$igs = !$igs ? array() : $igs;
/**
 * Generate and display markup for Interest Groups
 * @param array $ig Set of Interest Groups to generate markup for
 * @return void
 */
function mailchimp_interest_group_field($ig) {
	if (!is_array($ig)) {
		return;
	}
	$html = '';
	$set_name = 'group['.$ig['id'].']';
	switch ($ig['form_field']) {
		case 'checkbox':
		case 'checkboxes':
			
			foreach($ig['groups'] as $interest){
                                $fid=$interest['bit'];
				$interest = $interest['name'];
                                $html .= '<li>
				<input type="checkbox" name="group_field[]" id="'.$fid.'" class="mc_interest" value="'.esc_attr($interest).'" />
				<label for="'. $fid.'" class="mc_interest_label">'.esc_html($interest).'</label>
				</li>';
				
			}
			break;
		case 'radio':
			foreach($ig['groups'] as $interest){
				$interest = $interest['name'];
				$html .= '<li>
				<input type="radio" name="group_field" id="'.esc_attr('mc_interest_'.$ig['id'].'_'.$interest).'" class="mc_interest" value="'.esc_attr($interest).'"/>
				<label for="'.esc_attr('mc_interest_'.$ig['id'].'_'.$interest).'" class="mc_interest_label">'.esc_html($interest).'</label>
				</li>';
			}
			break;
		case 'select':
		case 'dropdown':
			$html .= '
			<select name="group_field">
				<option value=""></option>';
				foreach($ig['groups'] as $interest){
					$interest = $interest['name'];
					$html .= '
					<option value="'.esc_attr($interest).'">'.esc_html($interest).'</option>';
				}
				$html .= '
			</select>';
			break;
		case 'hidden': 
			$i = 1;
			foreach($ig['groups'] as $interest) {
				$interest = $interest['name'];
				$html .= '<li>
				<input type="checkbox" name="group_field[]" id="'.esc_attr('mc_interest_'.$ig['id'].'_'.$interest).'" class="mc_interest" value="'.esc_attr($interest).'" />
				<label for="'. esc_attr('mc_interest_'.$ig['id'].'_'.$interest).'" class="mc_interest_label">'.esc_html($interest).'</label></li>';
				$i++;
			}
			break;
	}
	echo $html;
}  
       
?>
