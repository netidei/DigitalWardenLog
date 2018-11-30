<?php

require_once realpath(__DIR__ . '/includes/connection.php');
require_once realpath(__DIR__ . '/includes/user.php');
require_once realpath(__DIR__ . '/component.php');
require_once realpath(__DIR__ . '/layout/menu.php');
require_once realpath(__DIR__ . '/layout/menuSection.php');
require_once realpath(__DIR__ . '/form/links.php');

abstract class Page extends Component
{

    public function __construct($props = array())
    {
        $db = new DB();
        $user = null;
        session_start();
        $pos = in_array(self::GET('page'), ['login', 'register']);// is page available for unauthorized user
        if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && !$pos) {
            header("location: index.php?page=login");
            exit;
        } elseif ($pos === false) {
            $user = User::fromSession($db);
        }
        parent::__construct($props);
        $this->define([
            'title'=>'Digital Journal',
            'db'=>$db,
            'user'=>$user
        ]);
    }

    protected function header($props, $db, $user)
    {
        [$menuItems] = self::extract($props, ['menuItems'=>array()]);
        $menu = new Menu([
            'menuSections'=>[ new MenuSection([
                'content'=>array_merge([ new ButtonLink([
                    'content'=>'Digital Journal',
                    'attributes'=>[
                        'href'=>'index.php',
                        'class'=>['text-bold']
                    ],
                ]) ], $menuItems)
            ]) ]
        ]);
        if ($user) {
            $username = $user->getUsername();
            $menu->addSections(new MenuSection([ 'content'=>[
                new DefaultLink(['content'=>$username, 'attributes'=>['href'=>'index.php']]),
                new PrimaryLink(['content'=>'Exit', 'attributes'=>['href'=>'index.php?page=logout']])
            ] ]));
        }
        ?>
            <header class="navbar">
                <?php self::print($menu) ?>
            </header>
        <?php
    }

    abstract protected function content($props, $db, $user);

    protected function footer($props, $db, $user)
    {
        ?>
        <footer></footer>
        <?php
    }

    protected function render($props, $title, $db, $user)
    {
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
                        $this->header($props, $db, $user);
                        $this->content($props, $db, $user);
                        $this->footer($props, $db, $user);
                    ?>
                </div>
            </body>
        </html>
        <?php
    }
}
