<?php
/**
 * Documentation: https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */
return [
    [
        'name'              => 'button',
        'title'             => __('Button', 'initializr'),
        'description'       => __('Button with link and text', 'initializr'),
        'category'          => 'layout',
        'icon'              => 'button',
        'keywords'          => array( 'button', 'link' ),
        'align'             => 'wide',
        'post_type'         => ['page'],
        // 'mode'              => 'edit',  // Default mode
        // 'supports'          => [
        //     'mode' => false,            // Disable preview mode
        // ],
        'example'  => array(
          'attributes' => array(
              'mode' => 'preview',
              'data' => array(
                'link'   => "/news",
                'label'  => "News",
                'open_in_new_tab' => false,
              )
          )
        )
    ]
];
