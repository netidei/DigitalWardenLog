<?php

require_once realpath(__DIR__ . '/component.php');

class Form extends Component
{

    private const ATTRS = ['method', 'action'];
    private const DATA = ['content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
        <form <?php $this->attributes($parameters, self::ATTRS); ?>>
            <?php self::print($content); ?>
        </form>
        <?php
    }
}