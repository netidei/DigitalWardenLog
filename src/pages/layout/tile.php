<?php

require_once realpath(__DIR__ . '/../component.php');

class Tile extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['title', 'subtitles'=>array()]);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
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
