<?php
namespace forma\App\Controllers;

class AppController extends \Phalcon\Mvc\Controller
{
    public function initialize() {
        if (!$this->session->has('user-id')) {
            $this->response->redirect('login');
        }
    }

	public function indexAction() {
	    $acl = $this->di->get('acl');

	}
}
