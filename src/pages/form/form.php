<?php

require_once realpath(__DIR__ . '/../component.php');

class Form extends Component
{

    private const ATTRS = ['method', 'action'];

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['content']);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        ?>
        <form <?php $this->attributes($parameters, self::ATTRS); ?>>
            <?php self::print($content); ?>
        </form>
        <?php
    }
}