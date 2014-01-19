<?php
namespace forma\App\Services;

use Phalcon\Mvc\Model\Query;

class Acl
{
    protected $di;

    public function __construct($di) {
        $this->di = $di;
    }

    public function isLoggedIn() {

    }

    public function doLogin($username, $password) {
        $query = new Phalcon\Mvc\Model\Query('SELECT * FROM Users', $this->di);
        $users = $query->execute();
        print_r($users);
        die();
    }

    public function doLogout() {

    }
}