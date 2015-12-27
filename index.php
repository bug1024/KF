<?php

use core\Loader;
use core\Container;
use core\Route;
use core\Request;
use core\Response;
use core\View;
use core\KF;

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

// constants
define('CORE_PATH', __DIR__ . '/core/');
define('APP_PATH', __DIR__ . '/app/');
define('VIEW_PATH', APP_PATH . 'view/');

// autoload
require CORE_PATH . 'Loader.php';
(new Loader)
    ->addNamespace('core', CORE_PATH)
    ->addNamespace('app', APP_PATH)
    ->register();

try {
    $di = new Container;

    $di->set('route', function() {
        return (new Route());
    });

    $di->set('request', function() {
        return (new Request());
    });

    $di->set('response', function() {
        return (new Response());
    });

    $di->set('view', function() {
        return (new View(VIEW_PATH));
    });

    $app = new KF($di);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
