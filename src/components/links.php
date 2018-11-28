<?php

require_once realpath(__DIR__ . '/component.php');

class DefaultLink extends Component
{

    private const ATTRS = ['href'];
    private const DATA = ['content'];

    public function __construct($parameters)
    {
        parent::__construct($parameters);
        $this->addClasses('btn');
    }

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
        <a <?php $this->attributes($parameters, self::ATTRS); ?>>
            <?php $this->print($content); ?>
        </a>
        <?php
    }
}

class ButtonLink extends DefaultLink
{

    public function __construct(...$data)
    {
        parent::__construct(...$data);
        $this->addClasses('btn-link');
    }
}

class PrimaryLink extends DefaultLink
{

    public function __construct(...$data)
    {
        parent::__construct(...$data);
        $this->addClasses('btn-primary');
    }
}
