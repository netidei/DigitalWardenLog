<?php

require_once realpath(__DIR__ . '/../component.php');

class Timeline extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['items'=>array()]);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        $icon = null;
        foreach ($items as $item) {
            self::print($item, ['icon'=>$icon]);
            if (!$icon) {
                $icon = "icon-check";
            }
        }
    }
}
