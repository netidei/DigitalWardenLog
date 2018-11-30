<?php

require_once realpath(__DIR__ . './../component.php');

class Menu extends Component
{

    public function __construct($props = array())
    {
        parent::__construct($props);
        $this->define([ 'menuSections'=>'array' ]);
    }

    protected function render($props, $menuSections)
    {
        self::print($menuSections);
    }

    public function addSections(...$sections)
    {
        $this->setProps([ 'menuSections'=>$sections ]);
    }
}
