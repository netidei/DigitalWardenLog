<?php

require_once realpath(__DIR__ . '/component.php');

class Label extends Component
{

    private const ATTRS = array('for');

    protected function render($parameters)
    {
        ?>
        <label <?php $this->data($parameters, self::ATTRS); ?> >
            <?php $this->print($parameters['content']); ?>
        </label>
        <?php
    }
}