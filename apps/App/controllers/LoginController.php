<?php
namespace forma\App\Controllers;

use forma\App\Forms\LoginForm;

class LoginController extends \Phalcon\Mvc\Controller
{
	public function indexAction() {
        if ($this->session->has('user-id')) {
            $this->response->redirect('app');
        }

	    $acl = $this->di->get('acl');
        $form = new LoginForm();
        $vars = Array(
            'title'=>'Login Controller Index',
            'metaDescription'=>'Login Controller Index Meta Description',
            'login'=>'',
        );

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $username = $this->request->getPost('login-username');
                $password = $this->request->getPost('login-password');

                $user = $acl->doLogin($username, $password);
                if ($user !== FALSE) {
                    $acl->setSession('user-id', $user->getId());
                    $this->response->redirect('app/select');
                } else {
                    $this->flash->error("No user found.");
                }
            }
        }

        $this->view->setVars($vars);
        $this->view->form = $form;
        $this->view->pick("login/index");
	}

    public function logoutAction() {
        $this->session->remove('user-id');

        $this->view->pick("login/logout");
    }
}
