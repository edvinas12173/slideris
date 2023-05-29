'use strict';

// Main script

(function($){

    // Variables

    var ua = navigator.userAgent;
    var event = (ua.match(/iPad/i)) ? "touchstart" : "click";
    var eventMouse = (ua.match(/iPad/i)) ? "touchstart" : "mouseenter";



    // Hooks

    $(document).ready(onDocumentReady);
    $(window).load(onWindowLoad);



    // Functions

    function onWindowLoad() {
        // Lazy loading

        if (typeof lozad === "function") {
            var lozadObserver = lozad('.lozad', {
                'threshold': 0.1,
            });
            lozadObserver.observe();
        }

    }

    function onDocumentReady() {
        // Match height

        $('.js-match-height').matchHeight();

        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            scrollbar: {
                el: ".swiper-scrollbar",
            },
            on: {
                slideChange: function() {
                    var number = swiper.activeIndex + 1;

                    if (number <= 10) {
                        number = '0' + number;
                    }

                    $(".scrollbarNumber").text(number);
                }
            }
        });

        $(".scrollbarNumber").appendTo(".swiper-scrollbar-drag");
    }


})(jQuery);
