/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function($) {

    $(document).ready(function() {

        $(window).load(function() {

            setTimeout(function() {
                $('#clickdesk-appendable-bubble').fadeIn('fast');
            }, 2000);
        });
        
        jQuery('.input-field input, .input-field textarea').blur(function() {
            parent = jQuery(this).closest('.input-field');
            message = parent.find('.pop-text');
            if (jQuery(this).val().length == 0) {
                parent.removeClass('active');
            } else {
                parent.addClass('active');
            }

        });

        jQuery('.input-field select,.input-field input[type="file"]').on('change',function() {
            parent = jQuery(this).closest('.input-field');
            message = parent.find('.pop-text');
                parent.addClass('active');

        });
    });


})(jQuery);