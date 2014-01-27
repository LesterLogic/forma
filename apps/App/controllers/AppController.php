<?php
namespace forma\App\Controllers;

use forma\App\Models\Users as Users,
    forma\App\Models\Organizations as Organizations;

class AppController extends \Phalcon\Mvc\Controller
{
    protected $user;
    protected $acl;

    public function beforeExecuteRoute() {
        $this->acl = $this->di->get('acl');
        if (!$this->acl->isLoggedIn()) {
            $this->dispatcher->forward(array(
                'controller'=>'login',
                'action'=>'index'
            ));
        }
    }

    public function initialize() {
            $this->user = Users::findFirst("id='".$this->session->get('user-id')."'");
            $this->view->setVar('isLoggedIn', TRUE);
            $this->view->setVar('user', $this->user);
    }

	public function indexAction() {
        $vars = Array(
            'title'=>'FormaLogica',
            'metaDescription'=>'',
        );

	    if (!$this->session->has('organization-id')) {
            $this->response->redirect('app/select');
        }

        $this->view->setVars($vars);
	}

    public function selectAction() {
        $vars = Array(
            'title'=>'Select an Organization',
            'metaDescription'=>'',
        );

        if (isset($_GET['org'])) {
            $org = Organizations::findFirst("id='".$_GET['org']."'");
            if ($org !== FALSE) {
                $this->acl->setSession('organization-id', $org);
                $this->response->redirect();
            }
        }

        $this->view->setVars($vars);
    }
}
