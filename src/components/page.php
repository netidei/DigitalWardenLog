<?php

require_once realpath(__DIR__ . '/includes/connection.php');
require_once realpath(__DIR__ . '/includes/user.php');
require_once realpath(__DIR__ . '/partedComponent.php');
require_once realpath(__DIR__ . '/form/links.php');
require_once realpath(__DIR__ . '/layout/navbarSection.php');
require_once realpath(__DIR__ . '/layout/navbar.php');
require_once realpath(__DIR__ . '/page/header.php');
require_once realpath(__DIR__ . '/page/footer.php');

class Page extends PartedComponent
{

    private const DATA = ['menuItems'=>array()];

    private $database;
    private $user;

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
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

    public function header($parameters = array())
    {
        extract(self::safe($parameters, self::DATA));
        $navbar = new Navbar([
            'content'=>new NavbarSection([
                'content'=>array_merge([ new ButtonLink([
                    'href'=>'index.php',
                    'content'=>'Digital Journal',
                    'class'=>'text-bold'
                ]) ], $menuItems)
            ])
        ]);
        if ($username = $this->user ? $this->user->getUsername() : false) {
            $navbar->addSections(new NavbarSection([
                'content'=>[
                    new DefaultLink(['href'=>'index.php', 'content'=>$username]),
                    new PrimaryLink(['href'=>'logout.php', 'content'=>'Exit'])
                ]
            ]));
        }
        $parameters['content'] = $navbar;
        $this->build(['content'=>new PageHeader($parameters)]);
    }

    public function footer($parameters = array())
    {
        $this->build(['content'=>new PageFooter($parameters)]);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
