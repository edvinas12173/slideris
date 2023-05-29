<?php
namespace App;

/**
 * Shortcode loader
 *
 * Setup and load shortcodes as configured in config/shortcodes.php
 *
 * @package App
 * @subpackage Core
 */
class Shortcodes
{
    protected $partialDir;
    protected $shortcodeConfig;

    function __construct()
    {
        $this->partialDir      = Config::get('general')['shortcode-dir'];
        $this->shortcodeConfig = Config::get('shortcodes');
        $this->add();
    }

    private function add()
    {
        foreach ($this->shortcodeConfig as $name => $options) {
            $params = $options['params'];

            add_shortcode(
                $name,
                function ($setAttributes, $content) use ($name, $params) {
                    $defaultAttributes = $this->getDefaultAttributes($params);
                    $shortcode         = new View($name);
                    $attributes        = shortcode_atts($defaultAttributes, $setAttributes);

                    $shortcode->setPartialDir($this->partialDir);
                    $shortcode->set('content', $content);

                    foreach ($attributes as $name => $value) {
                        $shortcode->set($name, $value);
                    }

                    ob_start();

                    $shortcode->output();

                    return ob_get_clean();
                }
            );

            if (function_exists('vc_map')) {
                add_action(
                    'vc_before_init',
                    function () use ($name, $options) {
                        vc_map([
                                   "name" => __(ucfirst($name), 'initializr'),
                                   "base" => $name,
                               ] + $options);
                    }
                );
            }
        }
    }

    private function getDefaultAttributes($params)
    {
        return array_reduce($params, function ($result, $param) {
            if ($param['param_name'] == 'content') {
                return $result;
            }

            if (array_key_exists('value', $param)) {
                $value = (is_array($param['value'])) ? '' : $param['value'];
            } else {
                $value = '';
            }

            $result[$param['param_name']] = $value;

            return $result;
        }, []);
    }
}
