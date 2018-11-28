<?php

require_once realpath(__DIR__ . '/component.php');

class PartedComponent extends Component
{

    private const DATA = ['content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        self::print($content);
    }
}
