<?php

require_once(realpath(__DIR__ . '/component.php'));

class Input extends Component {

  protected function render ($properties) {
?>
    <input <?php
      foreach ($properties as $name=>$value) {
        switch ($name) {
        case 'class':
          $this->addClasses($value);
          break;
        default:
          echo $property . '="' . $value . '" ';
        }
      }
    $this->classes(); ?> />
<?php
  }

}
