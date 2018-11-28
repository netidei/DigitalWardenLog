<?php

require_once realpath(__DIR__ . '/../component.php');

class Navbar extends Component
{

    private const DATA = ['content'=>array(), 'sections'=>array()];

    public function __construct($parameters)
    {
        parent::__construct($parameters);
        $this->addClasses('navbar');
        $this->parameters['sections'] = array();
    }

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        array_push($content, ...$sections);
        ?>
        <header <?php $this->attributes($parameters); ?>>
            <?php self::print($content); ?>
        </header>
        <?php
    }

    public function addSections(...$sections)
    {
        array_push($this->parameters['sections'], ...$sections);
    }
}
