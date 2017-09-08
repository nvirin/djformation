<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
   $settings = array('media_buttons'=> false,'lpp_new_empty_template','textarea_rows'=>35);
   wp_editor($lpp_new_empty_template,'lpp_new_empty_template',$settings);

   ?>