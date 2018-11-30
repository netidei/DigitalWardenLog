<?php

require_once realpath(__DIR__ . '/../component.php');

class DefaultLink extends Component
{

    private const ATTRS = ['href'];

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['content']);
        $this->addClasses('btn');
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        ?>
        <a <?php $this->attributes($parameters, self::ATTRS); ?>>
            <?php self::print($content); ?>
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
