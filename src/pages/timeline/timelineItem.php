<?php

require_once realpath(__DIR__ . '/../component.php');

class TimelineItem extends Component
{

    public function __construct($state = array())
    {
        parent::__construct($state);
        $this->update([
            'icon'=>false,
            'content'=>array()
        ]);
    }

    protected function render($props, $icon, $content)
    {
        [$icon] = self::define($props, ['icon'=>$icon]);
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
                <?php self::print($content, $props); ?>
            </div>
        </div>
        <?php
    }
}
