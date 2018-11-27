<?php

require_once realpath(__DIR__ . '/component.php');

class DefaultLink extends Component
{

    private const ATTRS = array('href');

    public function __construct($data)
    {
        parent::__construct($data);
        $this->addClasses('btn');
    }

    protected function render($parameters)
    {
        ?>
        <a <?php $this->data($parameters, self::ATTRS); ?>>
            <?php $this->print($parameters['content']); ?>
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
