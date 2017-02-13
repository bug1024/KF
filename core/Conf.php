<?php namespace core;

class Conf {

    /**
     * @param string $key db/db1
     * @return mixed
     */
    public static function get($key) {
        list($file, $key) = self::_parseKey($key);

        $config = [];
        if (is_file(CONF_PATH . $file . '.php')) {
            $config = include CONF_PATH . $file . '.php';
        }

        return is_array($config) && isset($config[$key]) ? $config[$key] : false;
    }

    public static function set($key, $config) {
    }

    protected static function _parseKey($key) {
        return explode('/', $key);
    }

}
