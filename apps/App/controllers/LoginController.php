<?php
namespace forma\App\Controllers;

use forma\App\Forms\LoginForm,
    forma\User\Models\User as User;

class LoginController extends \Phalcon\Mvc\Controller
{
	public function indexAction() {
	    $acl = $this->di->get('acl');
        $form = new LoginForm();
        $vars = Array(
            'title'=>'Login Controller Index',
            'metaDescription'=>'Login Controller Index Meta Description',
        );

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $username = $this->request->getPost('login-username');
                $password = $this->request->getPost('login-password');

                $user = User::findFirst();
                //$response = $acl->doLogin($username, $password);
                print_r($user);
                die();
            }
        }

        $this->view->setVars($vars);
        $this->view->form = $form;
        $this->view->pick("login/index");
	}

    public function loginAction() {
        $security = $this->di->get('security');
        $username = $_POST['login-username'];
        $password = $_POST['login-password'];
        try {
            $security->doLogin($username, $password);

        } catch (\Exception $e) {

        }

        $this->view->pick("login/login");
    }

    public function logoutAction() {
        $this->view->pick("login/logout");
    }
}
