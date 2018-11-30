<?php
    require_once realpath(__DIR__ . './page.php');

class LoginPage extends Page
{

    protected function content($parameters)
    {
        $db = $this->getDatabase();
        $err = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = self::POST('login');
            $password = self::POST('password');
            if ($username && $password) {
                try {
                    $user = new User($db, $username);
                    if ($user->validatePassword($password)) {
                        $user->startSession();
                        header("Location: index.php");
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
        <form method="POST">
            <div class="form-group">
                <label class="form-label" for="loginInput">Login</label>
                <input class="form-input" type="text" name="login" id="loginInput" placeholder="Login">
            </div>
            <div class="form-group">
                <label class="form-label" for="passInput">Password</label>
                <input class="form-input" type="password" name="password" id="passInput">
            </div>
            <?php if ($err) { echo $err . '<br/>'; } ?>
            <input class="btn btn-primary" type="submit" value="Log in">
            
        </form>
        <?php
    }
}