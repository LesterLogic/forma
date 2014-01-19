<?php

namespace forma\App;

use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'forma\App\Controllers' => '../apps/App/controllers/',
                'forma\App\Models'      => '../apps/App/models/',
                'forma\App\Services'    => '../apps/App/services/',
                'forma\App\Forms'       => '../apps/App/forms/',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {

        //Registering a dispatcher
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("forma\App\Controllers");
            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir('../apps/App/views/');
            return $view;
        });

        $di->set('acl', function() use ($di) {
            $acl = new Services\Acl($di);
            return $acl;
        });
    }

}
