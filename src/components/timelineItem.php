<?php

require_once(realpath(__DIR__ . '/component.php'));

class TimelineItem extends Component
{
    private $icon = null;

    protected function render(...$content)
    {
        ?>
      <div class="timeline-item">
        <div class="timeline-left">
        <?php if ($this->icon) {
            ?>
            <a class="timeline-icon icon-lg">
              <i class="icon <?php echo $this->icon; ?>"></i>
            </a>
            <?php
        } else {
            ?>
            <a class="timeline-icon"></a>
    <?php
        } ?>
        </div>
        <div class="timeline-content">
          <?php $this::print($content); ?>
        </div>
      </div>
        <?php
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
}
