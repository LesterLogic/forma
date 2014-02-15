<?php
namespace forma\App\Controllers;

use forma\App\Models\Users as Users,
    forma\App\Models\Organizations as Organizations,
    Phalcon\Mvc\View\Simple;

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
        $this->view->pick("app/index");
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

    public function dashboardAction($action) {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../apps/App/views/');

        $sheet = Array(
            'title' => 'Dashboard',
            'data' => Array(),
        );
        if ($action == "template") {
            $response->setContent($view->render('app/dashboard'));
        } else {
            $response->setContent(json_encode($sheet));
        }

        return $response;
    }
}
