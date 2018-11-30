<?php

require_once realpath(__DIR__ . '/../component.php');

class Timeline extends Component
{

    public function __construct($props = array())
    {
        parent::__construct($props);
        $this->define(['items'=>'array']);
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
