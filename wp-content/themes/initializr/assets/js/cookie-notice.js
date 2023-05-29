'use strict';

(function($, window){
    $(function() {

        $('.js-cookie-accept').click(acceptNotice);
        $('.js-cookie-close').click(closeNotice);

        function acceptNotice() {
            closeNotice();

            var date = new Date();
            date.setTime(date.getTime() + 2592000000);
            document.cookie = 'cookie-consent=1; expires=' + date.toGMTString() + '; path=/';
        }

        function closeNotice() {
            $('.js-cookie-notice').fadeOut();
        }

        if (document.cookie.indexOf('cookie-consent') >= 0) {
            $('#cookie-notice').hide();
        } else {
            $('#cookie-notice').show();
        }

    });
})(jQuery, window);
