<?php
namespace App;

/**
 * Assets loader
 *
 * Allows loading grouped assets (css, js)
 *
 * @package App
 * @subpackage Core
 */
class Assets
{
    /**
     * Load assets from config/enqueue.php configuration
     * @param array $bundle Bundle name (as defined in enqueue.php bundles array)
     */
    static function load($bundle)
    {
        $bundles = Config::get('enqueue')['bundles'];
        $bundle = is_array($bundle) ? $bundle : array($bundle);

        foreach ($bundle as $item) {
            if (isset($bundles[$item])) {
                foreach ($bundles[$item] as $bundle) {
                    if (isset($bundle['styles'])) {
                        foreach ($bundle['styles'] as $style) {
                            wp_enqueue_style($style);
                        }
                    }
                    if (isset($bundle['scripts'])) {
                        foreach ($bundle['scripts'] as $script) {
                            wp_enqueue_script($script);
                        }
                    }
                }
            } else {
                wp_enqueue_style($item);
                wp_enqueue_script($item);
            }
        }
    }

}
