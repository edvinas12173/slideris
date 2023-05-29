<?php
namespace App;

/**
 * Owl carousel specific Image helper
 *
 * Supports lazy loading specific for owl.
 *
 * @package App
 * @subpackage Core
 */
class OwlImage extends Image
{

    /**
     * Get or output img tag
     * @param  array  $args img tag parameters
     * @return mixed
     */
    public static function img($args = array(), $isLazy = true, $output = true)
    {
        $args['class'] = isset($args['class']) ? $args['class'] . ' owl-lazy' : 'owl-lazy';
        $html = parent::img($args, $isLazy, false);

        if ($output)
            echo $html;
        else
            return $html;

    }
    /**
     * Set attributes for html element intended to be used with background image
     * @param  string  $src    URL
     * @param  string  $class  class
     * @param  boolean $isLazy Whether should be lazy loaded
     * @return void
     */
    public static function bgImg($src, $class = '', $isLazy = true)
    {
        echo 'data-src="' . $src . '" class="owl-lazy ' . $class . '"';
    }
}
