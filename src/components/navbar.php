<?php

require_once realpath(__DIR__ . '/component.php');

class Navbar extends Component
{

    private $sections = array();

    protected function render(...$sections)
    {
        ?>
    <header class="navbar">
        <?php $this::print(array_merge($sections, $this->sections)); ?>
    </header>
        <?php
    }

    public function addSections(...$sections)
    {
        array_push($this->sections, ...$sections);
    }

}
