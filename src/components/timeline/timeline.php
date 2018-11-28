<?php

require_once realpath(__DIR__ . '/../component.php');

class Timeline extends Component
{

    protected function render($parameters)
    {
        $icon = null;
        $components = $parameters['items'];
        foreach ($components as $component) {
            self::print($component, array('icon'=>$icon));
            if (!$icon) {
                $icon = "icon-check";
            }
        }
    }
}
