<?php

require_once realpath(__DIR__ . '/../element.php');

class Section extends Element
{

    public function __construct($state = array())
    {
        parent::__construct($state);
        $this->update([ 'content'=>array(), 'centered'=>false ]);
    }

    public function setCentered($val)
    {
        $this->setState([ 'centered'=>$val ]);
    }

    protected function render($props, $attrs, $content, $centered)
    {
        $data = self::merge($attrs, [ 'class'=>[$centered ? 'navbar-center' : 'navbar-section'] ]);
        ?>
        <section <?php $this->attributes($data); ?>>
            <?php self::print($content, $props); ?>
        </section>
        <?php
    }
}
