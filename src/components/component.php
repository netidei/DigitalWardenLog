<?php

abstract class Component {
  
  private $data;
  private $classes = array();

  protected static function print ($elements, ...$data) {
    foreach ($elements as $element) {
      if ($element instanceof Component) {
        $element->build(...$data);
      } elseif (gettype($element) == 'string') {
        echo($element);
      }
    }
  }

  public function __construct (...$data) {
    $this->data = $data;
  }

  public function classes (...$classes) {
    if (count($this->classes) > 0) {
    echo 'class="' . implode(' ', array_merge($this->classes, $classes)) . '" ';
    }
  }

  public function addClasses (...$classes) {
    array_push($this->classes, ...$classes);
  }

  public function build (...$userData) {
    $this->render(...$this->data, ...$userData);
  }

}
