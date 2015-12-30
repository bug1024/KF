<?php

use core\Loader;
use core\Container;
use core\Route;
use core\Request;
use core\Response;
use core\View;
use core\KF;
use core\ext\db\DBMysqli;

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

// constants
define('CONF_PATH', __DIR__ . '/config/');
define('COMMON_CONFIG_PATH', CONF_PATH. 'common/');
// env
require CONF_PATH . 'env.php';
define('CONFIG_PATH', CONF_PATH . ENV . '/');
define('CORE_PATH', __DIR__ . '/core/');
define('API_PATH', __DIR__ . '/api/');
define('VIEW_PATH', __DIR__ . '/view/');
define('APP_PATH', __DIR__ . '/app/');
define('APP1_PATH', __DIR__ . '/app1/');


// autoload
require CORE_PATH . 'Loader.php';
(new Loader)
    ->addNamespace('core', CORE_PATH)
    ->addNamespace('api', API_PATH)
    ->addNamespace('app', APP_PATH)
    ->addNamespace('app1', APP1_PATH)
    ->register();

try {
    $di = Container::instance();

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

    $di->set('db1', function() {
        $db = include CONFIG_PATH . 'db.php';
        return (new DBMysqli($db['db1']));
    });

    $app = new KF($di);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
