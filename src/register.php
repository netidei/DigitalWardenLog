<?php

  require_once('./includes/validator.php');
  require_once('./includes/user.php');
  // TODO: Add some methods to Validator class to reduce this code
  $username = $password = "";
  $username_err = $password_err = "";
  $role = null;

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(Validator::isEmpty($_POST["username"])) {
      $username_err = "Please enter a username.";
    } else {
      $username = trim($_POST["username"]);
    }
    if(Validator::isEmpty($_POST["password"])) {
      $password_err = "Please enter a password.";
    } else {
      $password = trim($_POST["password"]);
    }
    $role = trim($_POST["role"]);
    if(empty($username_err) && empty($password_err)) {
      User::addUser($username, $password, $role);
    }
  }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form method="POST">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
              <select name="role">
                <option value="1">Директорат</option>
                <option value="2">Преподаватель</option>
                <option value="3">Староста</option>
              </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>