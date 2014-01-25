<?php
namespace forma\App\Controllers;

use forma\App\Models\User as User,
    forma\App\Models\Organization as Organization;

class AppController extends \Phalcon\Mvc\Controller
{
    protected $user;

    public function initialize() {
        if (!$this->session->has('user-id')) {
            $this->response->redirect('login');
        } else {
            $this->user = User::findFirst("id='".$this->session->get('user-id')."'");
            $this->view->setVar('isLoggedIn', TRUE);
            $this->view->setVar('user', $this->user);
        }
    }

	public function indexAction() {
	    if (!$this->session->has('organization')) {
            $this->response->redirect('app/select');
        }
	    $acl = $this->di->get('acl');

	}

    public function selectAction() {
        print_r($this->user->organizations);
        die();
    }
}
