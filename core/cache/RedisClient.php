<?php namespace core\cache;

class RedisClient extends CacheAbstract {

    private $_redis;

    public function __construct($config) {
        $this->_redis = new \Redis();
        $this->connect($config);
    }

    public function connect(array $config) {
        $host    = isset($config['host']) ? $config['host'] : '127.0.0.1';
        $port    = isset($config['port']) ? $config['port'] : 6379;
        $timeout = isset($config['timeout']) ? $config['timeout'] : 0.5;
        $this->_redis->connect($host, $port, $timeout);
        if (isset($config['auth']) && !empty($config['auth'])) {
            $this->_redis->auth($config['auth']);
        }
    }

    public function set($key, $value, $expire = 0) {
        return $this->_redis->set($key, $value, $expire);
    }

    public function get($key) {
        return $this->_redis->get($key);
    }

    public function close() {
        return $this->_redis->close();
    }

}

