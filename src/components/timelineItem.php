
<?php
  require_once(__DIR__ . '\\tile.php');

  function TimelineItem ($icon, $title, $items) { ?>
    <div class="timeline-item">
      <div class="timeline-left">
        <a class="timeline-icon">
        <?php if ($icon) { echo $icon; } ?>
        </a>
      </div>
      <div class="timeline-content">
        <?php Tile($title, $items); ?>
      </div>
    </div>
<?php } ?>