<?php

require_once realpath(__DIR__ . '/base.php');
require_once realpath(__DIR__ . './../layout/header.php');
require_once realpath(__DIR__ . './../layout/menu.php');
require_once realpath(__DIR__ . './../layout/menuSection.php');
require_once realpath(__DIR__ . './../form/links.php');

class WrappedPage extends BasePage
{

    public function __construct($parameters)
    {
        parent::__construct($parameters);
        $this->addParameters(['menuItems'=>array()]);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        $menu = new Menu([
            'container'=>new Header(),
            'sections'=>new MenuSection([
                'content'=>array_merge([ new ButtonLink([
                    'href'=>'index.php',
                    'content'=>'Digital Journal',
                    'class'=>'text-bold'
                ]) ], $menuItems)
            ])
        ]);
        $user = $this->getUser();
        if ($usernam = $this->user ? $this->user->getUsername() : false) {
            $menu->addSections(new MenuSection([
                'content'=>[
                    new DefaultLink(['href'=>'index.php', 'content'=>$username]),
                    new PrimaryLink(['href'=>'logout.php', 'content'=>'Exit'])
                ]
            ]));
        }
        $parameters['header'] = $menu;
        $parameters['footer'] = null;
        parent::render($parameters);
    }
}
