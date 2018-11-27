<?php

require_once realpath(__DIR__ . '/connection.php');
require_once realpath(__DIR__ . '/user.php');
require_once realpath(__DIR__ . '/../components/links.php');
require_once realpath(__DIR__ . '/../components/navbarSection.php');
require_once realpath(__DIR__ . '/../components/navbar.php');

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
        $logo = array(new ButtonLink(array('href'=>'index.php', 'content'=>'Digital Journal', 'class'=>'text-bold')));
        if (count($menuItems) > 0) {
            array_push($logo, $menuItems);
        }
        $menu = new NavbarSection(array('content'=>$logo));
        $navbar = new Navbar(array('content'=>$menu));
        $username = $this->user ? $this->user->getUsername() : null;
        if ($username) {
            $user = new DefaultLink(array('href'=>'index.php', 'content'=>$username));
            $exit = new PrimaryLink(array('href'=>'logout.php', 'content'=>'Exit'));
            $navbar->addSections(new NavbarSection(array('content'=>array($user, $exit))));
        }
        include realpath(__DIR__ . '/page/header.php');
    }

    public function build($footer = null)
    {
        include realpath(__DIR__ . '/page/footer.php');
    }
}
