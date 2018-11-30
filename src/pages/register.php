<?php

require_once realpath(__DIR__ . './page.php');

class RegisterPage extends Page
{

    protected function content($props, $db, $user)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = self::POST('login');
            $password = self::POST('password');
            $role = self::POST('role');
            if ($username && $password) {
                User::addUser($db, $username, $password, $role);
                header('location: index.php?page=login');
            }
        }
        ?>
        <h1>Registration</h1>
        <form method="POST">
            <div class="form-group">
                <label class="form-label" for="loginInput">Login</label>
                <input class="form-input" type="text" name="login" id="loginInput" placeholder="Login">
            </div>
            <div class="form-group">
                <label class="form-label" for="passInput">Password</label>
                <input class="form-input" type="password" name="password" id="passInput">
            </div>
            <div class="form-group">
                <label class="form-label" for="roleInput">Role</label>
                <select class="form-select" id="roleInput" name="role">
                    <option value="0">Admin</option>
                    <option value="1">Директорат</option>
                    <option value="2">Преподаватель</option>
                    <option value="3">Староста</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Register">
        </form>
        <?php
    }
}