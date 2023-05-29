<?php
namespace App;

/**
 * Widget partials
 *
 * Output widget template
 *
 * @package App
 * @subpackage Core
 */
class WidgetView extends View
{
    function __construct($file, $params = array())
    {
        parent::__construct($file);

        $this->partialDir = Config::get('general')['partial-dir'] . '/widgets';
        $this->values = $params;
    }

    public function output()
    {
        if ( ! file_exists($this->getFilePath())) {
            throw new \Exception("Error loading template file {$this->file}.php.");
        }

        extract($this->values);

        include $this->getFilePath();
    }

    public function setParams($params)
    {
        $this->values = $params;
    }

}
