<?php

require 'core/Container.php';
require 'core/Request.php';
require 'core/Response.php';
require 'core/Route.php';
require 'core/View.php';
require 'core/Controller.php';
require 'core/Bootstrap.php';

try {
    $di = new Container;
    $di->set('route', function() {
        return (new Route());
    });
    $boot = new Bootstrap($di);
} catch (Exception $e) {
    var_dump($e->getMessage());
}
