<?php

require_once realpath(__DIR__ . '/component.php');

class NavbarSection extends Component
{

    public function setCentered($val)
    {
        $this->parameters['centered'] = $val;
    }

    protected function render($parameters)
    {
        $className =  $parameters['centered'] ? 'navbar-center' : 'navbar-section';
        if (in_array('class', $parameters)) {
            $parameters['class'] .= $className;
        } else {
            $parameters['class'] = $className;
        }
        ?>
        <section <?php $this->data($parameters); ?>>
            <?php $this->print($parameters['content']); ?>
        </section>
        <?php
    }
}
