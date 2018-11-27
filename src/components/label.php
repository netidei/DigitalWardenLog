<?php

require_once(realpath(__DIR__ . '/component.php'));

class Label extends Component {

  protected function render ($for, ...$content) {
?>
    <label <?php if ($for) { echo 'for="' . $for . '" '; } $this->classes(); ?> >
      <?php $this->print($content); ?>
    </label>
    <?php
  }

}