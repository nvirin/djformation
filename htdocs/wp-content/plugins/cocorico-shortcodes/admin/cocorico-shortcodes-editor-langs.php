<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function coco_shortcodes_tinymce_translation() {
    $strings = array(
    	// Column shortcode strings
    	'column'				=> _x('Column', 'tinymce button label', 'cocoshortcodes'),
        'column_add'			=> _x('Add a column', 'tinymce popup title', 'cocoshortcodes'),
        
        'column_size'			=> _x('Size', 'tinymce popup attribute label', 'cocoshortcodes'),
        'column_one_half'		=> _x('one_half', 'shortcode attribute value', 'cocoshortcodes'),
        'column_one_third'		=> _x('one_third', 'shortcode attribute value', 'cocoshortcodes'),
        'column_two_thirds'		=> _x('two_thirds', 'shortcode attribute value', 'cocoshortcodes'),
        'column_one_fourth'		=> _x('one_fourth', 'shortcode attribute value', 'cocoshortcodes'),
        'column_three_fourths'	=> _x('three_fourths', 'shortcode attribute value', 'cocoshortcodes'),
        
        'column_position'		=> _x('Position', 'tinymce popup attribute label', 'cocoshortcodes'),
        'column_first'			=> _x('First', 'tinymce popup select label', 'cocoshortcodes'),
        'column_first_value'	=> _x('first', 'shortcode attribute value', 'cocoshortcodes'),
        'column_middle'			=> _x('Middle', 'tinymce popup select label', 'cocoshortcodes'),
        'column_middle_value'	=> _x('middle', 'shortcode attribute value', 'cocoshortcodes'),
        'column_last'			=> _x('Last', 'tinymce popup select label', 'cocoshortcodes'),
        'column_last_value'		=> _x('last', 'shortcode attribute value', 'cocoshortcodes'),
        
        'column_content'		=> _x('Content', 'tinymce popup input label', 'cocoshortcodes'),
        
        'column_shortcode'		=> _x('cocorico_column', 'shortcode name', 'cocoshortcodes'),
        'column_size_att'		=> _x('size', 'shortcode attribute name', 'cocoshortcodes'),
        'column_position_att'	=> _x('position', 'shortcode attribute name', 'cocoshortcodes'),
        
        // Column shortcode strings
        
        'message'				=> _x('Message box', 'tinymce button label', 'cocoshortcodes'),
        'message_add'			=> _x('Add a message box', 'tinymce popup title', 'cocoshortcodes'),
        
        'message_type'			=> _x('Type', 'tinymce popup attribute label', 'cocoshortcodes'),
        'message_classic'		=> _x('Classic', 'tinymce popup select label', 'cocoshortcodes'),
        'message_classic_value'	=> _x('classic', 'shortcode attribute value', 'cocoshortcodes'),
        'message_info'			=> _x('Info', 'tinymce popup select label', 'cocoshortcodes'),
        'message_info_value'	=> _x('info', 'shortcode attribute value', 'cocoshortcodes'),
        'message_alert'			=> _x('Alert', 'tinymce popup select label', 'cocoshortcodes'),
        'message_alert_value'	=> _x('alert', 'shortcode attribute value', 'cocoshortcodes'),
        'message_error'			=> _x('Error', 'tinymce popup select label', 'cocoshortcodes'),
        'message_error_value'	=> _x('error', 'shortcode attribute value', 'cocoshortcodes'),
        'message_success'		=> _x('Success', 'tinymce popup select label', 'cocoshortcodes'),
        'message_success_value'	=> _x('success', 'shortcode attribute value', 'cocoshortcodes'),
        
        'message_content'		=> _x('Content', 'tinymce popup input label', 'cocoshortcodes'),
        
        'message_shortcode'		=> _x('cocorico_message', 'shortcode name', 'cocoshortcodes'),
        'message_type_att'		=> _x('type', 'shortcode attribute name', 'cocoshortcodes'),
        
        // Button shortcode strings
        
        'button'				=> _x('Button', 'tinymce button label', 'cocoshortcodes'),
        'button_add'			=> _x('Add a button', 'tinymce popup title', 'cocoshortcodes'),
        
        'button_url'			=> _x('URL', 'tinymce popup attribute label', 'cocoshortcodes'),
        'button_label'			=> _x('Label', 'tinymce popup attribute label', 'cocoshortcodes'),
        
        'button_target'			=> _x('URL Target', 'tinymce popup attribute label', 'cocoshortcodes'),
        'button_link_same'		=> _x('Current window', 'tinymce popup select label', 'cocoshortcodes'),
        'button_link_same_value'=> _x('current_window', 'shortcode attribute value', 'cocoshortcodes'),
        'button_link_other'		=> _x('New window', 'tinymce popup select label', 'cocoshortcodes'),
        'button_link_other_value'=> _x('new_window', 'shortcode attribute value', 'cocoshortcodes'),
        
        'button_style_label'	=> _x('Styling', 'tinymce section title', 'cocoshortcodes'),
        
        'button_size'			=> _x('Size', 'tinymce popup attribute label', 'cocoshortcodes'),
        'button_small'			=> _x('Small', 'tinymce popup select label', 'cocoshortcodes'),
        'button_small_value'	=> _x('small', 'shortcode attribute value', 'cocoshortcodes'),
        'button_medium'			=> _x('Medium', 'tinymce popup select label', 'cocoshortcodes'),
        'button_medium_value'	=> _x('medium', 'shortcode attribute value', 'cocoshortcodes'),
        'button_large'			=> _x('Large', 'tinymce popup select label', 'cocoshortcodes'),
        'button_large_value'	=> _x('large', 'shortcode attribute value', 'cocoshortcodes'),
        
        'button_color'			=> _x('Color', 'tinymce popup attribute label', 'cocoshortcodes'),
        'button_grey'			=> _x('Grey', 'tinymce popup select label', 'cocoshortcodes'),
        'button_grey_value'		=> _x('grey', 'shortcode attribute value', 'cocoshortcodes'),
        'button_purple'			=> _x('Purple', 'tinymce popup select label', 'cocoshortcodes'),
        'button_purple_value'	=> _x('purple', 'shortcode attribute value', 'cocoshortcodes'),
        'button_blue'			=> _x('Blue', 'tinymce popup select label', 'cocoshortcodes'),
        'button_blue_value'		=> _x('blue', 'shortcode attribute value', 'cocoshortcodes'),
        'button_turquoise'		=> _x('Turquoise', 'tinymce popup select label', 'cocoshortcodes'),
        'button_turquoise_value'=> _x('turquoise', 'shortcode attribute value', 'cocoshortcodes'),
        'button_green'			=> _x('Green', 'tinymce popup select label', 'cocoshortcodes'),
        'button_green_value'	=> _x('green', 'shortcode attribute value', 'cocoshortcodes'),
        'button_yellow'			=> _x('Yellow', 'tinymce popup select label', 'cocoshortcodes'),
        'button_yellow_value'	=> _x('yellow', 'shortcode attribute value', 'cocoshortcodes'),
        'button_orange'			=> _x('Orange', 'tinymce popup select label', 'cocoshortcodes'),
        'button_orange_value'	=> _x('orange', 'shortcode attribute value', 'cocoshortcodes'),
        'button_red'			=> _x('Red', 'tinymce popup select label', 'cocoshortcodes'),
        'button_red_value'		=> _x('red', 'shortcode attribute value', 'cocoshortcodes'),
        'button_pink'			=> _x('Pink', 'tinymce popup select label', 'cocoshortcodes'),
        'button_pink_value'		=> _x('pink', 'shortcode attribute value', 'cocoshortcodes'),
        'button_nightblue'		=> _x('Night Blue', 'tinymce popup select label', 'cocoshortcodes'),
        'button_nightblue_value'=> _x('nightblue', 'shortcode attribute value', 'cocoshortcodes'),
        
        'button_shortcode'		=> _x('cocorico_button', 'shortcode name', 'cocoshortcodes'),
        'button_url_att'		=> _x('url', 'shortcode attribute name', 'cocoshortcodes'),
        'button_target_att'		=> _x('target', 'shortcode attribute name', 'cocoshortcodes'),
        'button_size_att'		=> _x('size', 'shortcode attribute name', 'cocoshortcodes'),
        'button_color_att'		=> _x('color', 'shortcode attribute name', 'cocoshortcodes'),
		
		// Tabs shortcode strings
		
		'tabs'					=> _x('Tabs', 'tinymce button label', 'cocoshortcodes'),
        'tabs_add'				=> _x('Add tabs', 'tinymce popup title', 'cocoshortcodes'),
        
        'tabs_label'			=> _x('Select how many tabs you want to insert', 'tinymce section title', 'cocoshortcodes'),
        'tabs_number'			=> _x('Number', 'tinymce popup attribute label', 'cocoshortcodes'),
        
        'tab_label_value'		=> _x('Tab label', 'shortcode attribute value', 'cocoshortcodes'),
        'tab_content'			=> _x('Tab content', 'shortcode default content', 'cocoshortcodes'),
        'tab_label_att'			=> _x('label', 'shortcode attribute name', 'cocoshortcodes'),
        
        'tabs_shortcode'		=> _x('cocorico_tabs', 'shortcode name', 'cocoshortcodes'),
        'single_tab_shortcode'	=> _x('cocorico_tab', 'shortcode name', 'cocoshortcodes'),
        
        // Separator Shortcode strings
        
        'separator'				=> _x('Separator', 'tinymce button label', 'cocoshortcodes'),
        'separator_add'			=> _x('Add a separator', 'tinymce popup title', 'cocoshortcodes'),
        'separator_style'		=> _x('Choose a style for this separator', 'tinymce popup attribute label', 'cocoshortcodes'),
        
        'separator_solid'		=> _x('Solid', 'tinymce popup select label', 'cocoshortcodes'),
        'separator_solid_value'	=> _x('solid', 'shortcode attribute value', 'cocoshortcodes'),
        'separator_dashed'		=> _x('Dashed', 'tinymce popup select label', 'cocoshortcodes'),
        'separator_dashed_value'=> _x('dashed', 'shortcode attribute value', 'cocoshortcodes'),
        'separator_dotted'		=> _x('Dotted', 'tinymce popup select label', 'cocoshortcodes'),
        'separator_dotted_value'=> _x('dotted', 'shortcode attribute value', 'cocoshortcodes'),
        'separator_double'		=> _x('Double', 'tinymce popup select label', 'cocoshortcodes'),
        'separator_double_value'=> _x('double', 'shortcode attribute value', 'cocoshortcodes'),
        
        'separator_shortcode'	=> _x('cocorico_separator', 'shortcode name', 'cocoshortcodes'),
        'separator_style_att'	=> _x('style', 'shortcode attribute name', 'cocoshortcodes'),
        
        // Toggle Shortcode strings
        
        'toggle'				=> _x('Toggle', 'tinymce button label', 'cocoshortcodes'),
        'toggle_add'			=> _x('Add a toggle', 'tinymce popup title', 'cocoshortcodes'),
        
        'toggle_title'			=> _x('Title', 'tinymce popup attribute label', 'cocoshortcodes'),
        
        'toggle_content'		=> _x('Content', 'tinymce popup input label', 'cocoshortcodes'),
        
        'toggle_shortcode'		=> _x('cocorico_toggle', 'shortcode name', 'cocoshortcodes'),
        'toggle_title_att'		=> _x('title', 'shortcode attribute name', 'cocoshortcodes'),
        
        // Call to action Shortcode strings
        
        'cta'					=> _x('Call to action', 'tinymce button label', 'cocoshortcodes'),
        'cta_add'				=> _x('Add a call to action', 'tinymce popup title', 'cocoshortcodes'),
        
        'cta_title'				=> _x('Title', 'tinymce popup attribute label', 'cocoshortcodes'),
        'cta_url'				=> _x('URL', 'tinymce popup attribute label', 'cocoshortcodes'),
        'cta_label'				=> _x('Button\'s label', 'tinymce popup attribute label', 'cocoshortcodes'),
        'cta_color'				=> _x('Button\'s color', 'tinymce popup attribute label', 'cocoshortcodes'),
        
        'cta_content'			=> _x('Content', 'tinymce popup input label', 'cocoshortcodes'),
        
        'cta_shortcode'			=> _x('cocorico_calltoaction', 'shortcode name', 'cocoshortcodes'),
        'cta_title_att'			=> _x('title', 'shortcode attribute name', 'cocoshortcodes'),
        'cta_url_att'			=> _x('url', 'shortcode attribute name', 'cocoshortcodes'),
        'cta_label_att'			=> _x('label', 'shortcode attribute name', 'cocoshortcodes'),
        'cta_color_att'			=> _x('color', 'shortcode attribute name', 'cocoshortcodes'),
        
		
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.coco_shortcodes_tinymce", ' . json_encode( $strings ) . ");\n";

     return $translated;
}

$strings = coco_shortcodes_tinymce_translation();