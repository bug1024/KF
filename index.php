<?php

use core\Loader;
use core\Container;
use core\Route;
use core\Bootstrap;

// CORE_PATH
define('CORE_PATH', __DIR__ . '/core/');

// autoload
require 'core/Loader.php';
(new Loader)->addNamespace('core', CORE_PATH)->register();

try {
    $di = new Container;
    $di->set('route', function() {
        return (new Route());
    });

    $app = new Bootstrap($di);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
