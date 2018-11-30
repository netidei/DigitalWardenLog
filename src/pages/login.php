<?php
    require_once realpath('./page.php');

class MainPage extends Page
{

    protected function content($parameters)
    {
        $db = $this->getDatabase();
        
        ?>
        <h1>Log in</h1>
        <?php self::print($form) ?>
        <?php
    }
}