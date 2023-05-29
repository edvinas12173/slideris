<?php
namespace App;

class Widget extends \WP_Widget
{
    /**
     * See https://developer.wordpress.org/reference/classes/wp_widget/__construct/
     * @var array
     */
    protected $params = array(
        'id_base'           => '',
        'name'              => '',
        'widget_options'    => array(),
        'control_options'   => array(),
    );


    /**
     * Widget fields
     * @var array
     */
    protected $fields = array();

    protected $template;

    protected $instance;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			$this->params['id_base'],
			$this->params['name'],
			$this->params['widget_options'],
            $this->params['control_options']
		);

         add_action('admin_enqueue_scripts', array($this, 'addScripts'));
	}

    function addScripts()
    {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script('upload-media', get_template_directory_uri() . '/assets/js/admin/upload-media.js', array('jquery'));
    }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

        $instance['title'] = empty($instance['title']) && !empty($this->fields['title']['default']) ? $this->fields['title']['default'] : $instance['title'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$view = new WidgetView($this->template, $instance);
        $view->output();

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $this->instance = $instance;

        foreach ($this->fields as $key => $params) {
            $this->outputField($key, $params);
        }
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $newInstance Values just sent to be saved.
	 * @param array $oldInstance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $newInstance, $oldInstance ) {

        $instance = array();
        foreach ($this->fields as $key => $params) {
            if (isset($newInstance[$key])) {
                $instance[$key] = $newInstance[$key];
            } else {
                $instance[$key] = '';
            }
        }

		return $instance;
	}

    function outputField($key, $args)
    {
        $defaultArgs = array(
            'type' => 'text',
            'label' => ucfirst($key),
            'class' => 'widefat',
            'id' => $this->get_field_id($key),
            'name' => $this->get_field_name($key),
            'value' => !empty( $this->instance[$key] ) ? $this->instance[$key] : '',
        );

        $args = wp_parse_args($args, $defaultArgs);
        $type = $args['type'];
        $method = "outputField_{$type}";

        if ( is_callable( array($this, $method ) ) )  {
            $this->$method($key, $args);
        }
    }

    function outputField_number($key, $args)
    {
        ?>
        <p>
        <?php if ($args['label']) : ?>
            <label for="<?php $key ?>"><?php echo $args['label'] ?></label>
        <?php endif; ?>
        <input
            <?php echo isset($args['min']) ? 'min="' . floatval($args['min']) . '"' : '' ?>
            <?php echo isset($args['max']) ? 'max="' . floatval($args['max']) . '"' : '' ?>
            <?php echo isset($args['step']) ? 'step="' . floatval($args['step']) . '"' : '' ?>
            class="<?php echo $args['class'] ?>"
            id="<?php echo $args['id'] ?>"
            name="<?php echo $args['name'] ?>"
            value="<?php echo $args['value'] ?>"
            type="number">
        </p>

        <?php
    }

    function outputField_text($key, $args)
    {
        ?>
        <p>
        <?php if ($args['label']) : ?>
            <label for="<?php $key ?>"><?php echo $args['label'] ?></label>
        <?php endif; ?>
        <input
            class="<?php echo $args['class'] ?>"
            id="<?php echo $args['id'] ?>"
            name="<?php echo $args['name'] ?>"
            value="<?php echo $args['value'] ?>"
            type="text">
        </p>

        <?php
    }

    function outputField_textarea($key, $args)
    {
        ?>
        <p>
        <?php if ($args['label']) : ?>
            <label for="<?php $key ?>"><?php echo $args['label'] ?></label>
        <?php endif; ?>
        <textarea class="<?php echo $args['class'] ?>"
            id="<?php echo $args['id'] ?>"
            name="<?php echo $args['name'] ?>"
            ><?php echo esc_textarea($args['value']) ?></textarea>
        </p>
        <?php
    }

    function outputField_media($key, $args)
    {
        $args['value']  = !empty($args['value']) ? intval($args['value']) : '';
        $preview        = !empty($args['value']) ? basename(wp_get_attachment_url($args['value'])) : '';
        ?>
        <p>
            <?php if ($args['label']) : ?>
                <label for="<?php $key ?>"><?php echo $args['label'] ?></label>
            <?php endif; ?>
            <input class="widefat preview-media" disabled id="<?php echo $args['id'] . '-preview'; ?>" name="<?php echo $args['name'] . '-preview'; ?>" type="text" value="<?php echo $preview ?>" />
            <input class="widefat" id="<?php echo $args['id']; ?>" name="<?php echo $args['name']; ?>" type="hidden" value="<?php echo $args['value']; ?>" />
        </p>
        <p>
            <button data-target="#<?php echo $args['id']; ?>" class="js-upload-media button button-secondary"><?php _e('Select image', 'initializr') ?></button>
            <button data-target="#<?php echo $args['id']; ?>" class="js-remove-media button button-secondary"><?php _e('Remove', 'initializr') ?></button>
        </p>
        <?php
    }

}
