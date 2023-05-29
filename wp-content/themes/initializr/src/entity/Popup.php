<?php
namespace App\Entity;

use App\View as View;

/**
 * Popup entity
 *
 * @package App
 * @subpackage Entity
 */
class Popup extends \App\Entity
{

    /**
     * Get popup template
     * @return string
     */
    function getTemplate()
    {
        return get_post_meta($this->post->ID, 'popup_template', true);
    }

    /**
     * Get field value
     * @param  string $key
     * @param  string $default
     * @return mixed
     */
    function get($key, $default = null)
    {
        return get_field('popup_' . $key, $this->post->ID);
    }

    /**
     * Get popup ID
     */
    function getID()
    {
        return 'popup-' . $this->post->ID;
    }

    /**
     * Output popup html
     */
    function output()
    {
        if ($template = $this->getTemplate()) {
            $view = new View('popups/' . $template);
            $view->set('popup', $this);
            $view->output();
        }
    }
}
