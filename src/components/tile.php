<?php

require_once realpath(__DIR__ . '/component.php');

class Tile extends Component
{

    protected function render($parameters)
    {
        $subtitles = $parameters['subtitles'];
        ?>
        <div class="tile-content">
        <p class="tile-title"><?php echo $parameters['title']; ?></p>
            <?php foreach ($subtitles as $subtitle) { ?>
            <p class="tile-subtitle"><?php echo $subtitle ?></p>
            <?php } ?>
        </div>
        <?php
    }
}
