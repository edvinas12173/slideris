<?php
namespace App;

use \App\Entity\Popup as Popup;

/**
 * Popup loader
 *
 * @package App
 */
class PopupLoader
{
    /**
     * Default config
     * @var array
     */
    private $defaultConfig = array(
        'template' => 'image-link',
        'delay'   => 0,
        'refresh' => 1,
        'trigger' => 'timeout',
        'handler' => 'popup.defaultPopupHandler',
    );

    /**
     * Consturctor
     */
    function __construct()
    {
        add_action('wp_ajax_getPopup', [$this, 'getPopupHTML']);
        add_action('wp_ajax_nopriv_getPopup', [$this, 'getPopupHTML']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_filter('theme/popupConfig', [$this, 'customHandlers'], 10, 2);
        add_filter('setup/skipRegisterPostType', [$this, 'skipPopupsPostType'], 10, 3);
    }

    /**
     * Load scripts
     */
    function enqueueScripts()
    {
        wp_enqueue_style('fancybox',get_stylesheet_directory_uri() . '/assets/3rdparty/fancybox-5.0/fancybox.min.css', array(), '5.0');
        wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/assets/3rdparty/fancybox-5.0/fancybox.min.js', array(), '5.0');

        $popupJsPath = '/assets/js/popup.js';
        wp_enqueue_script('popup-js',  get_stylesheet_directory_uri() . $popupJsPath, ['fancybox'], filemtime(get_stylesheet_directory() . $popupJsPath));

        $config = $this->getActivePopupsConfig();

        wp_localize_script('popup-js', 'popupConfig', $config);
    }


    /**
     * Get active popups configuration
     * @return array
     */
    function getActivePopupsConfig()
    {
        $config = array();
        $args = array(
            'post_type' => 'popups',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'popup_enabled',
                    'value' => true,
                )
            )
        );

        $query = new \WP_Query($args);

        while($query->have_posts()) {
            $query->the_post();

            $popupId = $this->getPopupId(get_the_ID());
            $config[$popupId] = $this->getPopupConfig(get_the_ID());
        }

        return $config;
    }

    /**
     * Get single popup configuration
     * @return array
     */
    function getPopupConfig($postId)
    {
        // Load config

        $config = array(
            'id' => $this->getPopupId($postId),
            'post_id' => $postId,
        );

        if ($trigger = get_post_meta($postId, 'popup_trigger', true)) {
            $config['trigger'] = $trigger;
        }

        if ($template = get_post_meta($postId, 'popup_template', true) ) {
            $config['template'] = $template;
        }

        if ($handler = get_post_meta($postId, 'popup_handler', true)) {
            $config['handler'] = $handler;
        }

        if ($refresh = get_post_meta($postId, 'popup_refresh', true)) {
            $config['refresh'] = $refresh;
        }

        if ($config['trigger'] == 'timeout') {
            $config['delay'] = get_post_meta($postId, 'popup_delay', true);
        } else if ($config['trigger'] == 'click') {
            $config['click_selector'] = get_post_meta($postId, 'popup_click_selector', true);
        }

        $config = wp_parse_args($config, $this->defaultConfig);

        $config = apply_filters('theme/popupConfig', $config, $postId);

        return $config;
    }

    /**
     * Get popup id
     * @param  $postId Popup post ID
     * @return
     */
    function getPopupId($postId)
    {
        return 'popup-' . $postId;
    }

    /**
     * Output popup html content
     *
     */
    function getPopupHTML()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : false;
        if (empty($id))
            die;

        header("Content-type: text/html");
        $popup = new Popup($id);
        $popup->output();

        die;
    }

    /**
     * Set custom js handler function for popup
     * @param  array $config    Popup config array
     * @param  int $postId      Popup post ID
     * @return array
     */
    function customHandlers($config, $postId)
    {

        if ($config['template'] == 'register') {
            $config['handler'] = 'popup.registerPopupHandler';
        }

        return $config;
    }

    function skipPopupsPostType($skip, $name, $args)
    {
        if ($name == 'popups' && Config::get('features')['popups'] == false ) {
            return true;
        }

        return $skip;
    }

}
