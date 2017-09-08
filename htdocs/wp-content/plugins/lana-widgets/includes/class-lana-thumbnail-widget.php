<?php

/**
 * Class Lana_Thumbnail_Widget
 */
class Lana_Thumbnail_Widget extends WP_Widget{

	/**
	 * Lana Thumbnail Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Thumbnail', 'lana-widgets' );
		$widget_description = __( 'Image and text.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );

		parent::__construct( 'lana_thumbnail', $widget_title, $widget_options );

		add_action( 'admin_enqueue_scripts', array( $this, 'widget_admin_scripts' ) );
	}

	/**
	 * Load widget script
	 */
	public function widget_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script( 'lana-thumbnail-widget', LANA_WIDGETS_DIR_URL . '/assets/js/lana-thumbnail-widget.js', array(
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
		$before_widget = '<div class="thumbnail">';
		$after_widget  = '</div>';

		$before_caption = '<div class="caption">';
		$after_caption  = '</div>';

		$before_text = '<p>';
		$after_text  = '</p>';

		$image = '<img src="%s" />';

		$before_button_container = '<p>';
		$after_button_container  = '</p>';

		$before_button = '<a href="%s" class="btn btn-primary %s" role="button">';
		$after_button  = '</a>';

		/**
		 * button link
		 * default # value
		 */
		if ( empty( $instance['button_link'] ) ) {
			$instance['button_link'] = '#';
		}

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];
		echo $before_widget;

		if ( ! empty( $instance['image_url'] ) ) {
			echo sprintf( $image, esc_attr( $instance['image_url'] ) );
		}

		echo $before_caption;

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo $before_text . $instance['text'] . $after_text;

		if ( ! empty( $instance['button_text'] ) ) {
			echo $before_button_container;
			echo sprintf( $before_button, esc_attr( $instance['button_link'] ), esc_attr( $instance['button_type'] ) );
			echo $instance['button_text'];
			echo $after_button;
			echo $after_button_container;
		}

		echo $after_caption;

		echo $after_widget;
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
			'image_url'   => '',
			'title'       => '',
			'text'        => '',
			'button_text' => '',
			'button_link' => '',
			'button_type' => ''
		) );

		$instance['image_url']   = strip_tags( $instance['image_url'] );
		$instance['title']       = strip_tags( $instance['title'] );
		$instance['text']        = esc_textarea( $instance['text'] );
		$instance['button_text'] = strip_tags( $instance['button_text'] );
		$instance['button_link'] = strip_tags( $instance['button_link'] );
		$instance['button_type'] = strip_tags( $instance['button_type'] );
		?>
		<div class="lana-widgets-thumbnail-widget">
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
				       class="button lana-widgets-media-image" data-widget="lana-thumbnail"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">
					<?php _e( 'Title:', 'lana-widgets' ); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>"
				       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>

			<label for="<?php echo $this->get_field_id( 'text' ); ?>">
				<?php _e( 'Text:', 'lana-widgets' ); ?>
			</label>
			<textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'text' ); ?>"
			          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>

			<p>
				<label for="<?php echo $this->get_field_id( 'button_text' ); ?>">
					<?php _e( 'Button Text:', 'lana-widgets' ); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>"
				       name="<?php echo $this->get_field_name( 'button_text' ); ?>"
				       value="<?php echo esc_attr( $instance['button_text'] ); ?>"/>
				<br/>
				<label for="<?php echo $this->get_field_id( 'button_link' ); ?>">
					<?php _e( 'Button Link:', 'lana-widgets' ); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_link' ); ?>"
				       name="<?php echo $this->get_field_name( 'button_link' ); ?>"
				       value="<?php echo esc_attr( $instance['button_link'] ); ?>"
				       placeholder="<?php echo esc_attr( home_url( '/' ) ); ?>"/>
				<br/>
				<label for="<?php echo $this->get_field_id( 'button_type' ); ?>">
					<?php _e( 'Button Type:', 'lana-widgets' ); ?>
				</label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'button_type' ); ?>"
				        name="<?php echo $this->get_field_name( 'button_type' ); ?>">
					<option value="" <?php selected( $instance['button_type'], '' ); ?>>
						Default
					</option>
					<option value="btn-block" <?php selected( $instance['button_type'], 'btn-block' ); ?>>
						Block
					</option>
				</select>
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

		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['text']        = strip_tags( $new_instance['text'] );
		$instance['image_url']   = strip_tags( $new_instance['image_url'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		$instance['button_type'] = strip_tags( $new_instance['button_type'] );

		return apply_filters( 'lana_thumbnail_widget_update', $instance, $this );
	}
} 