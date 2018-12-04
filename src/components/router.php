<?php

require_once realpath(__DIR__ . '/../includes/connection.php');
require_once realpath(__DIR__ . '/../includes/user.php');
require_once realpath(__DIR__ . '/component.php');

class Router extends Component
{

    private static function createPage($db, $user, $name)
    {
        $path = realpath(__DIR__ . '/pages/' . ($name ? $name :'main') . '.php');
        if (file_exists($path)) {
            return require_once $path;
        }
        return require_once realpath(__DIR__ . '/pages/404.php');
    }

    private static function Page($db, $user = null, $name = null)
    {
        $openPages = ['register', 'logout', '404'];
        if ($user || in_array($name, $openPages)) {
            switch ($name) {
                case 'logout':
                    $_SESSION = array();
                    session_destroy();
                    return self::Page($db);
                default:
                    return self::createPage($db, $user, $name);
            }
        }
        return self::createPage($db, null, 'login');
    }

    public function __construct()
    {
        $db = new DB();
        $user = null;
        session_start();
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $user = User::fromSession($db);
        }
        parent::__construct();
        $this->define([
            'db'=>$db,
            'user'=>$user
        ]);
    }

    public function render($props, $db, $user)
    {
        [$page] = self::extract($props, ['page'=>null]);
        self::print(self::Page($db, $user, $page));
    }
}
