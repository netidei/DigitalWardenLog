<?php

require_once realpath(__DIR__ . '/../component.php');

class Content extends Component
{

    public function __construct($data = array())
    {
        parent::__construct([ 'content'=>$data ]);
        $this->update([ 'content'=>array() ]);
    }

    protected function render($props, $content)
    {
        self::print($content, $props);
    }

    public function addContent(...$content)
    {
        $this->setState([ 'content'=>$content ]);
    }
}
