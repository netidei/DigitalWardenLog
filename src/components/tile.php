<?php  function Tile ($title, $subtitles) { ?>
    <div class="tile-content">
      <p class="tile-title"><?php echo $title ?></p>
      <?php foreach ($subtitles as $subtitle) { ?>
        <p class="tile-subtitle"><?php echo $subtitle ?></p>
      <?php } ?>
    </div>
<?php } ?>