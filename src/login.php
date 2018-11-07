  <?php

  require_once('./includes/validator.php');
  require_once('./includes/user.php');

  session_start();
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
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user->getID();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["role"] = $user->getRole();
        header("location: index.php");
      } else {
        $password_err = "The password you entered was not valid.";
      }
    }
  }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Вход</h2>
        <form method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
</body>
</html>