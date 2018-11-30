<?php

require_once realpath(__DIR__ . '/../element.php');

class MenuSection extends Element
{

    public function __construct($props = array())
    {
        parent::__construct($props);
        $this->define([ 'content'=>'array', 'centered'=>false ]);
    }

    public function setCentered($val)
    {
        $this->setProps([ 'centered'=>$val ]);
    }

    protected function render($props, $content, $centered)
    {
        $this->addAttributes([ 'class'=>[
            $centered ? 'navbar-center' : 'navbar-section'
        ] ]);
        ?>
        <section <?php $this->attributes($props); ?>>
            <?php self::print($content); ?>
        </section>
        <?php
    }
}
