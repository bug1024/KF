<?php

class Bootstrap {

    public function __construct(Container $di) {
        $this->di        = $di;
        $this->routeInfo = $this->di->get('route')->getInfo();
    }

    public function dispatch() {
        $app         = $this->routeInfo['app'];
        $module      = $this->routeInfo['module'];
        $controller  = $this->routeInfo['controller'];
        $action      = $this->routeInfo['action'];
    }

    public function __set($key, $val) {
        $this->$key = $val;
    }

    public function __get($key) {
        return isset($this->$key) ? $this->$key : null;
    }

}
