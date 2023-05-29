<?php
namespace App;

/**
 * Configuration
 *
 * @package App
 * @subpackage Core
 */
class Config
{
    const DIR = 'config';

    const REGISTRY = [
        'enqueue',
        'image-sizes',
        'post-types',
        'shortcodes',
        'taxonomies',
        'general',
        'features',
        'widgets',
        'acf-blocks',
        'block-patterns',
    ];

    protected static $storage;

    public static function get($key)
    {
        if ( ! in_array($key, self::REGISTRY)) {
            throw new \Exception("No {$key} is bound in the configuration.");
        }

        return self::$storage[$key];
    }

    public static function load()
    {
        foreach (self::REGISTRY as $config) {
            self::$storage[$config] = require get_template_directory() . '/' . self::DIR . '/' . $config . '.php';
        }
    }

}
