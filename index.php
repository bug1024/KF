<?php

use core\Loader;
use core\Container;
use core\Route;
use core\Request;
use core\Response;
use core\View;
use core\Conf;
use core\Bootstrap;
use core\db\DBMysqli;

error_reporting(E_ALL);
ini_set('display_errors', 'ON');

date_default_timezone_set('PRC');

// constants
define('CONF_PATH', __DIR__ . '/config/');
define('COMMON_CONFIG_PATH', CONF_PATH. 'common/');
// env
require __DIR__ . '/env.php';
define('CONFIG_PATH', CONF_PATH . ENV . '/');
define('CORE_PATH', __DIR__ . '/core/');
define('API_PATH', __DIR__ . '/api/');
define('VIEW_PATH', __DIR__ . '/view/');
define('APP_PATH', __DIR__ . '/app/');
define('DATA_PATH', __DIR__ . '/data/');
define('LOG_DRIVER', 'File');

// autoload
require CORE_PATH . 'Loader.php';
(new Loader)
    ->addNamespace('core', CORE_PATH)
    ->addNamespace('api', API_PATH)
    ->addNamespace('app', APP_PATH)
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

    $di->set('log', function() {
        $class = '\\core\\log\drivers\\' . LOG_DRIVER;
        return new $class;
    });

    $app = new Bootstrap($di);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}

