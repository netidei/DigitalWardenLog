<?php

require_once realpath(__DIR__ . '/../../component.php');

class Timeline extends Component
{

    public function __construct($state = array())
    {
        parent::__construct($state);
        $this->update([ 'items'=>array() ]);
    }

    protected function render($props, $items)
    {
        $icon = null;
        foreach ($items as $item) {
            self::print($item, ['icon'=>$icon]);
            if (!$icon) {
                $icon = "icon-check";
            }
        }
    }
}
