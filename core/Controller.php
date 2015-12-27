<?php namespace core;

abstract class Controller {

    public function __construct($di) {
        $this->di       = $di;
        $this->request  = $this->di->get('request');
        $this->response = $this->di->get('response');
        $this->view     = $this->di->get('view');
    }

    protected function get($key = null, $default = null) {
        return $this->request->get($key, $default);
    }

    protected function post($key = null, $default = null) {
        return $this->request->post($key, $default);
    }

    protected function assign($key, $val) {
        $this->view->assign($key, $val);
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
