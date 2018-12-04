<?php

require_once realpath(__DIR__ . '/page.php');

class EmptyPage extends Page
{

    protected function content($props, $db, $user)
    {
        ?>
        <div class="empty">
            <div class="empty-icon">
                <i class="icon icon-search"></i>
            </div>
            <p class="empty-title h3">404 Error</p>
            <p class="empty-subtitle">Something went wrong</p>
            <div class="empty-action">
                <a class="btn btn-primary" href="index.php">Return to Home</a>
            </div>
        </div>
        <?php
    }
}

return new EmptyPage($db, $user, $name);
