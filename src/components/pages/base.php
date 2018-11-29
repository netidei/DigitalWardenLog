<?php

require_once realpath(__DIR__ . '/page.php');

class BasePage extends Page
{

    public function __construct($parameters)
    {
        parent::__construct($parameters);
        $this->addParameters(['header', 'footer']);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        $parameters['content'] = [$header, $content, $footer];
        parent::render($parameters);
    }
}
