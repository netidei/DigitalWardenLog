<?php

  require_once('./includes/connection.php');

  class User {

    public static function hasUser ($name) {
      $db = new DB();
      $db->select('user', 'id', "username = \"$name\"");
      return $db->count() === 1;
    }

    public static function addUser ($name, $password, $role) {
      if (self::hasUser($name)) {
        die("Error: username - $name is already taken.");
      }
      echo $password;
      echo gettype($password);
      $pass = password_hash($password, PASSWORD_DEFAULT);
      $role = self::normalizeRole($role);
      $columns = array('username', 'password', 'role');
      $values = array($name, $pass, $role);
      $db = new DB();
      return $db->insert('user', $columns, $values);
    }

    private static function normalizeRole ($role) {
      if (is_numeric($role)) {
        return $role;
      }
      if (is_string($role)) {
        switch (mb_strtolower($role)) {
        case 'директорат':
          return 1;
        case 'преподаватель':
          return 2;
        default:
          return 3;
        }
      }
      die("Error with normalize role - $role");
    }

    private $id;
    private $username;
    private $hash;
    private $role;

    function __construct ($name) {
      $db = new DB();
      $db->select('user', '*', "username = \"$name\"");
      $user = $db->row();
      if ($db->count()) {
        $this->id = $user[0];
        $this->username = $user[1];
        $this->hash = $user[2];
        $this->role = $user[3];
      } else {
        die("Error: cannot find the user with this username - $name");
      }
    }

    public function validatePassword ($password) {
      if (password_verify($password, $this->hash)) {
        return true;
      }
      return false;
    }

    public function getID () {
      return $this->id;
    }

    public function getUsername () {
      return $this->username;
    }

    public function getRole () {
      return $this->role;
    }

  }

?>