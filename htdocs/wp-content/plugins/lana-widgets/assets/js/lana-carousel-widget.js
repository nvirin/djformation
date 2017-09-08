/**
 * Lana Widgets
 * with WordPress Media Gallery
 */
jQuery(function () {
    'use strict';

    jQuery('body').on('click', '.lana-widgets-media-gallery[data-widget="lana-carousel"]', function () {

        var lana_widgets_carousel_widget = jQuery(this).closest('.lana-widgets-carousel-widget');
        var gallery = lana_widgets_carousel_widget.find('.lana-gallery-id');

        var selection = lana_widgets_get_gallery_selection_from_shortcode(gallery.val());

        var frame = wp.media({
            frame: 'post',
            title: wp.media.view.l10n.editGalleryTitle,
            multiple: false,
            state: 'gallery-edit',
            editing: true,
            selection: selection
        });

        frame.on('update', function () {
                var controller = frame.states.get('gallery-edit');
                var library = controller.get('library');
                var gallery_shortcode = wp.media.gallery.shortcode(library).string();

                gallery.val(gallery_shortcode);
                lana_widgets_ajax_get_gallery_html_from_shortcode(lana_widgets_carousel_widget, gallery_shortcode);
            })
            .on('close', function () {
                jQuery('.supports-drag-drop').remove();
                jQuery('.wp-uploader-browser').remove();
            });

        frame.open();
        return false;
    });

});

/**
 * Ajax get gallery html
 *
 * @param container
 * @param gallery_shortcode
 */
function lana_widgets_ajax_get_gallery_html_from_shortcode(container, gallery_shortcode) {
    jQuery.post(
        ajaxurl,
        {
            action: 'lana_widgets_gallery_html_from_shortcode',
            gallery_shortcode: gallery_shortcode
        },
        function (data) {
            container.find('#lana-widgets-gallery').html(data);
        },
        'html'
    );
}

/**
 * Get gallery selection from shortcode
 *
 * @param gallery_shortcode
 * @returns {*}
 */
function lana_widgets_get_gallery_selection_from_shortcode(gallery_shortcode) {

    gallery_shortcode = wp.shortcode.next('gallery', gallery_shortcode);

    if (!gallery_shortcode) {
        return null;
    }
    gallery_shortcode = gallery_shortcode.shortcode;

    var gallery_id = wp.media.gallery.defaults.id;
    var attachments;
    var selection;

    if (typeof gallery_shortcode.get('id') != 'undefined' && typeof gallery_id != 'undefined') {
        gallery_shortcode.set('id', gallery_id);
    }

    attachments = wp.media.gallery.attachments(gallery_shortcode);
    selection = new wp.media.model.Selection(attachments.models, {
        props: attachments.props.toJSON(),
        multiple: true
    });

    selection.gallery = attachments.gallery;

    selection.more().done(function () {
        selection.props.set({
            query: false
        });
        selection.unmirror();
        selection.props.unset('link');
        selection.props.unset('orderby');
    });
    return selection;
}