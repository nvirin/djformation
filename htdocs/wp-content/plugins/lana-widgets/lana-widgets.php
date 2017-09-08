<?php
/**
 * Plugin Name: Lana Widgets
 * Plugin URI: http://wp.lanaprojekt.hu/blog/wordpress-plugins/lana-widgets/
 * Description: Widgets with Bootstrap 3.
 * Version: 1.0.1
 * Author: Lana Design
 * Author URI: http://wp.lanaprojekt.hu/blog/
 */

defined( 'ABSPATH' ) or die();
define( 'LANA_WIDGETS_VERSION', '1.0.1' );
define( 'LANA_WIDGETS_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * Language
 * load
 */
load_plugin_textdomain( 'lana-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

/**
 * Plugin Settings link
 *
 * @param $links
 *
 * @return mixed
 */
function lana_widgets_plugin_settings_link( $links ) {
	$settings_link = '<a href="options-general.php?page=lana-widgets-settings.php">' . __( 'Settings', 'lana-widgets' ) . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lana_widgets_plugin_settings_link' );

/**
 * Styles
 * load in plugin
 */
function lana_widgets_styles() {

	if ( ! wp_style_is( 'bootstrap' ) && get_option( 'lana_widgets_bootstrap_load', '' ) == 'normal' ) {

		wp_register_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/assets/css/bootstrap.min.css', array(), '3.3.5' );
		wp_enqueue_style( 'bootstrap' );
	}
}

add_action( 'wp_enqueue_scripts', 'lana_widgets_styles', 1000 );

/**
 * JavaScript
 * load in plugin
 */
function lana_widgets_scripts() {

	if ( ! wp_script_is( 'bootstrap' ) && get_option( 'lana_widgets_bootstrap_load', '' ) == 'normal' ) {

		/** bootstrap js */
		wp_register_script( 'bootstrap', plugin_dir_url( __FILE__ ) . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.5' );
		wp_enqueue_script( 'bootstrap' );
	}
}

add_action( 'wp_enqueue_scripts', 'lana_widgets_scripts', 1000 );

/**
 * Add Lana Widgets Settings page
 * in Options page
 */
function lana_widgets_settings_menu() {
	add_options_page( __( 'Lana Widgets Settings', 'lana-widgets' ), __( 'Lana Widgets', 'lana-widgets' ), 'manage_options', 'lana-widgets-settings.php', 'lana_widgets_settings' );

	/** call register settings function */
	add_action( 'admin_init', 'lana_widgets_register_settings' );
}

add_action( 'admin_menu', 'lana_widgets_settings_menu' );

/**
 * Register settings
 */
function lana_widgets_register_settings() {
	register_setting( 'lana-widgets-settings-group', 'lana_widgets_updater' );
	register_setting( 'lana-widgets-settings-group', 'lana_widgets_bootstrap_load' );
}

/**
 * Lana Widgets Settings page
 */
function lana_widgets_settings() {
	?>
	<div class="wrap">
		<h2><?php _e( 'Lana Widgets Settings', 'lana-widgets' ); ?></h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'lana-widgets-settings-group' ); ?>

			<h2 class="title"><?php _e( 'General Settings', 'lana-widgets' ); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="lana_widgets_updater">
							<?php _e( 'Automatic Updater', 'lana-widgets' ); ?>
						</label>
					</th>
					<td>
						<select name="lana_widgets_updater" id="lana_widgets_updater">
							<option value="0"
								<?php selected( get_option( 'lana_widgets_updater', '0' ), '0' ); ?>>
								<?php _e( 'Disabled', 'lana-widgets' ); ?>
							</option>
							<option value="1"
								<?php selected( get_option( 'lana_widgets_updater', '0' ), '1' ); ?>>
								<?php _e( 'Enabled', 'lana-widgets' ); ?>
							</option>
						</select>
					</td>
				</tr>
			</table>

			<h2 class="title"><?php _e( 'Frontend Settings', 'lana-widgets' ); ?></h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="lana_widgets_bootstrap_load">
							<?php _e( 'Bootstrap Load', 'lana-widgets' ); ?>
						</label>
					</th>
					<td>
						<select name="lana_widgets_bootstrap_load" id="lana_widgets_bootstrap_load">
							<option value=""
								<?php selected( get_option( 'lana_widgets_bootstrap_load', '' ), '' ); ?>>
								<?php _e( 'None', 'lana-widgets' ); ?>
							</option>
							<option value="normal"
								<?php selected( get_option( 'lana_widgets_bootstrap_load', '' ), 'normal' ); ?>>
								<?php _e( 'Normal Bootstrap', 'lana-widgets' ); ?>
							</option>
						</select>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'lana-widgets' ) ?>"/>
			</p>

		</form>
	</div>
	<?php
}

/**
 * Lana Widgets - get shortcode atts
 *
 * @param $shortcode
 * @param $text
 *
 * @return array
 */
function lana_widgets_shortcode_get_atts( $shortcode, $text ) {

	$out = array();

	if ( preg_match( '/' . get_shortcode_regex() . '/s', $text, $matches ) == true ) {
		if ( array_key_exists( 2, $matches ) && $shortcode === $matches[2] ) {
			$out = (array) shortcode_parse_atts( $matches[3] );
		}
	}

	return $out;
}

/**
 * Lana Widgets - Ajax
 * return gallery html from shortcode
 */
function lana_widgets_gallery_html_from_shortcode() {

	remove_filter( 'post_gallery', 'lana_gallery_shortcode', 10 );

	$gallery_shortcode      = stripslashes( $_POST['gallery_shortcode'] );
	$gallery_shortcode_atts = lana_widgets_shortcode_get_atts( 'gallery', $gallery_shortcode );

	echo gallery_shortcode( array(
		'ids'     => explode( ',', $gallery_shortcode_atts['ids'] ),
		'columns' => 4,
		'link'    => 'none'
	) );

	add_filter( 'post_gallery', 'lana_gallery_shortcode', 10, 3 );

	die();
}

add_action( 'wp_ajax_lana_widgets_gallery_html_from_shortcode', 'lana_widgets_gallery_html_from_shortcode' );

/**
 * Lana Widgets
 * Autoloader
 *
 * @param $class_name
 */
function lana_widgets_autoloader( $class_name ) {

	if ( ! preg_match( "/Lana_(.*)_Widget/", $class_name, $lana_widget_matches ) ) {
		return;
	}

	$file_name = str_replace( array( '_' ), array( '-' ), strtolower( $class_name ) );
	$file      = plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'class-' . $file_name . '.php';

	if ( file_exists( $file ) ) {
		include_once $file;
	}
}

spl_autoload_register( 'lana_widgets_autoloader' );

/**
 * Init Widgets
 */
add_action( 'widgets_init', function () {
	register_widget( 'Lana_Alert_Widget' );
	register_widget( 'Lana_Carousel_Widget' );
	register_widget( 'Lana_Image_Widget' );
	register_widget( 'Lana_Jumbotron_Widget' );
	register_widget( 'Lana_Page_Content_Widget' );
	register_widget( 'Lana_Text_Widget' );
	register_widget( 'Lana_Thumbnail_Widget' );
	register_widget( 'Lana_Title_Widget' );
	register_widget( 'Lana_Well_Widget' );
} );

