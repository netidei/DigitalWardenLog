<?php

require_once realpath(__DIR__ . '/../component.php');

class Label extends Component
{

    private const ATTRS = ['for'];
    private const DATA = ['content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
        <label <?php $this->attributes($parameters, self::ATTRS); ?> >
            <?php $this->print($content); ?>
        </label>
        <?php
    }
}