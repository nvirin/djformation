/**
 * Lana TinyMCE initialize
 * function
 *
 * @param element
 */
function lana_tinymce_init(element){

    var textfield_id = jQuery(element).attr('id');

    window.tinyMCEPreInit.mceInit[textfield_id] = _.extend({}, tinyMCEPreInit.mceInit['content']);

    if(_.isUndefined(tinyMCEPreInit.qtInit[textfield_id])){
        window.tinyMCEPreInit.qtInit[textfield_id] = _.extend({}, tinyMCEPreInit.qtInit['replycontent'], {id: textfield_id})
    }
    quicktags(window.tinyMCEPreInit.qtInit[textfield_id]);
    QTags._buttonsInit();

    window.switchEditors.go(textfield_id, 'tmce');
    tinymce.execCommand('mceRemoveEditor', true, textfield_id);
    tinymce.execCommand('mceAddEditor', true, textfield_id);
}
