<?php

require_once realpath(__DIR__ . '/page.php');

class LogoutPage extends Page
{

    protected function content($props, $db, $user)
    {
    }

    protected function render($props, $db, $user, $title)
    {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }
}

return new LogoutPage($db, $user, 'Logout page');
