<?php

/**
 * Class Lana_Image_Widget
 */
class Lana_Image_Widget extends WP_Widget{

	/**
	 * Lana Image Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Image', 'lana-widgets' );
		$widget_description = __( 'Image with Magnific popup.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );

		parent::__construct( 'lana_image', $widget_title, $widget_options );

		add_action( 'wp_enqueue_scripts', array( $this, 'widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'widget_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'widget_admin_scripts' ) );
	}

	/**
	 * Load widget styles
	 */
	public function widget_styles() {

		/** magnific css */
		wp_register_style( 'magnific-popup', LANA_WIDGETS_DIR_URL . '/assets/css/jquery.magnific-popup.min.css', array(), '1.1.0' );
		wp_enqueue_style( 'magnific-popup' );
	}

	/**
	 * Load widget scripts
	 */
	public function widget_scripts() {

		/** magnific js */
		wp_register_script( 'magnific-popup', LANA_WIDGETS_DIR_URL . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0' );
		wp_enqueue_script( 'magnific-popup' );
	}

	/**
	 * Load widget admin scripts
	 */
	public function widget_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script( 'lana-image-widget', LANA_WIDGETS_DIR_URL . '/assets/js/lana-image-widget.js', array(
			'jquery',
			'media-upload',
			'media-views'
		), LANA_WIDGETS_VERSION );
	}

	/**
	 * Output Widget HTML
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		/**
		 * Title
		 * apply filter
		 */
		$instance['title'] = apply_filters( 'widget_title', $instance['title'] );

		/**
		 * Widget
		 * elements
		 */
		$before_image = '<a href="%s" class="thumbnail magnific">';
		$after_image  = '</a>';

		$image = '<img src="%s" />';

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		if ( ! empty( $instance['image_url'] ) ) {
			echo sprintf( $before_image, esc_attr( $instance['image_url'] ) );
			echo sprintf( $image, esc_attr( $instance['image_url'] ) );
			echo $after_image;
		}

		echo $args['after_widget'];
	}

	/**
	 * Output Widget Form
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
			'title'     => '',
			'image_url' => ''
		) );

		$instance['title']     = strip_tags( $instance['title'] );
		$instance['image_url'] = strip_tags( $instance['image_url'] );
		?>
		<div class="lana-widgets-image-widget">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">
					<?php _e( 'Title:', 'lana-widgets' ); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>"
				       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'image_url' ); ?>">
					<?php _e( 'Image:', 'lana-widgets' ); ?>
				</label>
				<br/>
				<img class="lana-widgets-image" src="<?php echo $instance['image_url']; ?>" style="max-height:120px;"/>
				<input type="text" class="widefat lana-widgets-image-url"
				       name="<?php echo $this->get_field_name( 'image_url' ); ?>"
				       id="<?php echo $this->get_field_id( 'image_url' ); ?>"
				       value="<?php echo esc_url( $instance['image_url'] ); ?>">
			</p>

			<p>
				<input type="button" value="<?php _e( 'Edit Image', 'lana-widgets' ); ?>"
				       class="button lana-widgets-media-image" data-widget="lana-image"/>
			</p>
		</div>
		<?php
	}

	/**
	 * Update Widget Data
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array|mixed|void
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['image_url'] = strip_tags( $new_instance['image_url'] );

		return apply_filters( 'lana_image_widget_update', $instance, $this );
	}
} 