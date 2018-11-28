<?php

require_once realpath(__DIR__ . '/includes/connection.php');
require_once realpath(__DIR__ . '/includes/user.php');
require_once realpath(__DIR__ . '/component.php');
require_once realpath(__DIR__ . '/links.php');
require_once realpath(__DIR__ . '/navbarSection.php');
require_once realpath(__DIR__ . '/navbar.php');
require_once realpath(__DIR__ . '/header.php');
require_once realpath(__DIR__ . '/footer.php');

class Page extends Component
{

    private const DATA = ['content'];

    private $database;
    private $user;

    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        $this->database = new DB();
        session_start();
        $pos = strpos($_SERVER['REQUEST_URI'], '/login.php');
        if ($pos === false) {
            $pos = strpos($_SERVER['REQUEST_URI'], '/register.php');
        }
        if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && ($pos === false)) {
            header("location: login.php");
            exit;
        } elseif ($pos === false) {
            $this->user = User::fromSession($this->database);
        }
    }

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        self::print($content, $parameters);
    }

    public function header($parameters = array())
    {
        $parameters['username'] = $this->user ? $this->user->getUsername() : null;
        $this->build(['content'=>new PageHeader($parameters)]);
    }

    public function footer($parameters = array())
    {
        $this->build(['content'=>new PageFooter($parameters)]);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
