<?php

require_once realpath(__DIR__ . '/../component.php');

class Tile extends Component
{

    private const DATA = ['title', 'subtitles'=>array()];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
        <div class="tile-content">
        <p class="tile-title"><?= $title; ?></p>
            <?php foreach ($subtitles as $subtitle) { ?>
                <p class="tile-subtitle"><?= $subtitle ?></p>
            <?php } ?>
        </div>
        <?php
    }
}
