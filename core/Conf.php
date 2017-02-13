<?php namespace core;

class Conf {

    /**
     * @param string $key db/db1
     * @return mixed
     */
    public static function get($config_key) {
        list($file, $key) = self::_parseKey($config_key);
        $config = [];
        if (is_file(CONFIG_PATH. $file . '.php')) {
            $config = include CONFIG_PATH. $file . '.php';
        }

        return is_array($config) && isset($config[$key]) ? $config[$key] : false;
    }

    public static function set($config_key, $config) {
    }

    protected static function _parseKey($config_key) {
        return explode('/', $config_key);
    }

}
