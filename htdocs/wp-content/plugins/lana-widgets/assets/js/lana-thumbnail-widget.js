/**
 * Lana Widgets
 * with WordPress Media
 */
jQuery(function () {
    'use strict';

    jQuery('body').on('click', '.lana-widgets-media-image[data-widget="lana-thumbnail"]', function () {

        var lana_widgets_thumbnail_widget = jQuery(this).closest('.lana-widgets-thumbnail-widget');
        var image = lana_widgets_thumbnail_widget.find('.lana-widgets-image');
        var image_url = lana_widgets_thumbnail_widget.find('.lana-widgets-image-url');

        wp.media.editor.send.attachment = function (props, attachment) {
            image.attr('src', attachment.url);
            image_url.val(attachment.url);
        };
        wp.media.editor.open(jQuery(this));

        return false;
    });
});
