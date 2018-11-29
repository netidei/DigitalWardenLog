<?php

require_once realpath(__DIR__ . '/../includes/connection.php');
require_once realpath(__DIR__ . '/../includes/user.php');
require_once realpath(__DIR__ . '/../component.php');

class Page extends Component
{

    public function __construct($parameters = array())
    {
        $parameters['database'] = new DB();
        session_start();
        $pos = strpos($_SERVER['REQUEST_URI'], '/login.php');
        if ($pos === false) {
            $pos = strpos($_SERVER['REQUEST_URI'], '/register.php');
        }
        if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
            header("location: login.php");
            exit;
        } elseif ($pos === false) {
            $parameters['user'] = User::fromSession($parameters['database']);
        }
        parent::__construct($parameters);
        $this->addParameters(['title'=>'Digital Journal', 'content'=>array(), 'header', 'footer']);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        ?>
        <html>
            <head>
                <meta charset="utf-8">
                <title><?= $title ?></title>
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
                <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
                <link rel="stylesheet" type="text/css" href="./styles/main.css">
            </head>
            <body>
                <div class="container">
                    <?php self::print($content); ?>
                </div>
            </body>
        </html>
        <?php
    }

    /*public function header($parameters = array())
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
    }*/

    public function getDatabase()
    {
        return $this->parameters['database'];
    }

    public function getUser()
    {
        return isset($this->parameters['user']) ? $this->parameters['user'] : null;
    }
}
