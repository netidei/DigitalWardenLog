<?php

require_once realpath(__DIR__ . '/../component.php');

class MenuSection extends Component
{

    private const DATA = ['content', 'centered'=>false];

    public function setCentered($val)
    {
        $this->parameters['centered'] = $val;
    }

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        $className = $centered ? 'navbar-center' : 'navbar-section';
        if (in_array('class', $parameters)) {
            $parameters['class'] .= $className;
        } else {
            $parameters['class'] = $className;
        }
        ?>
        <section <?php $this->attributes($parameters); ?>>
            <?php self::print($content); ?>
        </section>
        <?php
    }
}
