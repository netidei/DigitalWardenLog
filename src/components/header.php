<?php

require_once realpath(__DIR__ . '/component.php');

class PageHeader extends Component
{

    private const DATA = ['title', 'menuItems'=>array(), 'username', 'content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        $navbar = new Navbar([
            'content'=>new NavbarSection([
                'content'=>array_merge([
                    new ButtonLink([
                        'href'=>'index.php',
                        'content'=>'Digital Journal',
                        'class'=>'text-bold'
                    ])
                ], $menuItems)
            ])
        ]);
        if ($username) {
            $navbar->addSections(new NavbarSection([
                'content'=>[
                    new DefaultLink(array('href'=>'index.php', 'content'=>$username)),
                    new PrimaryLink(array('href'=>'logout.php', 'content'=>'Exit'))
                ]
            ]));
        }
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
                    self::print($navbar);
                    self::print($content);
    }
}