<?php

require_once realpath(__DIR__ . './../component.php');

class Menu extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['container', 'sections']);
    }

    protected function render($paramentes)
    {
        extract($this->safe($paramentes));
        self::print($container, ['content'=>$sections, 'class'=>'navbar']);
    }

    public function addSections(...$sections)
    {
        array_push($this->parameters['sections'], ...$sections);
    }
}
