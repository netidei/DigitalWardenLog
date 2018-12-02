<?php

require_once realpath(__DIR__ . '/../element.php');

function Tile($props = null)
{
    [$title, $subtitles] = Element::define($props, ['title'=>'Title', 'subtitles'=>array()]);
    ?>
    <div class="tile-content">
    <p class="tile-title"><?= $title; ?></p>
        <?php foreach ($subtitles as $subtitle) { ?>
            <p class="tile-subtitle"><?= $subtitle ?></p>
        <?php } ?>
    </div>
    <?php
}
