<?php

require_once realpath(__DIR__ . '/../includes/connection.php');
require_once realpath(__DIR__ . '/../includes/user.php');
require_once realpath(__DIR__ . '/component.php');

class Router extends Component
{

    private static function createPage($db, $user, $name)
    {
        $page = null;
        try {
            $page = @include_once realpath(__DIR__ . ($name ? "/pages/$name.php" : '/pages/main.php'));
        } finally {
            if (!$page) {
                $page = require_once realpath(__DIR__ . '/pages/404.php');
            }
        }
        return $page;
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
        $this->update([
            'db'=>$db,
            'user'=>$user
        ]);
    }

    public function render($props, $db, $user)
    {
        [$page] = self::define($props, ['page'=>null]);
        self::print(self::Page($db, $user, $page));
    }
}
