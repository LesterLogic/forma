<?php
namespace forma\App\Controllers;

class LoginController extends \Phalcon\Mvc\Controller
{
	public function indexAction() {
	    $security = $this->di->get('security');

        $this->view->pick("login/index");
	}

    public function loginAction() {

        $this->view->pick("login/login");
    }

    public function logoutAction() {
        $this->view->pick("login/logout");
    }
}
