<?php

  require_once('./template/page.php');
  require_once('./includes/validator.php');

  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
      header("location: index.php");
      exit;
  }

  $username = $password = "";
  $username_err = $password_err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Validator::isEmpty($_POST["username"])){
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }      
    if (Validator::isEmpty($_POST["password"])) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
      $user = new User($username);
      if ($user->validatePassword($password)) {
        $user->startSession();
        header("location: index.php");
      } else {
        $password_err = "The password you entered was not valid.";
      }
    }
  }

  $page = new Page('Login page');
  $page->start();
  $page->FormBuilder(array(
    array('name' => 'username', 'label' => 'Имя', 'type' => 'text'),
    array('name' => 'password', 'label' => 'Пароль', 'type' => 'password'),
  ), 'Войти');
  $page->end();
?>
