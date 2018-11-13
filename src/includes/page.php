<?php

  require_once(__DIR__ . '\\connection.php');
  require_once(__DIR__ . '\\user.php');
  require_once(__DIR__ . '\\..\\components\\button\\link.php');

  class Page {

    public static function printList ($list) {
      if ($list and count($list) > 0) {
        foreach ($list as $item) {
          echo $item;
        }
      }
    }

    public static function showMenu ($menuItems) {
      if ($menuItems && count($menuItems) > 0) {
        foreach ($menuItems as $text=>$link);
          LinkButton($text, $link);
      }
    }

    private $database;
    private $user;

    function __construct() {
      $this->database = new DB();
      session_start();
      $pos = strpos($_SERVER['REQUEST_URI'], '/login.php');
      if ($pos === false) {
        $pos = strpos($_SERVER['REQUEST_URI'], '/register.php');
      }
      if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
        header("location: login.php");
        exit;
      } elseif ($pos === false) {
        $this->user = User::fromSession($this->database);
      }
    }

    public function getUser() {
      return $this->user;
    }

    public function getDatabase () {
      return $this->database;
    }

    public function init ($title, $menuItems = null, $menuSections = null) {
      $username = $this->user ? $this->user->getUsername() : null;
      require(__DIR__ . '\\page\\header.php');
    }

    public function build ($footer = null) {
      require(__DIR__ . '\\page\\footer.php');
    }

  }

?>