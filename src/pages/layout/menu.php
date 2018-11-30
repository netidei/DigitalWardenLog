<?php

require_once realpath(__DIR__ . './../component.php');

class Menu extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['container', 'menuSections'=>array()]);
    }

    protected function render($paramentes)
    {
        extract($this->safe($paramentes));
        self::print($container, ['content'=>$menuSections, 'class'=>'navbar']);
    }

    public function addSections(...$sections)
    {
        if (count($sections) > 0) {
            array_push($this->parameters['menuSections'], ...$sections);
        }
    }
}
