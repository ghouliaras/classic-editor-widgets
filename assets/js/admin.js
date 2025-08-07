/**
 * Classic Editor & Widgets Admin JavaScript
 *
 * @package ClassicEditorWidgets
 * @version 1.1.0
 */

(function($) {
    'use strict';

    // Admin functionality
    $(document).ready(function() {
        
        // Handle admin notices dismissal
        $('.notice.is-dismissible').on('click', '.notice-dismiss', function() {
            // Store dismissal in user meta if needed
            var noticeId = $(this).closest('.notice').attr('id');
            if (noticeId) {
                $.post(ajaxurl, {
                    action: 'dismiss_admin_notice',
                    notice_id: noticeId,
                    nonce: classicEditorWidgets.nonce
                });
            }
        });

        // Add any additional admin functionality here
        console.log('Classic Editor & Widgets admin script loaded');
    });

})(jQuery);
