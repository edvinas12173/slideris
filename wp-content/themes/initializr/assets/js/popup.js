'use strict';

var $ = jQuery;

var popup = (function() {

    /**
     * Initialize popups
     *
     */
    function init()
    {
        $.each(popupConfig, function(popupID, item) {

            if (item.trigger == 'click') {
                $(document).on('click', item.click_selector, { item : item }, function(event) {
                    popup.render(event.data.item);
                })
            } else if (item.trigger == 'timeout') {
                if (!popup.hasCookie(popupID)) {

                    // Render popup
                    setTimeout(function (item) {
                        popup.render(item);
                    }, item.delay * 1000, item);

                    // Set cookie
                    popup.setCookie(popupID, item.refresh);
                }
            }
        });
    }

    /**
     * Get cookie
     */
    function getCookie(key)
    {
        return document.cookie.indexOf(key);
    }

    /**
     * Set cookie for popup
     */
    function setCookie(key, time, multiplier)
    {
        var factor = 24 * 60 * 60 * 1000; // Days multiplier
        if (multiplier == 'seconds') {
            factor = 1000;
        } else {
            multiplier = 'days';
        }
        var date = new Date();
        date.setTime(date.getTime() + (time * factor));
        document.cookie = key + '=1; expires=' + date.toGMTString() + '; path=/';
    }

    /**
     * Check if popup has cookie
     */
    function hasCookie(key)
    {
        return document.cookie.indexOf(key) >= 0;
    }

    /**
     * Erase popup cookie
     */
    function eraseCookie(key)
    {
        createCookie(key, "", -1);
    }

    /**
     * Render popup
     */
    function render(item)
    {
        $.ajax({
            url: api.ajaxUrl,
            dataType: 'html',
            method: 'GET',
            data: {
                action: 'getPopup',
                id : item.post_id,
            },
            success: function(html) {
                $('body').append(html);

                // Handle popup
                if (item.handler != 'popup.defaultPopupHandler') {
                    eval(item.handler + '("' + item.id + '")');
                } else {
                    popup.defaultPopupHandler(item.id);
                }
            }
        })
    }


    /* Popup handlers */

    /**
     * Handle registration popup
     */
    function registerPopupHandler(popupID)
    {
        wpcf7.init($('.register-popup div.wpcf7 > form')[0]);

        new Fancybox([
          {
              type: 'inline',
              src: '#' + popupID,
              touch: false
          },
        ]);

        popup.setCookie(popupID, popupConfig[popupID].refresh);

    }

    /**
     * Default popup handler - open popup with fancybox
     */
    function defaultPopupHandler(popupID)
    {
        new Fancybox({
            type: 'inline',
            src: '#' + popupID,
            touch: false
        });
    }

    return {
        init: init,
        render : render,
        hasCookie : hasCookie,
        getCookie : getCookie,
        setCookie : setCookie,
        eraseCookie : eraseCookie,
        defaultPopupHandler: defaultPopupHandler,
        registerPopupHandler : registerPopupHandler,
    }

})();

(function ($) {

    $(document).ready(function() {
        popup.init();
    })

})(jQuery);
