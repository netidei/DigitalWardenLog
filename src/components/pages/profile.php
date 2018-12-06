<?php

require_once realpath(__DIR__ . '/page.php');

class ProfilePage extends Page

{
    protected function content($props, $db, $user)
    {
        $data = $db->select('user', 'role', 'username ='.$user)->toArray();
        ?>
        <h1>Your Profile</h1>
        <div><p><?php self::Log($data); ?></div>
        <?php
    }

}

return new ProfilePage($db, $user, $data);