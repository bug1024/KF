<?php namespace core;

class Bootstrap {

    public function __construct($di) {
        $this->di        = $di;
        $this->routeInfo = $this->di->get('route')->getInfo();
    }

    public function dispatch() {
        $app         = $this->routeInfo['app'];
        $module      = $this->routeInfo['module'];
        $controller  = $this->routeInfo['controller'];
        $action      = $this->routeInfo['action'];
    }

    public function load($class, $file = '') {
        // @TODO
        return (class_exists($class, false) || interface_exists($class, false));
    }

    public function __set($key, $val) {
        $this->$key = $val;
    }

    public function __get($key) {
        return isset($this->$key) ? $this->$key : null;
    }

}
