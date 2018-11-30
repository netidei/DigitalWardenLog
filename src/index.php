<?php
require_once realpath('./pages/component.php');
$page = Component::GET('page');

switch ($page) {
    case 'login':
        break;
    default:
        require_once realpath('./pages/main.php');
        $main = new MainPage(['title'=>'Main page']);
        Component::print($main);
}
