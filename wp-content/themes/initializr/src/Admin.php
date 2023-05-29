<?php
namespace App;

/**
 * Admin panel related customizations
 *
 * @package App
 */
class Admin
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Init
     */
    public function init()
    {
//        $this->addOptionPages();
        $this->addSlidersPostType();

        add_action('admin_menu', [$this, 'removeMenuPages']);
    }
    /**
     * Add ACF options page
     */
    public function addOptionPages()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' => __('Theme settings', 'initializr'),
                'menu_title' => __('Theme settings', 'initializr'),
                'menu_slug'  => 'theme-settings',
                'icon_url'   => 'dashicons-laptop',
                'capability' => 'edit_posts',
                'redirect'   => false
            ]);
        }

    }

    /**
     * Add sliders post type
     */
    public function addSlidersPostType()
    {
        $supports = array(
            'title', // post title
            'custom-fields', // custom fields
        );

        $labels = array(
            'name'           => __('Sliders', 'plural'),
            'singular_name'  => __('Sliders', 'singular'),
            'menu_name'      => __('Sliders', 'admin menu'),
            'name_admin_bar' => __('Sliders', 'admin bar'),
            'add_new'        => __('Add New', 'add new'),
            'add_new_item'   => __('Add New slider'),
            'new_item'       => __('New slider'),
            'edit_item'      => __('Edit slider'),
            'view_item'      => __('View slider'),
            'all_items'      => __('All sliders'),
            'search_items'   => __('Search sliders'),
            'not_found'      => __('No sliders found.'),
        );

        $args = array(
            'supports'      => $supports,
            'labels'        => $labels,
            'menu_icon'     => 'dashicons-format-gallery',
            'menu_position' => 1,
            'public'        => true,
            'query_var'     => true,
            'rewrite'       => array('slug' => 'sliders'),
            'has_archive'   => false,
            'hierarchical'  => false
        );

        register_post_type('sliders', $args);
    }

    /**
     * Remove certain menu pages from admin
     */
    public function removeMenuPages()
    {
        remove_menu_page('edit-comments.php');
    }
}
