<?php
namespace forma\App\Controllers;

class AppController extends \Phalcon\Mvc\Controller
{
	public function indexAction() {
	    $security = $this->di->get('security');

	}
}
