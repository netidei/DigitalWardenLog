<?php

require_once realpath(__DIR__ . '/component.php');

class NavbarSection extends Component
{

    private $centered = false;

    public function setCentered($val)
    {
        $this->centered = $val;
    }

    protected function render(...$elements)
    {
        $className = $this->centered ? 'navbar-center' : 'navbar-section'; ?>
    <section <?php $this->classes($className); ?>>
        <?php $this->print($elements); ?>
    </section>
        <?php
    }

}
