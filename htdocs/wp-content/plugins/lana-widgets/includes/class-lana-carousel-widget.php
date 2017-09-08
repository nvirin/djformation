<?php

/**
 * Class Lana_Carousel_Widget
 */
class Lana_Carousel_Widget extends WP_Widget{

	/**
	 * Lana Carousel Widget
	 * constructor
	 */
	public function __construct() {

		$widget_title       = __( 'Lana - Carousel', 'lana-widgets' );
		$widget_description = __( 'Image slider.', 'lana-widgets' );
		$widget_options     = array( 'description' => $widget_description );
		$control_options    = array( 'width' => 750, 'height' => 500 );

		parent::__construct( 'lana_carousel', $widget_title, $widget_options, $control_options );

		add_action( 'wp_enqueue_scripts', array( $this, 'widget_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'widget_admin_scripts' ) );
	}

	/**
	 * Load widget styles
	 */
	public function widget_styles() {

		/** lana carousel css */
		wp_register_style( 'lana-carousel', LANA_WIDGETS_DIR_URL . '/assets/css/lana-carousel.css', array(), LANA_WIDGETS_VERSION );
		wp_enqueue_style( 'lana-carousel' );
	}

	/**
	 * Load widget script
	 */
	public function widget_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script( 'lana-carousel-widget', LANA_WIDGETS_DIR_URL . '/assets/js/lana-carousel-widget.js', array(
			'jquery',
			'media-upload',
			'media-views'
		) );
	}

	/**
	 * Get Gallery images
	 * from shortcode
	 *
	 * @param $shortcode
	 *
	 * @return array
	 */
	public function get_gallery_images_from_shortcode( $shortcode ) {

		$shortcode_atts = lana_widgets_shortcode_get_atts( 'gallery', $shortcode );

		$attachments = get_posts( array(
			'include'        => explode( ',', $shortcode_atts['ids'] ),
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image'
		) );

		$images = array();
		foreach ( $attachments as $id => $attachment ) {
			$images[ $attachment->ID ] = $attachments[ $id ];
		}

		return $images;
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
		$before_title = '<h3>';
		$after_title  = '</h3>';

		$before_carousel = '<div id="%s" class="carousel %s slide" data-ride="carousel">';
		$after_carousel  = '</div>';

		$before_indicators = '<ol class="carousel-indicators">';
		$after_indicators  = '</ol>';

		$before_inner = '<div class="carousel-inner" role="listbox">';
		$after_inner  = '</div>';

		$before_image = '<div class="item %s">';
		$after_image  = '</div>';

		$before_carousel_image = '';
		$after_carousel_image  = '';

		$carousel_image = '<div style="%s" class="carousel-image"></div>';

		$before_caption = '<div class="carousel-caption">';
		$after_caption  = '</div>';

		$before_caption_title = '<h3>';
		$after_caption_title  = '</h3>';

		$before_caption_description = '<p>';
		$after_caption_description  = '</p>';

		$before_controller = '';
		$after_controller  = '';

		$control_prev = '<a class="left carousel-control" href="#%s" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>';

		$control_next = '<a class="right carousel-control" href="#%s" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>';

		/**
		 * Gallery Images
		 * from gallery shortcode
		 */
		$images = array();

		if ( ! empty( $instance['gallery'] ) ) {
			$images = $this->get_gallery_images_from_shortcode( $instance['gallery'] );
		}

		/**
		 * Gallery Images
		 * average height
		 */
		if ( empty( $instance['image_height'] ) ) {

			$image_height = array();

			foreach ( $images as $image ) {
				$image_src      = wp_get_attachment_image_src( $image->ID, 'full' );
				$image_height[] = $image_src[2];
			}

			$instance['image_height'] = array_sum( $image_height ) / count( $image_height );
		}

		/**
		 * Side Caption
		 * style
		 */
		if ( $instance['style'] == 'carousel-side' ) {

			$side_style = array(
				'height:' . $instance['image_height'] . 'px;'
			);

			$before_inner = sprintf( '<div class="carousel-inner" role="listbox" style="%s">', implode( '', $side_style ) );

			$before_image .= '<div class="holder col-sm-8">';
			$after_carousel_image .= '</div>';

			$before_caption = '<div class="col-sm-4">';
			$before_caption .= '<div class="carousel-caption">';
			$after_caption = '</div>';
			$after_caption .= '</div>';

			$before_controller = sprintf( '<div class="controllers col-sm-8 col-xs-12" style="%s">', implode( '', $side_style ) );
			$after_controller  = '</div>';
		}

		/**
		 * Output
		 * Widget
		 */
		$carousel_id = $this->id . '-carousel_id';

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $before_title . $instance['title'] . $after_title;
		}

		echo sprintf( $before_carousel, $carousel_id, esc_attr( $instance['style'] ) );

		echo $before_inner;

		/** @var WP_Post $image */
		foreach ( $images as $image ) {

			echo sprintf( $before_image, $image === reset( $images ) ? 'active' : '' );

			$image_url = wp_get_attachment_image_url( $image->ID, 'full' );

			$image_style = array(
				'background: url(' . esc_url( $image_url ) . ');',
				'background-repeat: no-repeat;',
				'background-size: cover;',
				'background-position: ' . esc_attr( $instance['image_position'] ) . ';',
				'height: ' . intval( $instance['image_height'] ) . 'px;'
			);

			echo $before_carousel_image;
			echo sprintf( $carousel_image, implode( ' ', $image_style ) );
			echo $after_carousel_image;

			if ( ! empty( $image->post_content ) || ! empty( $image->post_excerpt ) ) {
				echo $before_caption;
				if ( ! empty( $image->post_title ) ) {
					echo $before_caption_title . $image->post_title . $after_caption_title;
				}
				if ( ! empty( $image->post_excerpt ) ) {
					echo $before_caption_description . $image->post_excerpt . $after_caption_description;
				}
				echo $after_caption;
			}

			echo $after_image;
		}

		echo $after_inner;

		/**
		 * CONTROLLER
		 * indicators
		 * control
		 */
		echo $before_controller;

		echo $before_indicators;
		$i = 0;
		foreach ( $images as $image ) {

			echo vsprintf( '<li  class="%s" data-target="#%s" data-slide-to="%s"></li>', array(
				$image === reset( $images ) ? 'active' : '',
				$carousel_id,
				$i ++
			) );
		}
		echo $after_indicators;

		echo sprintf( $control_prev, $carousel_id );
		echo sprintf( $control_next, $carousel_id );

		echo $after_controller;

		echo $after_carousel;

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
			'title'          => '',
			'gallery'        => '',
			'style'          => 'default',
			'image_height'   => '',
			'image_position' => 'center top'
		) );

		$instance['title']          = strip_tags( $instance['title'] );
		$instance['gallery']        = strip_tags( $instance['gallery'] );
		$instance['style']          = strip_tags( $instance['style'] );
		$instance['image_height']   = strip_tags( $instance['image_height'] );
		$instance['image_position'] = strip_tags( $instance['image_height'] );

		$lana_gallery = '';

		if ( ! empty( $instance['gallery'] ) ) {

			remove_filter( 'post_gallery', 'lana_gallery_shortcode', 10 );

			$gallery_shortcode_atts = lana_widgets_shortcode_get_atts( 'gallery', $instance['gallery'] );

			$lana_gallery = gallery_shortcode( array(
				'ids'     => explode( ',', $gallery_shortcode_atts['ids'] ),
				'columns' => 4,
				'link'    => 'none'
			) );

			add_filter( 'post_gallery', 'lana_gallery_shortcode', 10, 3 );
		}
		?>
		<div class="lana-widgets-carousel-widget">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">
					<?php _e( 'Title:', 'lana-widgets' ); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				       name="<?php echo $this->get_field_name( 'title' ); ?>"
				       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>

			<label for="<?php echo $this->get_field_id( 'gallery' ); ?>">
				<?php _e( 'Gallery:', 'lana-widgets' ); ?>
			</label>

			<div id="lana-widgets-gallery">
				<?php echo $lana_gallery; ?>
			</div>

			<input type="hidden" class="lana-gallery-id" id="<?php echo $this->get_field_id( 'gallery' ); ?>"
			       name="<?php echo $this->get_field_name( 'gallery' ); ?>"
			       value="<?php echo esc_attr( $instance['gallery'] ); ?>"/>

			<p>
				<input type="button" value="<?php _e( 'Edit Gallery', 'lana-widgets' ); ?>"
				       class="button lana-widgets-media-gallery" data-widget="lana-carousel"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'style' ); ?>">
					<?php _e( 'Style:', 'lana-widgets' ); ?>
				</label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>"
				        name="<?php echo $this->get_field_name( 'style' ); ?>">
					<option value="carousel-default" <?php selected( $instance['style'], 'carousel-default' ); ?>>
						Default
					</option>
					<option value="carousel-simple" <?php selected( $instance['style'], 'carousel-simple' ); ?>>
						Simple
					</option>
					<option value="carousel-navy" <?php selected( $instance['style'], 'carousel-navy' ); ?>>
						Navy
					</option>
					<option value="carousel-side" <?php selected( $instance['style'], 'carousel-side' ); ?>>
						Side Caption
					</option>
				</select>
			</p>

			<br/>

			<p>
				<label for="<?php echo $this->get_field_id( 'image_height' ); ?>">
					<?php _e( 'Image Height:', 'lana-widgets' ); ?>
				</label>
				<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'image_height' ); ?>"
				       name="<?php echo $this->get_field_name( 'image_height' ); ?>"
				       value="<?php echo esc_attr( $instance['image_height'] ); ?>"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'image_position' ); ?>">
					<?php _e( 'Image Position:', 'lana-widgets' ); ?>
				</label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'image_position' ); ?>"
				        name="<?php echo $this->get_field_name( 'image_position' ); ?>">
					<option value="center top" <?php selected( $instance['image_position'], 'center top' ); ?>>
						center top
					</option>
					<option value="center center" <?php selected( $instance['image_position'], 'center center' ); ?>>
						center center
					</option>
					<option value="center bottom" <?php selected( $instance['image_position'], 'center bottom' ); ?>>
						center bottom
					</option>
					<option value="left top" <?php selected( $instance['image_position'], 'left top' ); ?>>
						left top
					</option>
					<option value="left center" <?php selected( $instance['image_position'], 'left center' ); ?>>
						left center
					</option>
					<option value="left bottom" <?php selected( $instance['image_position'], 'left bottom' ); ?>>
						left bottom
					</option>
					<option value="right top" <?php selected( $instance['image_position'], 'right top' ); ?>>
						right top
					</option>
					<option value="right center" <?php selected( $instance['image_position'], 'right center' ); ?>>
						right center
					</option>
					<option value="right bottom" <?php selected( $instance['image_position'], 'right bottom' ); ?>>
						right bottom
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

		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['gallery']        = strip_tags( $new_instance['gallery'] );
		$instance['style']          = strip_tags( $new_instance['style'] );
		$instance['image_height']   = strip_tags( $new_instance['image_height'] );
		$instance['image_position'] = strip_tags( $new_instance['image_position'] );

		return apply_filters( 'lana_carousel_widget_update', $instance, $this );
	}
}

