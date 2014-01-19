<?php
namespace forma\App\Controllers;

class AppController extends \Phalcon\Mvc\Controller
{
	public function indexAction() {
	    $acl = $this->di->get('acl');

	}
}
