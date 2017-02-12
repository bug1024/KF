<?php namespace core;

class Route {

    protected $routeInfo = [];

    const DEFAULT_APP        = 'app';

    const DEFAULT_CONTROLLER = 'Index';

    const DEFAULT_ACTION     = 'Index';

    public function __construct($mode = 'path') {
        if ($mode === 'path') {
            $this->pathMode();
        } else if ($mode === 'query') {
            $this->queryMode();
        } else {
            throw new \Exception('unknown route mode');
        }
    }

    public function getInfo() {
        if (empty($this->routeInfo['app'])) {
            $this->routeInfo['app'] = self::DEFAULT_APP;
        }

        if (empty($this->routeInfo['controller'])) {
            $this->routeInfo['controller'] = self::DEFAULT_CONTROLLER;
        }

        if (empty($this->routeInfo['action'])) {
            $this->routeInfo['action'] = self::DEFAULT_ACTION;
        }

        $this->routeInfo['controller'] = ucfirst($this->routeInfo['controller']);

        return $this->routeInfo;
    }

    public function pathMode() {
        $path    = Request::server('REQUEST_URI');
        $pathArr = explode('/', trim($path, '/'));

        $this->routeInfo['app']         = isset($pathArr[0]) ? $pathArr[0] : '';
        $this->routeInfo['controller']  = isset($pathArr[1]) ? $pathArr[1] : '';
        $this->routeInfo['action']      = isset($pathArr[2]) ? $pathArr[2] : '';
    }

    public function queryMode() {
        $this->routeInfo['app']         = Request::get('app');
        $this->routeInfo['controller']  = Request::get('controller');
        $this->routeInfo['action']      = Request::get('action');
    }

}

