<?php

/**
 * Class Lana_Text_Widget
 * with TinyMCE editor
 * with Bootstrap
 */
class Lana_Text_Widget extends WP_Widget{

	/**
	 * Lana Text Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Text', 'lana-widgets' );
		$widget_description = __( 'TinyMCE visual editor.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );
		$control_options    = array( 'width' => 600, 'height' => 400 );

		parent::__construct( 'lana_text', $widget_title, $widget_options, $control_options );

		add_action( 'admin_enqueue_scripts', array( $this, 'widget_admin_scripts' ) );
	}

	/**
	 * Load widget script
	 */
	public function widget_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script( 'lana-text-widget', LANA_WIDGETS_DIR_URL . '/assets/js/lana-text-widget.js', array(
			'jquery',
			'editor',
			'quicktags'
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
		$before_text_container = '<div class="panel">';
		$after_text_container  = '</div>';

		$before_text = '<div class="panel-body">';
		$after_text  = '</div>';

		$instance['text'] = wpautop( $instance['text'] );

		/**
		 * Output
		 * Widget
		 */
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo $before_text_container;
		echo $before_text;
		echo $instance['text'];
		echo $after_text;
		echo $after_text_container;

		echo $args['after_widget'];
	}

	/**
	 * Output Widget Form
	 * with TinyMCE
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		global $lana_editor;

		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'text'  => ''
		) );

		$instance['title'] = strip_tags( $instance['title'] );
		$instance['text']  = wpautop( $instance['text'] );
		$instance['text']  = str_replace( "\n", "", $instance['text'] );

		/**
		 * TinyMCE
		 * settings
		 */
		$wp_editor_settings = array(
			'textarea_name' => $this->get_field_name( 'text' ),
			'textarea_rows' => 10,
			'dwf'           => true,
			'tinymce'       => array(
				'add_unload_trigger' => false,
				'wp_autoresize_on'   => false
			)
		);
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
		<?php if ( defined( 'LANA_EDITOR_VERSION' ) && $lana_editor == true ) : ?>
			<?php wp_editor( $instance['text'], $this->get_field_id( 'text' ), $wp_editor_settings ); ?>

			<script>
				jQuery(function () {
					jQuery('.widget-dialog-lana_text_widget').find('.wp-editor-area').each(function () {
						lana_tinymce_init(this);
					});
					jQuery('.widget').find('.wp-editor-area').each(function () {
						lana_tinymce_init(this);
					});
				});
			</script>
		<?php else : ?>
			<textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'text' ); ?>"
			          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
		<?php endif; ?>
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
		$instance['text']  = $new_instance['text'];

		return apply_filters( 'lana_text_widget_update', $instance, $this );
	}
}