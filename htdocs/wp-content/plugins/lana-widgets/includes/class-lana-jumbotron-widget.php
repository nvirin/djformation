<?php

/**
 * Class Lana_Jumbotron_Widget
 * with Bootstrap
 */
class Lana_Jumbotron_Widget extends WP_Widget{

	/**
	 * Lana Jumbotron Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Jumbotron', 'lana-widgets' );
		$widget_description = __( 'Showcase your key content.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );

		parent::__construct( 'lana_jumbotron', $widget_title, $widget_options );
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
		$before_widget = '<div class="jumbotron">';
		$after_widget  = '</div>';

		$before_title = '<h1>';
		$after_title  = '</h1>';

		$before_text = '<p>';
		$after_text  = '</p>';

		$before_button_container = '<p>';
		$after_button_container  = '</p>';

		$before_button = '<a href="%s" class="btn btn-primary btn-lg" role="button">';
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

		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		echo $before_text . $instance['text'] . $after_text;

		if ( ! empty( $instance['button_text'] ) ) {

			echo $before_button_container;
			echo sprintf( $before_button, esc_attr( $instance['button_link'] ) );

			echo $instance['button_text'];

			echo $after_button;
			echo $after_button_container;
		}

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
			'title'       => '',
			'text'        => '',
			'button_text' => '',
			'button_link' => ''
		) );

		$instance['title']       = strip_tags( $instance['title'] );
		$instance['text']        = esc_textarea( $instance['text'] );
		$instance['button_text'] = strip_tags( $instance['button_text'] );
		$instance['button_link'] = strip_tags( $instance['button_link'] );
		?>
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

		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['text']        = strip_tags( $new_instance['text'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );

		return apply_filters( 'lana_jumbotron_widget_update', $instance, $this );
	}
}
