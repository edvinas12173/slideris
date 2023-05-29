'use strict';

var $ = jQuery;


var googleMap = (function() {
    var maps = [];

    function init() {
        $('[data-map]').each(function() {
            // create map
            maps.push(newMap($(this)));
        });
    }

    /*
     *  newMap
     *
     *  This function will render a Google Map onto the selected jQuery element
     *
     *  @type	function
     *  @date	8/11/2013
     *  @since	4.3.0
     *
     *  @param	$el (jQuery element)
     *  @return	n/a
     */

    function newMap($el) {

        // var
        var $markers = $el.find('.marker');


        // vars
        var args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };


        // create map
        var map = new google.maps.Map($el[0], args);


        // add a markers reference
        map.markers = [];


        // add markers
        $markers.each(function() {

            addMarker($(this), map);

        });


        // center map
        centerMap(map);


        // return
        return map;

    }

    /*
     *  addMarker
     *
     *  This function will add a marker to the selected Google Map
     *
     *  @type	function
     *  @date	8/11/2013
     *  @since	4.3.0
     *
     *  @param	$marker (jQuery element)
     *  @param	map (Google Map object)
     *  @return	n/a
     */

    function addMarker($marker, map) {

        // var
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        if ($marker.attr('data-icon')) {
            var iconImage = {
                url: $marker.attr('data-icon'),
                scaledSize: new google.maps.Size(100, 100),
            }
        }

        // create marker
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: $marker.attr('data-icon') ? iconImage : '',
            markerId: $marker.attr('data-id'),
        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function() {

                infowindow.open(map, marker);

            });
        }

    }

    /*
     *  centerMap
     *
     *  This function will center the map, showing all markers attached to this map
     *
     *  @type	function
     *  @date	8/11/2013
     *  @since	4.3.0
     *
     *  @param	map (Google Map object)
     *  @return	n/a
     */

    function centerMap(map) {

        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each(map.markers, function(i, marker) {

            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

            bounds.extend(latlng);

        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        } else {
            // fit to bounds
            map.fitBounds(bounds);
        }

    }


    return {
        init: init,
    }
})();

(function($) {
    $(document).ready(function() {
        googleMap.init();
    });

})(jQuery);
