<?php

require_once(realpath(__DIR__ . '/component.php'));

class DefaultLink extends Component {

  public function __construct (...$data) {
    parent::__construct(...$data);
    $this->addClasses('btn');
  }

  protected function render ($link, ...$content) { ?>
    <a <?php $this->classes(); ?> href="<?php echo $link ?>"><?php $this->print($content); ?></a>
    <?php
  }

}

class ButtonLink extends DefaultLink {

  public function __construct (...$data) {
      parent::__construct(...$data);
      $this->addClasses('btn-link');
  }

}

class PrimaryLink extends DefaultLink {

  public function __construct (...$data) {
      parent::__construct(...$data);
      $this->addClasses('btn-primary');
  }

}
