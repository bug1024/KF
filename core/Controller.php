<?php

abstract class Controller {

    public function __construct() {}

    protected function get($key = null, $default = null) {
        return Request::get($key, $default);
    }

    protected function post($key = null, $default = null) {
        return Request::post($key, $default);
    }

    protected function view($viewsHome = null) {
        return $this->view = new View($viewsHome);
    }

    protected function display($tpl = null, $dir = null) {
        $this->view->display($tpl, $dir);
    }

    protected function redirect($url, $code = 302) {
        $this->response->redirect($url, $code);
    }

    public function __set($key, $value = null) {
        $this->$key = $value;
    }

}
