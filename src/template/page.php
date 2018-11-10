<?php

  require_once(__DIR__ . '\\..\\includes\\user.php');

  class Page {

    private static function print ($data) {
      echo $data;
    }

    private static function printList ($list) {
      if ($list and count($list) > 0) {
        foreach ($list as $item) {
          self::print($item);
        }
      }
    }

    private $title;
    private $menuItems;
    private $menuSections;
    private $content;
    private $footer;
    private $user;

    function __construct($title) {
      session_start();
      $pos = strpos($_SERVER['REQUEST_URI'], '/login.php');
      if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
        header("location: login.php");
        exit;
      } elseif ($pos === false) {
        $this->user = User::fromSession();
      }
      $this->title = $title;
      $this->menuItems = array();
      $this->menuSections = array();
    }

    public function getUser() {
      return $this->user;
    }

    public function setTitle ($title) {
      $this->title = $title;
    }

    public function addMenuItems (...$items) {
      array_push($this->$menuItems, ...$items);
    }

    public function addMenuSections ($sections) {
      array_push($this->$menuSections, ...$sections);
    }

    public function setContent ($content) {
      $this->content = $content;
    }

    public function setFooter ($footer) {
      $this->footer = $footer;
    }

    /* Template interface */

    public function Title () {
      self::print($this->title);
    }

    public function MenuItems () {
      self::printList($this->menuItems);
    }

    public function MenuSections () {
      self::printList($this->menuSections);
    }

    public function Content () {
      if ($this->content) {
        self::print($this->content);
      }
    }

    public function Footer () {
      if ($this->footer) {
        self::print($this->footer);
      }
    }

    public function ProfileSection () {
      if($this->user) {
        $login = $this->user->getUsername();
        require(__DIR__ . '\\components\\profileSection.php');
      }
    }

    public function FormBuilder ($inputs, $submit) {
      require(__DIR__ . '\\components\\formBuilder.php');
    }

    public function start () {
      $page = $this;
      require(__DIR__ . '\\components\\start.php');
    }

    public function end () {
      $page = $this;
      require(__DIR__ . '\\components\\end.php');
    }

  }

?>