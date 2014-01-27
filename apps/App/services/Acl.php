<?php
namespace forma\App\Services;

use forma\App\Models\Users;

class Acl
{
    protected $di;
    protected $session;
    protected $response;

    public function __construct($di) {
        $this->di = $di;
        $this->session = $di->get('session');
        $this->response = $di->get('response');
    }

    public function isLoggedIn() {
        return $this->session->has('user-id');
    }

    public function doLogin($username, $password) {
        $user = Users::findFirst(Array("username='$username' AND password='$password'"));
        if ($user !== FALSE) {
            $user->setLdate();
            $user->save();
        }

        return $user;
    }

    public function setSession($key, $value) {
        $this->session->set($key, $value);
    }
}