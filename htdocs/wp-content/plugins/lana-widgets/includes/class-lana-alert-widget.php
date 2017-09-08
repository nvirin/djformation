<?php

/**
 * Class Lana_Alert_Widget
 */
class Lana_Alert_Widget extends WP_Widget{

	/**
	 * Lana Alert Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Alert', 'lana-widgets' );
		$widget_description = __( 'One-line alert message.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );

		parent::__construct( 'lana_alert', $widget_title, $widget_options );
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
		$before_widget = '<div class="alert %s alert-dismissible" role="alert">';
		$after_widget  = '</div>';

		$dismissible = '<button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>';

		$before_title = '<strong>';
		$after_title  = '</strong>';

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];
		echo sprintf( $before_widget, esc_attr( $instance['type'] ) );

		echo $dismissible;

		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . $instance['title'] . $after_title;
		}

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
			'title' => '',
			'text'  => '',
			'type'  => ''
		) );

		$instance['title'] = strip_tags( $instance['title'] );
		$instance['text']  = esc_textarea( $instance['text'] );
		$instance['type']  = strip_tags( $instance['type'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:', 'lana-widgets' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>"
			       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>">
				<?php _e( 'Text:', 'lana-widgets' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>"
			       name="<?php echo $this->get_field_name( 'text' ); ?>"
			       value="<?php echo esc_attr( $instance['text'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">
				<?php _e( 'Type:', 'lana-widgets' ); ?>
			</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>"
			        name="<?php echo $this->get_field_name( 'type' ); ?>">
				<option value="alert-success" <?php selected( $instance['type'], 'alert-success' ); ?>>
					Success
				</option>
				<option value="alert-info" <?php selected( $instance['type'], 'alert-info' ); ?>>
					Info
				</option>
				<option value="alert-warning" <?php selected( $instance['type'], 'alert-warning' ); ?>>
					Warning
				</option>
				<option value="alert-danger" <?php selected( $instance['type'], 'alert-danger' ); ?>>
					Danger
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

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text']  = strip_tags( $new_instance['text'] );
		$instance['type']  = strip_tags( $new_instance['type'] );

		return apply_filters( 'lana_alert_widget_update', $instance, $this );
	}
} 