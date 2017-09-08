<?php

class IFTTP_Settings {
	public $options = array();

	public function __construct( $options = array() ) {
		$this->load_actions();
		$this->init_options( $options );
	}

	/*
	 * Load WordPress actions/fiilters
	 */
	private function load_actions() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'settings_scripts' ) );
	}

	/*
	 * Initial plugin options page
	 */
	function init_options( $options ) {
		$this->options = ( 0 < count( $options ) ) ? $options : get_option( 'ifttp' );
	}

	function settings_scripts() {
		wp_enqueue_script( 'ifttp_admin_script', plugin_dir_url( __FILE__ ) . '../js/admin-scripts.js' );
		wp_enqueue_style( 'ifttp_admin_style', plugin_dir_url( __FILE__ ) . '../css/admin-styles.css' );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// This page will be under "Settings"
		add_options_page(
			'IFTTP Settings Admin',       // Page title
			'IFTTP Settings',          // Menu title
			'manage_options',       // Capability
			'ifttp', // Menu slug
			array( $this, 'create_admin_page' ) // Function
		);
	}

	/*
	 * Register settings, fields
	 */
	public function page_init() {
		register_setting(
			'ifttp_option_group', // Option group
			'ifttp', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'ifttp_settings', // ID
			'IFTTP Settings', // Title
			array( $this, 'ifttp_section_info' ), // Callback
			'ifttp' // Page
		);

		add_settings_field(
			'ifttp_tag_post', // ID
			'IFTTP IF Tag / Else Post', // Title
			array( $this, 'ifttp_tag_post_callback' ), // Callback
			'ifttp', // Page
			'ifttp_settings' // Section
		);

	}

	/*
	 * admin page html
	 */
	function create_admin_page() {
		?>
		<div class="wrap">
			<h2>If Tag Then Post WordPress</h2>

			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( 'ifttp_option_group' );
				do_settings_sections( 'ifttp' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/*
	 * sanitize / validate
	 */
	function sanitize( $input ) {
		$new_input = array();
		if ( isset( $input['ifttp_tag_post'] ) ) {
			if ( is_array( $input['ifttp_tag_post'] ) ) {
				foreach ( $input['ifttp_tag_post'] as $i => $ifttp_if_tag ) {
					$new_input['ifttp_tag_post'][ $i ]['if_tag']    = sanitize_text_field( $input['ifttp_tag_post'][ $i ]['if_tag'] );
					$new_input['ifttp_tag_post'][ $i ]['else_post'] = sanitize_text_field( $input['ifttp_tag_post'][ $i ]['else_post'] );
				}
			}
		}

		return $new_input;
	}

	/*
	 * Callbacks
	 */
	function ifttp_section_info() {
		echo 'Set tags and what you want to happen to posts with that tag.';
	}

	function ifttp_tag_post_callback() {
		$option = ( is_array( $this->options['ifttp_tag_post'] ) ? $this->options['ifttp_tag_post'] : array( $this->options['ifttp_tag_post'] ) );
		foreach ( $option as $i => $ifttp_tag_post ) {
			echo '<div class="ifttp">';
			printf(
				'<input type="text" id="ifttp_if_tag" name="ifttp[ifttp_tag_post][%d][if_tag]" value="%s" />', $i,
				isset( $this->options['ifttp_tag_post'][ $i ]['if_tag'] ) ? esc_attr( $this->options['ifttp_tag_post'][ $i ]['if_tag'] ) : ''
			);

			$post_types = get_post_types();
			printf( '<select id="ifttp_else_post" name="ifttp[ifttp_tag_post][%d][else_post]">', $i );
			foreach ( $post_types as $post_type ) {
				echo '<option ' . selected( $post_type, $this->options['ifttp_tag_post'][ $i ]['else_post'] ) . '>' . $post_type . '</option>';
			}
			echo '</select>';
			echo ' <i class="dashicons dashicons-plus"></i>';
			echo ' <i class="dashicons dashicons-no"></i>';
			echo '</div>';
		}
	}

}