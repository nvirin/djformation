<?php

/**
 * Plugin Name: If Tag Then Post WordPress
 * Plugin URI: http://www.jackreichert.com/
 * Description: Lets you create conditional actions, extends the functionality of the WordPress mobile app.
 * Version: 0.1
 * Author: jackreichert
 * Author URI: http://www.jackreichert.com/
 * License: GPL3
 */

class IFTTP {
	public $options;

	function __construct() {
		$this->load_dependencies();
		$this->options = get_option( 'ifttp' );
		$this->plugin_options( $this->options );
		$this->load_actions();
	}

	/*
	 * WordPress actions and filters
	 */
	private function load_actions() {
		add_action( 'save_post', array( $this, 'actions' ) );
	}

	/*
	 * Include dependent files
	 */
	private function load_dependencies() {
		require_once( plugin_dir_path( __FILE__ ) . '/inc/plugin-settings.php' );
	}

	/*
	 * Create plugin options page
	 */
	private function plugin_options( $options ) {
		if ( is_admin() ) {
			$this->IFTTP_Settings = new IFTTP_Settings( $options );
		}
	}

	/*
	 * Load created conditional actions
	 * Only loads if post_type == post to prevent unwanted infinite loops
	 */
	public function actions( $post_id ) {
		if ( 'post' === get_post_type( $post_id ) ) {
			foreach ( $this->options['ifttp_tag_post'] as $i => $option ) {
				$terms = wp_get_post_terms( $post_id, 'post_tag' );
				foreach ( $terms as $i => $term ) {
					if ( strtolower( $term->name ) === strtolower( $option['if_tag'] ) ) {
						$new_post = array(
							'ID'        => $post_id,
							'post_type' => $option['else_post']
						);
						wp_update_post( $new_post );
					}
				}
			}
		}
	}

}

$IFTTP = new IFTTP();