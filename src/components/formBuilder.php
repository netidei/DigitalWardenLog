<?php

require_once realpath(__DIR__ . '/component.php');

class FormBuilder extends Component
{

    protected function render($parameters)
    {
        ?>
        <form method="POST" <?php $this->data($parameters); ?>>
        </form>
        <?php
    }
}