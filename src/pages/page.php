<?php

require_once realpath(__DIR__ . '/includes/connection.php');
require_once realpath(__DIR__ . '/includes/user.php');
require_once realpath(__DIR__ . '/component.php');
require_once realpath(__DIR__ . '/layout/header.php');
require_once realpath(__DIR__ . '/layout/menu.php');
require_once realpath(__DIR__ . '/layout/menuSection.php');
require_once realpath(__DIR__ . '/form/links.php');

abstract class Page extends Component
{

    public function __construct($parameters = array())
    {
        $db = new DB();
        session_start();
        $pos = in_array(self::GET('page'), ['login', 'register']);// is page available for unauthorized user
        if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
            header("location: index.php&page=login");
            exit;
        } elseif ($pos === false) {
            $user = User::fromSession($db);
        }
        $parameters['database'] = $db;
        $parameters['user'] = $user;
        parent::__construct($parameters);
        $this->addParameters(['title'=>'Digital Journal']);
    }
    
    protected function header($parameters)
    {
        extract(self::ext($parameters, ['menuItems'=>array(), 'menuSections'=>array()]));
        $menu = new Menu([
            'container'=>new Header(),
            'menuSections'=>[ new MenuSection([
                'content'=>array_merge([ new ButtonLink([
                    'href'=>'index.php',
                    'content'=>'Digital Journal',
                    'class'=>'text-bold'
                ]) ], $menuItems)
            ]) ]
        ]);
        $user = $this->getUser();
        $menu->addSections(...$menuSections);
        if ($username = $user ? $user->getUsername() : false) {
            $menu->addSections(new MenuSection([ 'content'=>[
                new DefaultLink(['href'=>'index.php', 'content'=>$username]),
                new PrimaryLink(['href'=>'logout.php', 'content'=>'Exit'])
            ] ]));
        }
        self::print($menu);
    }

    abstract protected function content($parameters);

    protected function footer($parameters)
    {
        extract(self::ext($parameters, ['footer']));
        ?>
        <footer>
            <?php self::print($footer) ?>
        </footer>
        <?php
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
                    <?php
                        $this->header($parameters);
                        $this->content($parameters);
                        $this->footer($parameters);
                    ?>
                </div>
            </body>
        </html>
        <?php
    }

    public function getDatabase()
    {
        return $this->parameters['database'];
    }

    public function getUser()
    {
        return isset($this->parameters['user']) ? $this->parameters['user'] : null;
    }
}
