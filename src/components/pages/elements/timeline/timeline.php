<?php

require_once realpath(__DIR__ . '/../element.php');

function Timeline($props = null)
{
    [$element, $items, $elementProps] = Element::extract($props, ['element'=>null, 'items'=>array(), 'elementProps'=>array()]);
    $icon = null;
    foreach ($items as $item) {
        $data = array();
        Element::update($data, $elementProps, ['content'=>$item, 'icon'=>$icon]);
        Element::print($element, $data);
        if (!$icon) {
            $icon = "icon-check";
        }
    }
}
