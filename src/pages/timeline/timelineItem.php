<?php

require_once realpath(__DIR__ . '/../component.php');

class TimelineItem extends Component
{

    public function __construct($props = array())
    {
        parent::__construct($props);
        $this->define([
            'icon'=>false,
            'content'=>'array'
        ]);
    }

    protected function render($props, $icon, $content)
    {
        ?>
        <div class="timeline-item">
            <div class="timeline-left">
            <?php if ($icon) { ?>
                <a class="timeline-icon icon-lg">
                <i class="icon <?= $icon ?>"></i>
                </a>
            <?php } else { ?>
                <a class="timeline-icon"></a>
            <?php } ?>
            </div>
            <div class="timeline-content">
                <?php $this::print($content); ?>
            </div>
        </div>
        <?php
    }
}
