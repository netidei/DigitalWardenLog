<?php

  class User {

    public static function hasUser ($db, $name) {
      $db->select('user', 'id', "username = \"$name\"");
      return $db->count() === 1;
    }

    public static function addUser ($db, $name, $password, $role) {
      if (self::hasUser($db, $name)) {
        die("Error: username - $name is already taken.");
      }
      $pass = password_hash($password, PASSWORD_DEFAULT);
      $role = self::normalizeRole($role);
      $columns = array('username', 'password', 'role');
      $values = array($name, $pass, $role);
      return $db->insert('user', $columns, $values);
    }

    public static function getByID ($db, $id) {
      $db->select('user', 'username', "id = \"$id\"");
      $user = $db->row();
      if ($db->count() && $user[0]) {
        return new User($db, $user[0]);
      }
      return null;
    }

    public static function fromSession ($db) {
      return new User($db, $_SESSION['username']);
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

    function __construct ($db, $name) {
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

    public function startSession () {
      session_start();
      $_SESSION["loggedin"] = true;
      $_SESSION["id"] = $this->id;
      $_SESSION["username"] = $this->username;
      $_SESSION["role"] = $this->role;
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