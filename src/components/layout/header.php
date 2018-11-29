<?php
require_once realpath(__DIR__ . '/../component.php');

class Header extends Component
{

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->addParameters(['content'=>array()]);
    }

    protected function render($parameters)
    {
        extract($this->safe($parameters));
        ?>
        <header <?php $this->attributes($parameters) ?>>
            <?php self::print($content); ?>
        </header>
        <?php
    }
}