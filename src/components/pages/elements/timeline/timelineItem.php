<?php

require_once realpath(__DIR__ . '/../element.php');

function TimelineItem($props = null)
{
    [$content, $icon, $element, $elementProps] = Element::extract($props, ['content'=>array(), 'icon'=>null, 'element'=>null, 'elementProps'=>array()]);
    Element::update($elementProps, $content);
    ?>
    <div class="timeline-item">
        <div class="timeline-left">
        <?php if ($icon) { ?>
            <a class="timeline-icon icon-lg">
            <i class="icon <?= $icon ?>"></i>
            </a>
        <?php } else { ?>
            <a class="timeline-icon"></a>
        <?php } ?>
        </div>
        <div class="timeline-content">
            <?php Element::print($element, $elementProps); ?>
        </div>
    </div>
    <?php
}
