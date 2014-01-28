<?php
require '../apps/App/config/config.php';

use Phalcon\Mvc\Router,
    Phalcon\Mvc\Application,
    Phalcon\DI\FactoryDefault,
    Phalcon\Session\Adapter\Files,
    Phalcon\Config;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$di = new FactoryDefault();

$di->set('config', new Config($config));

//Setup the database service
$di->set('db', function() {
	return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		"host"=>"localhost",
		"username"=>"formadb",
		"password"=>"!~f0rm4l0g1c~1",
		"dbname"=>"formalogica"
	));
});

//Specify routes for modules
$di->set('router', function () {
    $router = new Router();

    $router->setDefaultModule("App");

    $router->add("/login", array(
        'module'     => 'App',
        'controller' => 'Login',
        'action'     => 'index',
    ));

    $router->add("/", array(
        'module'     => 'App',
        'controller' => 'App',
	    'action'     => 'index',
    ));
/*
    $router->add("/products/:action", array(
        'controller' => 'products',
        'action'     => 1,
    ));
*/
    return $router;
});

//Registering the Models-Metadata
$di->set('modelsMetadata', function(){
    return new \Phalcon\Mvc\Model\Metadata\Memory();
});

//Registering the Models Manager
$di->set('modelsManager', function(){
    return new \Phalcon\Mvc\Model\Manager();
});

//Start the session the first time when some component request the session service
$di->setShared('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});

try {

    //Create an application
    $application = new Application($di);

    // Register the installed modules
    $application->registerModules(
        array(
            'App' => array(
                'className' => 'forma\App\Module',
                'path'      => '../apps/App/Module.php',
            ),
        )
    );

    //Handle the request
    echo $application->handle()->getContent();

} catch(\Exception $e){
    echo $e->getMessage();
}
