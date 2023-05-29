<?php
namespace App;

/**
 * Theme related customizations.
 *
 * @package App
 */
class Theme
{
    public function __construct()
    {
        $this->init();
    }


    public function init()
    {
        // Features

        if (Config::get('features')['google-maps']) {
            add_action('acf/init', [$this, 'setAcfMapAPIKey']);
            add_action('theme/enqueueGoogleMapScripts', [$this, 'enqueueMapScripts']);
        }

        if (Config::get('features')['disable-search']) {
            add_action('template_redirect', [$this, 'disableSearch']);
        }

    }

    /**
     * Get environment mode
     * @return string
     */
    static function getEnv()
    {
        $env = Config::get('general')['env'];

        if ($env == 'adaptable') {
            $match = [
                '127.0.0.1',
                'localhost',
                'l.com',
                'dev.creation.lt',
                'home.creation.lt',
                'testlocatie.net',
            ];

            foreach ($match as $m) {
                if (strpos(home_url(), $m) !== FALSE) {
                    return 'dev';
                }
            }

            return 'prod';
        }

        return $env;
    }

    static public function getGoogleMapsAPIKey()
    {
        return get_field('google_maps_api_key', 'option') ? get_field('google_maps_api_key', 'option') : Config::get('general')['google-maps-api-key'];
    }


    // ACTIONS/FILTERS


    /**
     * Set Google Maps API key for ACF
     */
    public function setAcfMapAPIKey()
    {
        if ($key = self::getGoogleMapsAPIKey()) {
            acf_update_setting('google_api_key', $key);
        }
    }

    /**
     * Enqueue google map
     * @return
     */
    public function enqueueMapScripts()
    {
        if ($key = self::getGoogleMapsAPIKey()) {
            wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $key);
            Assets::load(array('map'));
        } else {
            throw new \Exception('Google Maps API key not set');
        }


    }

    /**
     * Disable search (show 404 page)
     */
    public function disableSearch()
    {
        if (is_search()) {
            global $wp_query;
            $wp_query->set_404();
        }
    }
}
