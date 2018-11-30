<?php

require_once realpath(__DIR__ . '/../component.php');

class Label extends Component
{

    private const ATTRS = ['for'];

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['content']);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        ?>
        <label <?php $this->attributes($parameters, self::ATTRS); ?> >
            <?php $this->print($content); ?>
        </label>
        <?php
    }
}