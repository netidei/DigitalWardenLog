<?php

require_once(realpath(__DIR__ . '/component.php'));

class DefaultLink extends Component
{
    protected function render($text, $link)
    {
        ?>
      <a class="btn <?php $this->classes(); ?>" href="<?php echo $link ?>"><?php echo $text ?></a>
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
