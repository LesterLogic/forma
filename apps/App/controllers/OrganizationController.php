<?php
namespace forma\App\Controllers;

use forma\App\Models\Users as Users,
    forma\App\Models\Organizations as Organizations,
    forma\App\Forms\organization\CreateForm;

class OrganizationController extends \Phalcon\Mvc\Controller
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

	}

    public function createAction() {
        $form = new CreateForm();
        $vars = Array(
            'title'=>'Create New Organization',
            'metaDescription'=>'',
            'displayname'=>$this->user->getDisplayname(),
        );

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $name = $this->request->getPost('org-name');
                if (Organizations::findFirst("name='".$name."' AND uid='".$this->user->getId()."'") !== FALSE) {
                    $this->flash->error("You already own an organization with this name.");
                } else {
                    $org = new Organizations();
                    $org->setUid($this->user->getId());
                    $org->setName($name);
                    if ($org->save() === FALSE) {
                        $this->flash->error("Unable to save organization.");
                        foreach ($org->getMessages() as $message) {
                            $this->flash->error($message);
                        }
                    } else {
                        $this->dispatcher->forward(array(
                            'controller'=>'app',
                            'action'=>'select'
                        ));
                    }
                }
            }
        }

        $this->view->setVars($vars);
        $this->view->form = $form;
    }
}