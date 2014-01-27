<?php
namespace forma\App\Controllers;

use forma\App\Forms\login\LoginForm,
    forma\App\Forms\login\CreateForm,
    forma\App\Models\Users as User;

class LoginController extends \Phalcon\Mvc\Controller
{
    protected $acl;

    public function beforeExecuteRoute() {
        $this->acl = $this->di->get('acl');
    }

    public function createAction() {
        if ($this->acl->isLoggedIn()) {
            $this->dispatcher->forward(array(
                'controller'=>'app',
                'action'=>'index'
            ));
        }

        $form = new CreateForm();
        $vars = Array(
            'title'=>'Account Create',
            'metaDescription'=>'',
        );

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $username = $this->request->getPost('login-username');
                $password = $this->request->getPost('login-password');
                $display = $this->request->getPost('login-display');
                $display = empty($display) ? $username : $display;

                $user = new User();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setDisplayName($display);

                if ($user->save() === false) {
                    $this->flash->error('That username is already in use.');
                } else {
                    $this->response->redirect('login/index');
                }
            }
        }

        $this->view->setVars($vars);
        $this->view->form = $form;
        $this->view->pick("login/create");
    }

	public function indexAction() {
        if ($this->acl->isLoggedIn()) {
            $this->dispatcher->forward(array(
                'controller'=>'app',
                'action'=>'index'
            ));
        }

        $form = new LoginForm();
        $vars = Array(
            'title'=>'Account Login',
            'metaDescription'=>'',
        );

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $username = $this->request->getPost('login-username');
                $password = $this->request->getPost('login-password');

                $user = $this->acl->doLogin($username, $password);
                if ($user !== FALSE) {
                    $this->acl->setSession('user-id', $user->getId());
                    $this->response->redirect('app/select');
                } else {
                    $this->flash->error("Account not found");
                }
            }
        }

        $this->view->setVars($vars);
        $this->view->form = $form;
        $this->view->pick("login/index");
	}

    public function logoutAction() {
        $vars = Array(
            'title'=>'Account Logout',
            'metaDescription'=>'',
        );

        $this->session->destroy();
        $this->view->setVars($vars);
        $this->view->pick("login/logout");
    }
}
