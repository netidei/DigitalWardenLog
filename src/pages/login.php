<?php
    require_once realpath(__DIR__ . './page.php');
    require_once realpath(__DIR__ . './form/form.php');

class LoginPage extends Page
{

    protected function content($parameters)
    {
        $db = $this->getDatabase();
        $form = new Form([
            'method'=>'POST',
            'content'=> function ($parameters) { ?>
                <div class="form-group">
                    <label class="form-label" for="loginInput">Login</label>
                    <input class="form-input" type="text" name="login" id="loginInput" placeholder="Login">
                </div>
                <div class="form-group">
                    <label class="form-label" for="passInput">Password</label>
                    <input class="form-input" type="password" name="password" id="passInput">
                </div>
                <input class="btn btn-primary" type="submit" value="Log in">
            <?php }
        ]);
        
        $err = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = self::POST('login');
            $password = self::POST('password');
            if ($username && $password) {
                // Prepare a select statement
                $user = new User($db, $username);
                try {
                    if ($user->validatePassword($password)) {
                        $user->startSession();
                        header("location: index.php");
                    }
                } finally {
                    $err = "The login or password is invalid.";
                }
            } else {
                $err = 'Enter login and password';
            }
        }

        ?>
        <h1>Log in</h1>
        <?php self::print($form);
        echo($err);
    }
}