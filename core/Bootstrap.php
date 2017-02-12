<?php namespace core;

class Bootstrap {

    public function __construct($di) {
        $this->di        = $di;
        $this->routeInfo = $this->di->get('route')->getInfo();

        $this->beforeDispatch();
        $this->dispatch();
        $this->afterDispatch();
    }

    public function dispatch() {
        $class = '\\' . $this->routeInfo['app'] . '\\controller\\' .
                 $this->routeInfo['controller'] . 'Controller';

        call_user_func([(new $class($this->di)), $this->routeInfo['action'] . 'Action']);
    }

    public function beforeDispatch() {
    }

    public function afterDispatch() {
    }

    public function __set($key, $val) {
        $this->$key = $val;
    }

    public function __get($key) {
        return isset($this->$key) ? $this->$key : null;
    }

}

