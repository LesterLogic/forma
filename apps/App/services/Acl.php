<?php
namespace forma\App\Services;

use forma\App\Models\User as User;

class Acl
{
    protected $di;
    protected $session;

    public function __construct($di) {
        $this->di = $di;
        $this->session = $di->get('session');
    }

    public function isLoggedIn() {

    }

    public function doLogin($username, $password) {
        $user = User::findFirst(Array("username='$username' AND password='$password'"));
        return $user;
    }

    public function doLogout() {

    }

    public function setSession($key, $value) {
        $this->session->set($key, $value);
    }
}