<?php

  require_once(realpath(__DIR__ . '/connection.php'));
  require_once(realpath(__DIR__ . '/user.php'));
  require_once(realpath(__DIR__ . '/../components/links.php'));
  require_once(realpath(__DIR__ . '/../components/navbarSection.php'));
  require_once(realpath(__DIR__ . '/../components/navbar.php'));

class Page
{
    private $database;
    private $user;

    public function __construct()
    {
        $this->database = new DB();
        session_start();
        $pos = strpos($_SERVER['REQUEST_URI'], '/login.php');
        if ($pos === false) {
            $pos = strpos($_SERVER['REQUEST_URI'], '/register.php');
        }
        if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
            header("location: login.php");
            exit;
        } elseif ($pos === false) {
            $this->user = User::fromSession($this->database);
        }
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function init($title, ...$menuItems)
    {
        $logo = new ButtonLink('Digital Journal', 'index.php');
        $logo->addClasses('text-bold');
        $navbar = new Navbar(new NavbarSection($logo, ...$menuItems));
        $username = $this->user ? $this->user->getUsername() : null;
        if ($username) {
            $user = new ButtonLink($username, '/');
            $user->addClasses('text-bold');
            $navbar->addSections(new NavbarSection($user, new DefaultLink('Exit', 'logout.php')));
        }
        require(realpath(__DIR__ . '/page/header.php'));
    }

    public function build($footer = null)
    {
        require(realpath(__DIR__ . '/page/footer.php'));
    }
}
