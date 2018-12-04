<?php

require_once realpath(__DIR__ . '/../component.php');

abstract class Page extends Component
{

    private $name;

    public function __construct($db, $user, $data)
    {
        parent::__construct();
        $this->define([
            'db'=>$db,
            'user'=>$user,
            'title'=>$data['title']
        ]);
        $this->name = $data['name'];
    }

    protected function header($props, $db, $user)
    {
        [$items, $itemsProps] = self::extract($props, ['items'=>array(), 'itemsProps'=>array()]);
        $role = $user ? $user->getRole() : 4;
        $pages = array();
        $pagesData = $db->select('page', '*', '`role` > 2')->toArray();
        foreach ($pagesData as $page) {
            if ($page[4] == '0') {
                array_push($pages, $page);
            } else {
                $access = $db->select('access_list', '*', '`page` = ' . $page[0] . ' and (`role` = 0 or `role` = '. $role .')')->count() > 0;
                if ($role == '0' || $page[4] == '1' && $access || $page[4] == '2' && !$access) {
                    array_push($pages, $page);
                }
            }
        }
        ?>
        <header class="navbar">
            <section class="navbar-section">
                <?php
                    foreach ($pages as $page) {
                        $name = $page[1];
                        $title = $page[2];
                        ?>
                            <a class="btn btn-link <?php if ($name === $this->name) { echo 'text-bold'; } ?>" href="index.php?page=<?= $name ?>"><?= $title ?></a>
                        <?php
                    }
                    self::print($items, $itemsProps);
                ?>
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
