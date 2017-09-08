<?php

/**
 * Class Lana_Well_Widget
 */
class Lana_Well_Widget extends WP_Widget{

	/**
	 * Lana Well Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Well', 'lana-widgets' );
		$widget_description = __( 'Inset effect.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );

		parent::__construct( 'lana_well', $widget_title, $widget_options );
	}

	/**
	 * Output Widget HTML
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$before_widget = '<div class="well %s">';
		$after_widget  = '</div>';

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];
		echo sprintf( $before_widget, esc_attr( $instance['size'] ) );

		echo $instance['text'];

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
			'text' => '',
			'size' => ''
		) );

		$instance['text'] = esc_textarea( $instance['text'] );
		$instance['size'] = strip_tags( $instance['size'] );
		?>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>">
			<?php _e( 'Text:', 'lana-widgets' ); ?>
		</label>
		<textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>

		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>">
				<?php _e( 'Size:', 'lana-widgets' ); ?>
			</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>"
			        name="<?php echo $this->get_field_name( 'size' ); ?>">
				<option value="" <?php selected( $instance['size'], '' ); ?>>
					<?php _e( 'Default', 'lana-widgets' ); ?>
				</option>
				<option value="well-lg" <?php selected( $instance['size'], 'well-lg' ); ?>>
					<?php _e( 'Large', 'lana-widgets' ); ?>
				</option>
				<option value="well-sm" <?php selected( $instance['size'], 'well-sm' ); ?>>
					<?php _e( 'Small', 'lana-widgets' ); ?>
				</option>
			</select>
		</p>
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

		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['size'] = strip_tags( $new_instance['size'] );

		return apply_filters( 'lana_well_widget_update', $instance, $this );
	}
} 