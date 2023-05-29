/* Place slider scripts here */
'use strict';

(function($){
    $(document).ready(function() {

        $('.js-image-slider').owlCarousel({
            lazyLoad: true,
            lazyLoadEager: 2,
            items: 1,
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
        });
    });
})(jQuery, window);
