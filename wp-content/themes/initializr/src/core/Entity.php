<?php
namespace App;

/**
 * Object oriented WP_Post wrapper
 *
 * @package App
 * @subpackage Core
 */
abstract class Entity
{
    protected $post;

    /**
     * Constructor
     * @param $_post WP Post object or post ID
     */
    function __construct($_post = null)
    {
        if (is_numeric($_post)) {
            $this->post = get_post($_post);
        } else if (is_object($_post)) {
            $this->post = $_post;
        } else {
            $this->post = get_post();
        }
    }

    /**
     * Get post ID
     * @return int
     */
    function getID()
    {
        return $this->post->ID;
    }

    /**
     * Get field value
     * @param  string  $key
     * @param  string  $default Return this value if field value is empty
     * @return mixed
     */
    function get($key, $default = false)
    {
        return get_field($key, $this->post) ? get_field($key, $this->post) : $default;
    }

    /**
     * Set field value
     * @param string    $key
     * @param mixed     $value
     */
    function set($key, $value)
    {
        update_field($key, $value, $this->post->ID);
    }

    /**
     * Get post title
     * @return string
     */
    function getTitle()
    {
        return get_the_Title($this->post);
    }

    /**
     * Get featured image
     * @param  string $size Image size
     * @return string Image url
     */
    function getFeaturedImage($size = 'large')
    {
        return get_the_post_thumbnail_url($this->post, $size);
    }

    /**
     * Get excerpt
     * @return string
     */
    function getExcerpt()
    {
        return get_the_excerpt($this->post);
    }

    /**
     * Get permalink
     * @return string
     */
    function getPermalink()
    {
        return get_permalink($this->post);
    }
}
