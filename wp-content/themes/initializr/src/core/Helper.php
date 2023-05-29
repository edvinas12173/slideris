<?php
namespace App;

/**
 * Helper class
 *
 * @package App
 * @subpackage Core
 */
class Helper
{
    public static function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function dump($data)
    {
        if (is_array($data)) {
            print "<pre>-----------------------\n";
            print_r($data);
            print "-----------------------</pre>";
        } elseif (is_object($data)) {
            print "<pre>==========================\n";
            var_dump($data);
            print "===========================</pre>";
        } else {
            print "=========&gt; ";
            var_dump($data);
            print " &lt;=========";
        }
    }

    public static function dd($data)
    {
        self::dump($data);
        die;
    }

    public static function asset($file)
    {
        return Config::get('general')['asset-uri'] . '/' . $file;
    }

    public static function file($file)
    {
        return get_template_directory() . '/' . $file;
    }

    /**
     * Get page id by template name
     * @param  string $template Template name
     * @return int              Page id
     */
    public static function getPageByTemplate($template)
    {
        $templateFolder = Config::get('general')['template-folder'];

        $id = get_transient('page_template_link_'. $template);
        if ($id !== false) {
            return $id;
        }

        $templateFile = $templateFolder . $template . '.php';

        $args = [
            'post_type' => 'page',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => $templateFile
        ];
        $query = new \WP_Query($args);

        $id = wp_list_pluck($query->posts, 'ID');
        $id = !empty($id) ? $id[0] : false;

        wp_reset_query();

        set_transient('page_template_link_'. $template, $id, 24 * HOUR_IN_SECONDS);

        return $id;

    }

    /**
     * Render link
     * @param  array  $args     Html attributes (href, class etc.)
     * @param  array  $addArgs  Additional attributes (optional)
     * @param  bool   $echo     If true - output, otherwise return link html
     * @return
     */
    public static function link($args, $addArgs = array(), $echo = true)
    {
        if (empty($args))
            return;

        if (!is_array($args) && is_numeric($args)) {
            $url = get_permalink($args);
            $args = [
                'url' => $url
            ];
        }

        if (!empty($addArgs) && is_array($addArgs))
            $args = array_merge($args, $addArgs);

        $defaultArgs = [
            'target' => '_self',
            'url' => '',
            'class' => '',
            'title' => '',
        ];

        // Parse misc attributes
        $miscArgs = '';
        foreach ($args as $key => $val) {
            if (!in_array($key, array_keys($defaultArgs))) {
                $miscArgs .= ' ' . $key . '="' . $val . '" ';
            }
        }

        $args = wp_parse_args($args, $defaultArgs);

        $html = sprintf('<a href="%s" target="%s" class="%s" %s>%s</a>', $args['url'], $args['target'], $args['class'], $miscArgs, $args['title']);
        if ($echo)
            echo $html;
        else
            return $html;
    }

}
