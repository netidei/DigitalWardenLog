<?php

require_once realpath(__DIR__ . '/component.php');

class Input extends Component
{

    private const ATTRS = array('value', 'checked', 'disabled', 'min', 'max', 'type', 'pattern', 'readonly');

    protected function render($parameters)
    {
        ?>
        <input <?php  $this->data($parameters, self::ATTRS); ?> />
        <?php
    }
}
