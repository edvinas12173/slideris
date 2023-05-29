<?php
namespace App;

/**
 * Image helper
 *
 * Supports lazy loading.
 *
 * @package App
 * @subpackage Core
 */
class Image
{

    const LOZAD_CLASS = ' lozad';
    const LOZAD_LOADED_CLASS  = 'lozad--loaded';


    /**
     * Output/get img tag
     * @param  array  $attr     img tag attributes
     * @param  bool   $isLazy   Is lazy loaded
     * @return string           img element
     */
    public static function img($attr = array(), $isLazy = true, $output = true)
    {
        $attr = self::parseAttr($attr, $isLazy);

        $attrFlat = '';

        foreach ($attr as $attrKey => $attrVal) {
            if (!empty($attrVal))
                $attrFlat .= ' ' . $attrKey . '="' . htmlspecialchars($attrVal) . '"';
        }
        $attrFlat = trim($attrFlat);
        $html = '<img ' . $attrFlat . '>';

        if ($output)
            echo $html;
        else
            return $html;
    }

    /**
     * Parse image attributes
     * @param  array    $attr   array of initial attributes
     * @param  boolean  $isLazy lazy loading enabled?
     * @return array            filtered attributes
     */
    function parseAttr($attr, $isLazy = true)
    {
        $isLazy = apply_filters('lazyloader/lazyEnabled', $isLazy);

        $defaults = array(
            'src'       => '',
            'width'     => '',
            'height'    => '',
            'alt'       => '',
            'title'     => '',
            'class'     => '',
            'srcset'    => '',
        );

        $attr = wp_parse_args($attr, $defaults);

        if ($isLazy) {
            $attr['loading'] = 'lazy';
        }

        return $attr;
    }

    /**
     * Output background image attributes
     * @param  string   $src    url
     * @param  string   $class  image class
     */
    public static function bgImg($src, $class = '', $isLazy = true)
    {
        if (apply_filters('lazyloader/lazyEnabled', $isLazy)) {
            $class .= self::LOZAD_CLASS;
            echo 'data-toggle-class="' . self::LOZAD_LOADED_CLASS . '" data-background-image="' . $src . '" class="' . $class . '"';
        } else {
            echo 'style="background-image: url(' . $src . ')" class="' . $class . '"';
        }
    }

    /**
     * Get placeholder image for lazy loaded image
     * @return string
     */
    public static function getPlaceholderImg()
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAC0lEQVQI12NgAAIAAAUAAeImBZsAAAAASUVORK5CYII=';
    }

    /**
     * Get URL from image source
     * @param  mixed    $src  Can be attachment id, image source array or image url
     * @param  string   $size Thumbnail size
     * @return string   Image url or null on fail
     */
    public static function getUrl($src, $size = 'full')
    {
        if (is_array($src)) {
            return isset($src['sizes'][$size]) ? $src['sizes'][$size] : $src['url'];
        } else if (is_numeric($src)) {
            if ($src = wp_get_attachment_image_src($src, $size)) {
                return $src[0];
            }
        } else {
            return $src;
        }

        return null;
    }
}
