<?php

require_once realpath(__DIR__ . '/component.php');

class Navbar extends Component
{

    public function __construct($parameters)
    {
        parent::__construct($parameters);
        $this->addClasses('navbar');
        $this->parameters['sections'] = array();
    }

    protected function render($parameters)
    {
        $content = array();
        if (in_array('content', $parameters)) {
            array_push($content, ...$parameters['content']);
        }
        array_push($content, $parameters['sections']); ?>
        <header <?php $this->data($parameters); ?>>
            <?php self::print($content); ?>
        </header>
        <?php
    }

    public function addSections(...$sections)
    {
        array_push($this->parameters['sections'], ...$sections);
    }
}
