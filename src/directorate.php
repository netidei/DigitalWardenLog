<?php
  require_once(realpath('./includes/validator.php'));
  require_once(realpath('./includes/user.php'));
  require_once(realpath('./components/formBuilder.php'));
  require_once(realpath('./includes/page.php'));
  
  $page = new Page();

  
  // TODO: Add some methods to Validator class to reduce this code
  $username = $password = "";
  $username_err = $password_err = "";
  $role = null;
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $role = trim($_POST["role"]);
    if($username && $password) {
      User::addUser($page->getDatabase(), $username, $password, $role);
      header("location: login.php");
    }
  }
  
  $page->init('Registration', array('add'=>'adduser.php'));
  
?>

<h1>Directorate page</h1>
<?php
  
  $page->build();
 ?>