(function ($) {
    $(document).ready(function () {
        // only load if page is plugin admin settings page
        if ($('body').hasClass('settings_page_ifttp')) {
            // add new action
            $('.wrap').on('click', '.ifttp .dashicons.dashicons-plus', function () {
                var ifttp = $('.form-table .ifttp:last').clone(),
                    inc = parseInt($('input', ifttp).attr('name').match(/\d+/)) + 1;

                $('input', ifttp).val('').attr('name', 'ifttp[ifttp_tag_post][' + inc + '][if_tag]');
                $('select', ifttp).val('').attr('name', 'ifttp[ifttp_tag_post][' + inc + '][else_post]');

                $('.form-table .ifttp:last').after(ifttp);
            });

            // remove action
            $('.wrap').on('click', '.ifttp .dashicons.dashicons-no', function () {
                var ifttp = $('.form-table .ifttp:last');
                if ($('div.ifttp').size() > 1) {
                    $(this).closest('div.ifttp').remove();
                } else {
                    $('input, select', ifttp).val('');
                }
            });
        }
    });
})(jQuery);