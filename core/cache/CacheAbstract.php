<?php namespace core\cache;

abstract class CacheAbstract {

    abstract public function connect(array $config);

    abstract public function set($key, $value, $expire = 0);

    abstract public function get($key);

    abstract public function close();

}

