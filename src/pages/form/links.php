<?php

require_once realpath(__DIR__ . '/../element.php');

class DefaultLink extends Element
{

    public function __construct($props = array())
    {
        $props = self::merge($props, [ 'attributesList'=>['href'], 'attributes'=>[
            'class'=>['btn']
        ] ]);
        parent::__construct($props);
        $this->define([ 'content'=>'array' ]);
    }

    protected function render($props, $content)
    {
        ?>
        <a <?php $this->attributes($props) ?>>
            <?php self::print($content); ?>
        </a>
        <?php
    }
}

class ButtonLink extends DefaultLink
{

    public function __construct($props)
    {
        parent::__construct($props);
        $this->addAttributes([
            'class'=>['btn-link']
        ]);
    }
}

class PrimaryLink extends DefaultLink
{

    public function __construct(...$data)
    {
        parent::__construct(...$data);
        $this->addAttributes([
            'class'=>['btn-primary']
        ]);
    }
}
