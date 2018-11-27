<?php

require_once realpath(__DIR__ . '/component.php');

class FormBuilder extends Component
{

    protected function render($for, ...$content)
    {
        ?>
    <form method="POST" class="<?php $this->classes(); ?>">
    </form>
        <?php
    }

}