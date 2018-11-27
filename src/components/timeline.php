<?php

require_once realpath(__DIR__ . '/component.php');
require_once realpath(__DIR__ . '/timelineItem.php');

class Timeline extends Component
{

    protected function render($components)
    {
        $icon = null;
        foreach ($components as $component)
        {
            if ($component instanceof TimelineItem) {
                $component->setIcon($icon);
            }
            $component->build();
            if (!$icon) {
                $icon = "icon-check";
            }
        }
    }
  
}
