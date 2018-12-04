<?php

require_once realpath(__DIR__ . '/../includes/connection.php');
require_once realpath(__DIR__ . '/../includes/user.php');
require_once realpath(__DIR__ . '/component.php');

class Router extends Component
{

    public function __construct()
    {
        parent::__construct();
        $db = new DB();
        $user = null;
        session_start();
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $user = User::fromSession($db);
        }
        $this->define([
            'db'=>$db,
            'user'=>$user
        ]);
    }

    private function hasAccess($data)
    {
        $role = $this->state['user'] ? $this->state['user']->getRole() : 4;
        if ($role == '0' || $data[3] == '0') {
            return true;
        } elseif ($role == '4') {
            return false;
        }
        $list = array();
        $listData = $this->state['db']->select('access_list', '`role`', '`page` = ' . $data[0]);
        while ($row = $listData->row()) {
            array_push($list, $row[0]);
        }
        $inList = in_array($role, $list) || (count($list) > 0 && $list[0] == '0');
        return $data[3] == '1' ? $inList : !$inList;
    }

    private function getPage($where)
    {
        $pageData = $this->state['db']->select('page', '*', $where);
        if ($pageData->count() > 0) {
            $data = $pageData->row();
            if ($this->hasAccess($data)) {
                return $data;
            } else {
                return $this->getPageByRole(1); // Login page
            }
        }
        return $this->getPageByRole(0); // 404 page
    }

    private function getPageByRole($role)
    {
        return $this->getPage('`role` = ' . $role);
    }

    private function getPageByName($name)
    {
        return $this->getPage('`name` = "' . $name . '"');
    }

    protected function render($props, $db, $user)
    {
        [$page] = self::extract($props, ['page'=>null]);
        $data = $page ? $this->getPageByName($page) : $this->getPageByRole(3); // Default page
        $name = $data[1];
        $path = realpath(__DIR__ . "/pages/$name.php");
        self::print(require_once $path);
    }
}
