<?php

require_once realpath(__DIR__ . '/../component.php');
require_once realpath(__DIR__ . '/../elements/layout/content.php');
require_once realpath(__DIR__ . '/../elements/layout/section.php');
require_once realpath(__DIR__ . '/../elements/form/links.php');

abstract class Page extends Component
{

    public function __construct($db, $user, $title = null)
    {
        parent::__construct([ 'title'=>$title ]);
        $this->update([
            'db'=>$db,
            'user'=>$user,
            'title'=>'Digital Journal'
        ]);
    }

    protected function header($props, $db, $user)
    {
        [$items] = self::define($props, ['items'=>array()]);
        $menu = new Content([ new Section([
            'content'=>array_merge([ new ButtonLink([
                'content'=>'Digital Journal',
                'attributes'=>[
                    'href'=>'index.php',
                    'class'=>['text-bold']
                ],
            ]) ], $items)
        ]) ]);
        if ($user) {
            $username = $user->getUsername();
            $menu->addContent(new Section([ 'content'=>[
                new DefaultLink(['content'=>$username, 'attributes'=>['href'=>'index.php']]),
                new PrimaryLink(['content'=>'Exit', 'attributes'=>['href'=>'index.php?page=logout']])
            ] ]));
        }
        ?>
        <header class="navbar">
            <?php self::print($menu, $props) ?>
        </header>
        <?php
    }

    abstract protected function content($props, $db, $user);

    protected function footer($props, $db, $user)
    {
        [$content] = self::define($props, ['content'=>array()]);
        ?>
        <footer>
            <?php self::print($content, $props); ?>
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
