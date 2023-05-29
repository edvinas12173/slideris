<?php
namespace App;

/**
 * Cookie notice feature
 *
 * @package App
 */
class CookieNotice
{

    /**
     * Constructor
     */
    function __construct()
    {
        $this->init();
    }

    /**
     * Init
     */
    public function init()
    {
        if (get_field('cb_enabled', 'option')) {
            wp_enqueue_script('cookie-notice');
            add_action('wp_footer', array($this, 'addCookieNoticeHTML'));
        }
    }

    /**
     * Output cookie notice html
     */
    public function addCookieNoticeHTML()
    {
        $view = new View('cookie-notice');
        $view->output();
    }

}
