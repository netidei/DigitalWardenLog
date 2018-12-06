<?php
require_once realpath('./components/component.php');
require_once realpath('./components/router.php');
$router = new Router();
$props = [
    'page'=>Component::GET('page')
];
Component::print($router, $props);