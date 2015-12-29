<?php namespace core;

class Container {

    protected $_service = [];

    protected $_singleton = [];

    protected static $_instance = null;

    public static function instance() {
        if (self::$_instance == null) {
            return new self();
        } else {
            return self::$_instance;
        }
    }

    public function set($name, Callable $service) {
        $this->_service[$name] = $service;
    }

    public function get($name) {
        if (isset($this->_service[$name])) {
           return $this->_make($this->_service[$name]);
        }
        throw new \Exception('Alias does not exist');
    }

    public function __set($name, $service) {
        $this->set($name, $service);
    }

    public function __get($name) {
        return $this->get($name);
    }

    protected function _make($class) {
        if ($class instanceof \Closure) {
            return $class($this);
        }

        $reflector = new \ReflectionClass($class);
        if (!$reflector->isInstantiable()) {
            throw new \Exception('is not instantiable');
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class;
        }

        $params = $constructor->getParameters();
        $deps   = $this->_getDeps($params);

        return $reflector->newInstanceArgs($deps);
    }

    protected function _getDeps($params) {
        $deps = [];

        foreach ($params as $param) {
            $dep = $param->getClass();

            if (is_null($dep)) {
                $deps[] = $this->_resolveNonClass($param);
            } else {
                $deps[] = $this->_make($dep->name);
            }
        }

        return $deps;
    }

    protected function _resolveNonClass($param) {
        if ($param->isDefaultValueAvailable()) {
            return $param->getDefaultValue();
        }

        throw new \Exception('Are you OK?');
    }

}
