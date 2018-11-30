<?php
require_once realpath('./pages/component.php');

function getPage($name)
{
    switch ($name) {
        case 'logout':
            session_start();
            $_SESSION = array();
            session_destroy();
        case 'login':
            require_once realpath('./pages/login.php');
            return new LoginPage(['title'=>'Login page']);
        default:
            require_once realpath('./pages/main.php');
            return new MainPage(['title'=>'Main page']);
    }
}

$page = getPage(Component::GET('page'));
Component::print($page);
