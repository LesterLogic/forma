<?php
namespace forma\App\Controllers;

class ContactController extends \Phalcon\Mvc\Controller
{
	public function indexAction($action) {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../apps/App/views/');

        $sheet = Array(
            'title' => 'Contacts',
            'data' => Array(),
        );
        if ($action == "template") {
            $response->setContent($view->render('contact/index'));
        } else {
            $response->setContent(json_encode($sheet));
        }

        return $response;
	}

    public function newAction($action) {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../apps/App/views/');

        $sheet = Array(
            'title' => 'New Contact',
            'data' => Array(),
        );
        if ($action == "template") {
            $response->setContent($view->render('contact/new'));
        } else {
            $response->setContent(json_encode($sheet));
        }

        return $response;
    }
}