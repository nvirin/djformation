<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// Thanks to my friend Rémi Corson for those snippets :
// http://www.remicorson.com/how-to-create-translation-ready-shortcodes/

function coco_shortcodes_register(){
   add_shortcode(_x('cocorico_column', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_column');
   add_shortcode(_x('cocorico_message', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_message');
   add_shortcode(_x('cocorico_button', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_button');
   add_shortcode(_x('cocorico_tabs', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_tabs');
   add_shortcode(_x('cocorico_tab', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_tab');
   add_shortcode(_x('cocorico_separator', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_separator');
   add_shortcode(_x('cocorico_toggle', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_toggle');
   add_shortcode(_x('cocorico_calltoaction', 'shortcode name', 'cocoshortcodes'), 'coco_shortcodes_calltoaction');
}
add_action( 'init', 'coco_shortcodes_register');


// Column Shortcode generator
if(!function_exists('coco_shortcodes_column')){
	function coco_shortcodes_column($atts, $content = null) {
		
		extract(shortcode_atts(array(
			_x('size', 'shortcode attribute name', 'cocoshortcodes') => '',
			_x('position', 'shortcode attribute name', 'cocoshortcodes') => ''
		), $atts));
		
		$size = ${_x('size', 'shortcode attribute name', 'cocoshortcodes')};
		$position = ${_x('position', 'shortcode attribute name', 'cocoshortcodes')};
		
		$classes = 'cs_column ';
		
		switch($size){
			case _x('one_half', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_one_half';
			break;
			case _x('one_third', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_one_third';
			break;
			case _x('two_thirds', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_two_thirds';
			break;
			case _x('one_fourth', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_one_fourth';
			break;
			case _x('three_fourths', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_three_fourths';
			break;
			default :
			 	$classes .= '';
		}
		
		switch($position){
			case _x('first', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_column_first';
			break;
			case _x('middle', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_column_middle';
			break;
			case _x('last', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_column_last';
			break;
			default:
				$classes .= '';
		}
		
		$res = '<div class="'.$classes.'">';
		$res .= do_shortcode(wpautop($content));
		$res .= '</div>';
		
		$res .= ($position == _x('last', 'shortcode attribute name', 'cocoshortcodes') ? '<div class="cs_clear"></div>' : '');
		
		return $res;
	}
}

// Message Shortcode generator
if (!function_exists('coco_shortcodes_message')){
	function coco_shortcodes_message($atts, $content = null){
		
		extract(shortcode_atts(array(
			_x('type', 'shortcode attribute name', 'cocoshortcodes') => '',
		), $atts));
		
		$type = ${_x('type', 'shortcode attribute name', 'cocoshortcodes')};
		
		$classes = 'cs_message ';
		
		switch($type){
			case _x('classic', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_message_classic';
			break;
			case _x('info', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_message_info';
			break;
			case _x('alert', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_message_alert';
			break;
			case _x('error', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_message_error';
			break;
			case _x('success', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= 'cs_message_success';
			break;
			default :
			 	$classes .= '';
		}
		
		$res = '<div class="'.$classes.'">';
		$res .= do_shortcode(wpautop($content));
		$res .= '</div>';
		return $res;
	}
}

// Button Shortcode generator
if (!function_exists('coco_shortcodes_button')){
	function coco_shortcodes_button($atts, $content = null){
		
		extract(shortcode_atts(array(
			_x('url', 'shortcode attribute name', 'cocoshortcodes') => 'https://www.themesdefrance.fr',
			_x('target', 'shortcode attribute name', 'cocoshortcodes') => '',
			_x('size', 'shortcode attribute name', 'cocoshortcodes') => _x('medium', 'shortcode attribute value', 'cocoshortcodes'),
			_x('color', 'shortcode attribute name', 'cocoshortcodes') => ''
		), $atts));
		
		$url 	= ${_x('url', 'shortcode attribute name', 'cocoshortcodes')};
		$target = ${_x('target', 'shortcode attribute name', 'cocoshortcodes')};
		$size 	= ${_x('size', 'shortcode attribute name', 'cocoshortcodes')};
		$color 	= ${_x('color', 'shortcode attribute name', 'cocoshortcodes')};
		
		$target = ($target == _x('new_window', 'shortcode attribute value', 'cocoshortcodes') ? ' target="_blank" ' : '');
		
		$classes = 'cs_button';
		
		switch($size){
			case _x('small', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_small';
			break;
			case _x('medium', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_medium';
			break;
			case _x('large', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_large';
			break;
			default :
			 	$classes .= ' cs_button_medium';
		}
		
		switch($color){
			case _x('purple', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_purple';
			break;
			case _x('blue', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_blue';
			break;
			case _x('turquoise', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_turquoise';
			break;
			case _x('green', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_green';
			break;
			case _x('yellow', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_yellow';
			break;
			case _x('orange', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_orange';
			break;
			case _x('red', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_red';
			break;
			case _x('pink', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_pink';
			break;
			case _x('grey', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_grey';
			break;
			case _x('nightblue', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_nightblue';
			break;
			default :
			 	$classes .= ' cs_button_grey';
		}
		
		$res = '<a href="' . $url . '" class="' . $classes . '"' . $target . '>';
		$res .= $content;
		$res .= '</a>';
		
		return $res;
	}
}

// Tabs Shortcode generator
if (!function_exists('coco_shortcodes_tabs')){
	function coco_shortcodes_tabs($atts, $content = null){
		
		// Load jquery tabs
		wp_enqueue_script('jquery-ui-tabs');
		
		// Thanks to https://stackoverflow.com/questions/23307032/create-wordpress-shortcode-for-jquery-ui-tabs
		
		preg_match_all( '/' . _x('cocorico_tab', 'shortcode name', 'cocoshortcodes') . ' ' . _x('label', 'shortcode attribute name', 'cocoshortcodes') . '="([^\"]+)"/i', $content, $matche, PREG_OFFSET_CAPTURE );

	    $tab_title = array();
	
	    if( isset($matche[1]) ) {
	        $tab_title = $matche[1];
	    }
	
	    $res = '';
	
	    if( count($tab_title) ) {
	        $res .= '<div class="cs_tabs">';
	        $res .= '<ul class="nav cs_clear">';
	        foreach( $tab_title as $tab ){
	            $res .= '<li><a href="#cs_tabs_'. str_replace('-', '_', sanitize_title( $tab[0] )) .'">' . $tab[0] . '</a></li>';
	        }
	        $res .= '</ul>' . do_shortcode($content) . '</div>';
	    } else {
	        $res .= do_shortcode($content);
	    }
	
	    return $res;
	}
}

// Single Tab Shortcode 
if (!function_exists('coco_shortcodes_tab')){
	function coco_shortcodes_tab($atts, $content = null){
	
		extract(shortcode_atts(array(
			_x('label', 'shortcode attribute name', 'cocoshortcodes') => _x('Tab label', 'shortcode attribute value', 'cocoshortcodes'),
		), $atts));
		
		$label = ${_x('label', 'shortcode attribute name', 'cocoshortcodes')};
		
		$res = '<div class="cs_tab_content" id="cs_tabs_'. str_replace('-', '_', sanitize_title( $label )) .'">'. do_shortcode(wpautop($content)) .'</div>';
		
		return $res;
	}
}

// Separator Shortcode (hr)
if (!function_exists('coco_shortcodes_separator')){
	function coco_shortcodes_separator($atts) {
		
		extract(shortcode_atts(array(
			_x('style', 'shortcode attribute name', 'cocoshortcodes') => _x('solid', 'shortcode attribute value', 'cocoshortcodes'),
		), $atts));
		
		$style = ${_x('style', 'shortcode attribute name', 'cocoshortcodes')};
		
		$class = '';
		
		switch($style){
			case _x('solid', 'shortcode attribute value', 'cocoshortcodes') :
				$class .= 'cs_separator_solid';
			break;
			case _x('dashed', 'shortcode attribute value', 'cocoshortcodes') :
				$class .= 'cs_separator_dashed';
			break;
			case _x('dotted', 'shortcode attribute value', 'cocoshortcodes') :
				$class .= 'cs_separator_dotted';
			break;
			case _x('double', 'shortcode attribute value', 'cocoshortcodes') :
				$class .= 'cs_separator_double';
			break;
			default :
			 	$class .= 'cs_separator_solid';
		}

		$res = '<div class="cs_separator cs_clear"><hr class="'.$class.'"></div>';
		
	   return $res;
	}
}

// Toggle Shortcode Generator
if (!function_exists('coco_shortcodes_toggle')){
	function coco_shortcodes_toggle($atts, $content = null) {
		
		extract(shortcode_atts(array(
			_x('title', 'shortcode attribute name', 'cocoshortcodes') => _x('Toggle title', 'shortcode attribute value', 'cocoshortcodes'),
		), $atts));
		
		$title = ${_x('title', 'shortcode attribute name', 'cocoshortcodes')};
		
		$res = '<div class="cs_toggle">';
		$res .= '<p class="cs_toggle_button"><a href="#">'.$title.'</a></p>';
		$res .= '<div class="cs_toggle_content">' . do_shortcode(wpautop($content)) . '</div>';
		$res .= '</div>';
		
	   return $res;
	}
}

// Call to action Shortcode Generator
if (!function_exists('coco_shortcodes_calltoaction')){
	function coco_shortcodes_calltoaction($atts, $content = null) {
		
		extract(shortcode_atts(array(
			_x('title', 'shortcode attribute name', 'cocoshortcodes') => '',
			_x('url', 'shortcode attribute name', 'cocoshortcodes') => '',
			_x('label', 'shortcode attribute name', 'cocoshortcodes') => '',
			_x('color', 'shortcode attribute name', 'cocoshortcodes') => '',
		), $atts));
		
		$title = ${_x('title', 'shortcode attribute name', 'cocoshortcodes')};
		$url = ${_x('url', 'shortcode attribute name', 'cocoshortcodes')};
		$label = ${_x('label', 'shortcode attribute name', 'cocoshortcodes')};
		$color = ${_x('color', 'shortcode attribute name', 'cocoshortcodes')};
		
		$classes = 'cs_button cs_button_calltoaction';
		
		switch($color){
			case _x('purple', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_purple';
			break;
			case _x('blue', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_blue';
			break;
			case _x('turquoise', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_turquoise';
			break;
			case _x('green', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_green';
			break;
			case _x('yellow', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_yellow';
			break;
			case _x('orange', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_orange';
			break;
			case _x('red', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_red';
			break;
			case _x('pink', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_pink';
			break;
			case _x('grey', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_grey';
			break;
			case _x('nightblue', 'shortcode attribute value', 'cocoshortcodes') :
				$classes .= ' cs_button_nightblue';
			break;
			default :
			 	$classes .= ' cs_button_grey';
		}
		
		$res = '<div class="cs_calltoaction">';
		$res .= '<h3 class="cs_calltoaction_title">' . $title . '</h3>';
		$res .= '<p class="cs_calltoaction_content">' . do_shortcode($content) . '</p>';
		$res .= '<a href="' . $url . '" class="' . $classes . '">' . $label . '</a>';
		$res .= '</div>';
		
	   return $res;
	}
}