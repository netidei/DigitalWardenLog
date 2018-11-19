<?php
  require_once(realpath(__DIR__ . '/tile.php'));

  function TimelineItem ($icon, $title, $items) { ?>
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
        <?php Tile($title, $items); ?>
      </div>
    </div>
<?php } ?>