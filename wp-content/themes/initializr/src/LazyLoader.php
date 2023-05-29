<?php
namespace App;

/**
 * Lazy loader
 *
 * @package App
 */
class LazyLoader
{

    /**
     * Constructor
     */
    function __construct()
    {
        add_filter('lazyloader/lazyEnabled', [$this, 'setLazyLoaderStatus']);

        if (apply_filters('lazyloader/lazyEnabled', true)) {
            add_action('wp_head', [$this, 'fixIELazyLoading']);
            add_action('wp_enqueue_scripts', [$this, 'enqueneScripts']);
            //add_filter('the_content', [$this, 'filterImages' ]);
            //add_filter('theme/sectionContent', [$this, 'filterImages' ]);
            //add_filter('wp_get_attachment_image_attributes', [$this, 'setImageAttributes'], 99999, 3);
            add_filter('the_content', [$this, 'filterIframes' ]);
            add_filter('theme/sectionContent', [$this, 'filterIframes' ]);
        }
    }

    function enqueneScripts()
    {
        wp_enqueue_script('lozad');
    }

    function setLazyLoaderStatus($status)
    {
        return $status && Config::get('features')['lazyload'] === true;
    }

    public static function filterImages($content)
    {
        $matches        = array();
        $search         = array();
		$replace        = array();
        $placeholderURI = Image::getPlaceholderImg();

		preg_match_all( '/<img[\s\r\n]+.*?>/is', $content, $matches );

		$i = 0;
		foreach ( $matches[0] as $html ) {
			if ( ! preg_match( "/src=['\"]data:image/is", $html ) ) {
				$i++;
				$replaceHTML = '';

                if ( preg_match( '/class=["\']/i', $html ) ) {
					$replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lozad lozad--hidden $2$1', $html );
				} else {
					$replaceHTML = preg_replace( '/<img/is', '<img class="lozad lozad--hidden"', $html );
				}

				$replaceHTML = preg_replace( '/<img(.*?)src=/is', '<img$1src="' . $placeholderURI . '" data-toggle-class="lozad--loaded" data-src=', $replaceHTML );
				$replaceHTML = preg_replace( '/<img(.*?)srcset=/is', '<img$1srcset="" data-srcset=', $replaceHTML );

				array_push( $search, $html );
				array_push( $replace, $replaceHTML );
			}
		}

		$search   = array_unique( $search );
		$replace  = array_unique( $replace );
		$content  = str_replace( $search, $replace, $content );


		return $content;
    }

    function filterIframes($content)
    {
        $matches    = array();
        $search     = array();
		$replace    = array();

        preg_match_all('/(?:<iframe[^>]*)(?:(?:\/>)|(?:>.*?<\/iframe>))/is', $content, $matches);
        $i = 0;
		foreach ( $matches[0] as $html ) {
			$i++;
			$replaceHTML = '';

            if ( preg_match( '/class=["\']/i', $html ) ) {
				$replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lozad lozad--hidden $2$1', $replaceHTML );
			} else {
				$replaceHTML = preg_replace( '/<iframe/is', '<iframe class="lozad lozad--hidden"', $html );
			}

			$replaceHTML = preg_replace( '/<iframe(.*?)src=/is', '<iframe$1src=""  data-toggle-class="lozad--loaded"  data-src=', $replaceHTML );

			array_push( $search, $html );
			array_push( $replace, $replaceHTML );

		}

		$search   = array_unique( $search );
		$replace  = array_unique( $replace );
		$content  = str_replace( $search, $replace, $content );

		return $content;

    }

    function setImageAttributes($attr, $attachment, $size)
    {
        return Image::parseAttr($attr, true, true);
    }

    function fixIELazyLoading()
    {
    ?>
    <script>
    if (typeof Object.assign != 'function') {
        Object.assign = function(target) {
            'use strict';
            if (target == null) {
                throw new TypeError('Cannot convert undefined or null to object');
            }
            target = Object(target);
            for (var index = 1; index < arguments.length; index++) {
                var source = arguments[index];
                if (source != null) {
                    for (var key in source) {
                        if (Object.prototype.hasOwnProperty.call(source, key)) {
                            target[key] = source[key];
                        }
                    }
                }
            }
            return target;
        };
    }
    </script>
    <?php
    }

}
