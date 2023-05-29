<?php
namespace App;

use \Pelago\Emogrifier\CssInliner;

class EmailParser
{

    /**
     * Get email CSS rules
     * @return string Email css rules
     */
    static function getCSS()
    {
        $css = '';

        $styles = [
            '/assets/css/email/styles.css',
        ];

        foreach ($styles as $style) {
            $path = get_template_directory() . $style;
            $css .= @file_get_contents($path);
        }
        return $css;
    }

    /**
     * Inline CSS into email HTML
     * @param  string $html HTML content without inline styles
     * @return string Inlined html content
     */
    static function inlineCSS($html)
    {
        $css = self::getCSS();
        return CssInliner::fromHtml($html)->inlineCss($css)->render();
    }

    /**
     * Parse email template
     * @param  string $template
     * @param  array  $data
     * @return string html
     */
    static function parse($template, $data = array())
    {
        set_query_var('template_data', $data);
        ob_start();
        get_template_part('partials/email/' . $template);
        $html = ob_get_clean();
        set_query_var('template_data', false);
        return self::inlineCSS($html);
    }
}
