<?php

require_once realpath(__DIR__ . '/../component.php');

abstract class Page extends Component
{

    public function __construct($db, $user, $title = null)
    {
        parent::__construct([ 'title'=>$title ]);
        $this->define([
            'db'=>$db,
            'user'=>$user,
            'title'=>'Digital Journal'
        ]);
    }

    protected function header($props, $db, $user)
    {
        [$items, $itemsProps] = self::extract($props, ['items'=>array(), 'itemsProps'=>array()]);
        ?>
        <header class="navbar">
            <section class="navbar-section">
                <a class="btn btn-link text-bold" href="index.php">Digital Journal</a>
                <?php self::print($items, $itemsProps); ?>
            </section>
            <?php if ($user) { ?>
                <section class="navbar-section">
                    <a class="btn" href="index.php"><?= $user->getUsername() ?></a>
                    <a class="btn btn-primary" href="index.php?page=logout">Exit</a>
                </section>
            <?php } ?>
        </header>
        <?php
    }

    abstract protected function content($props, $db, $user);

    protected function footer($props, $db, $user)
    {
        [$content, $contentProps] = self::extract($props, ['content'=>array(), 'contentProps'=>array()]);
        ?>
        <footer>
            <?php self::print($content, $contentProps); ?>
        </footer>
        <?php
    }

    protected function render($props, $db, $user, $title)
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
                        [$header, $content, $footer] = self::extract($props, ['header'=>array(), 'content'=>array(), 'footer'=>array()]);
                        $this->header($header, $db, $user);
                        $this->content($content, $db, $user);
                        $this->footer($footer, $db, $user);
                    ?>
                </div>
            </body>
        </html>
        <?php
    }
}
