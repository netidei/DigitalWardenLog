<?php

require_once realpath(__DIR__ . '/../component.php');

class TimelineItem extends Component
{

    private const DATA = ['content', 'icon'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
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

    public function setIcon($icon)
    {
        $this->parameters['icon'] = $icon;
    }
}
