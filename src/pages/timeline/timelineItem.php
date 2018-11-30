<?php

require_once realpath(__DIR__ . '/../component.php');

class TimelineItem extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['icon', 'content']);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
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
