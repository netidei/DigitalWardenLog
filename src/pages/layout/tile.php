<?php

require_once realpath(__DIR__ . '/../component.php');

class Tile extends Component
{

    public function __construct($props = array())
    {
        parent::__construct($props);
        $this->define([
            'title'=>'string',
            'subtitles'=>'array'
        ]);
    }

    protected function render($props, $title, $subtitles)
    {
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
