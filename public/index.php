<?php

use Phalcon\Mvc\Router,
    Phalcon\Mvc\Application,
    Phalcon\DI\FactoryDefault;

$di = new FactoryDefault();

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
        'action'     => 'login',
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
            'Contact'  => array(
                'className' => 'forma\Contact\Module',
                'path'      => '../apps/Contact/Module.php',
            ),
            'Lead'  => array(
                'className' => 'forma\Lead\Module',
                'path'      => '../apps/Lead/Module.php',
            ),
            'Ledger'  => array(
                'className' => 'forma\Ledger\Module',
                'path'      => '../apps/Ledger/Module.php',
            ),
            'Organization'  => array(
                'className' => 'forma\Organization\Module',
                'path'      => '../apps/Organization/Module.php',
            ),
            'Project'  => array(
                'className' => 'forma\Project\Module',
                'path'      => '../apps/Project/Module.php',
            ),
            'Security'  => array(
                'className' => 'forma\Security\Module',
                'path'      => '../apps/Security/Module.php',
            ),
            'Tasklist'  => array(
                'className' => 'forma\Tasklist\Module',
                'path'      => '../apps/Tasklist/Module.php',
            ),
            'Time'  => array(
                'className' => 'forma\Time\Module',
                'path'      => '../apps/Time/Module.php',
            ),
            'User'  => array(
                'className' => 'forma\User\Module',
                'path'      => '../apps/User/Module.php',
            ),
        )
    );

    //Handle the request
    echo $application->handle()->getContent();

} catch(\Exception $e){
    echo $e->getMessage();
}