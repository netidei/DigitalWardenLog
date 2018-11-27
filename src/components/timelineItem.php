<?php

require_once realpath(__DIR__ . '/component.php');

class TimelineItem extends Component
{

    protected function render($parameters)
    {
        $content = $parameters['content'];
        $icon = null;
        if (in_array('icon', $parameters)) {
            $parameters['icon'];
        }
        ?>
      <div class="timeline-item">
        <div class="timeline-left">
          <?php if ($icon) { ?>
            <a class="timeline-icon icon-lg">
              <i class="icon <?php echo $icon; ?>"></i>
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
