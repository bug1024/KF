<?php namespace core;

class View {

    public $viewsHome = '';

    public function __construct($viewsHome = null) {
        $this->viewsHome = $viewsHome;
    }

    public function assign($key, $val) {
        $this->$key = $val;
    }

    public function fetch($tpl, $dir = null) {
        ob_start();
        ob_implicit_flush(0);
        $this->display($tpl, $dir);
        return ob_get_clean();
    }

    public function display($tpl, $dir = null) {
        if (null === $dir) {
            $dir = $this->viewsHome;
        }
        if ($dir) {
            $dir = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
        }
        include ($dir . $tpl);
    }

    public function __set($key, $value = null) {
        $this->$key = $value;
    }

}
