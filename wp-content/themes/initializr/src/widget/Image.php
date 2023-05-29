<?php

namespace App\Widget;

class Image extends \App\Widget
{

    protected $params = array(
        'id_base' => 'image-widget',
        'name' => 'Image widget',
        'widget_options' => array(),
        'control_options' => array(),
    );

    protected $fields = array(
        'title' => array(
            'type' => 'text',
        ),
        'image' => array(
            'type' => 'media',
        )
    );

    /**
     * Templates located in partials/widgets
     */
    protected $template = 'image';
}
