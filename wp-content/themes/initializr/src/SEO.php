<?php
namespace App;

/**
 * Customizations related to Yoast SEO
 *
 * @package App
 */
class SEO
{
    function __construct()
    {
        add_filter('wpseo_sitemap_exclude_post_type', [$this, 'excludePostType'], 10, 2);
        add_filter('wpseo_sitemap_exclude_author', [$this, 'excludeAuthor'], 10, 1);
        add_filter('wpseo_sitemap_exclude_taxonomy', [$this, 'excludeTaxonomy'], 10, 2);

        // Custom homepage title in breadcrumb
        add_filter('wpseo_breadcrumb_links', [$this, 'customizeYoastBreadcrumb']);

        // Custom meta title and description
        add_filter('wpseo_metadesc', [$this, 'customMetaDescription']);
        add_filter('wpseo_title', [$this, 'customMetaTitle']);

        add_filter('script_loader_tag', [$this, 'cleanScriptTag']);
        add_action( 'init', [$this, 'disableEmojis']);
    }

    function excludePostType($bool, $item)
    {
        $excluded = array();

        return in_array($item, $excluded) ? TRUE : $bool;
    }

    function excludeAuthor($users)
    {
        return TRUE;
    }

    function excludeTaxonomy($bool, $item)
    {
        $excluded = array();

        return in_array($item, $excluded) ? TRUE : $bool;
    }

    function customizeYoastBreadcrumb($links)
    {

        if (isset($links[0])) {
            if ($homepageId = get_option( 'page_on_front' )) {
                $links[0]['text'] = get_the_Title($homepageId);
            }
        }

        return $links;
    }

    function customMetaDescription($value)
    {
        // TODO: your logic
        return $value;
    }


    function customMetaTitle($value)
    {

        // TODO: your logic
        return $value;
    }

    function cleanScriptTag($input)
    {
        $input = str_replace("type='text/javascript'", '', $input);
        return $input;
    }

    function disableEmojis()
    {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    }

}
