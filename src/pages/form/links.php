<?php

require_once realpath(__DIR__ . '/../element.php');

class DefaultLink extends Element
{

    public function __construct($state = array())
    {
        parent::__construct($state);
        $this->update([ 'content'=>array() ]);
        $this->addClasses('btn');
    }

    protected function render($props, $attrs, $content)
    {
        ?>
        <a <?php self::attributes($attrs) ?>>
            <?php self::print($content, $props); ?>
        </a>
        <?php
    }
}

class ButtonLink extends DefaultLink
{

    public function __construct($state)
    {
        parent::__construct($state);
        $this->addClasses('btn-link');
    }
}

class PrimaryLink extends DefaultLink
{

    public function __construct($state)
    {
        parent::__construct($state);
        $this->addClasses('btn-primary');
    }
}
