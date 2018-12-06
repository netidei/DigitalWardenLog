<?php
require_once realpath(__DIR__ . '/page.php');

class DirectoratePage extends Page
{
    protected function content($props, $db, $user)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = self::POST('login');
            $password = self::POST('password');
            $role = self::POST('role');
            if ($username && $password) {
                User::addUser($db, $username, $password, $role);
                header('location: index.php?page=directorate');
            }

        }
        ?>
        <h1>Add new user</h1>
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
                    <option value="1">Директорат</option>
                    <option value="2">Преподаватель</option>
                    <option value="3">Староста</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Register"> <br>
        </form>
        <?php
    


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = self::POST('name');
                $db->delete("user","username=\"".$name."\"");
                header('location: index.php?page=directorate');
        }
        $res = $db->select('user','*');
        while ($row=$res->row()){
            echo $row[1];
        ?>
        <input class="form-input" type="text" name="name" value=<?php echo $row[1]?>>
        <form method="POST">
        <input class="btn btn-primary" type="submit" value="Delete"> <br>
        </form>
        <?php
        
        }
    }
}
return new DirectoratePage($db, $user, $data); 