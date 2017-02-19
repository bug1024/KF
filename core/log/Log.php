<?php namespace core\log;

class Log {

    protected static $_driver;

    public static function setDriver($driver = 'File') {
        $di = \core\Container::instance();
        $di->set('log', function() use ($driver) {
            $class = '\\core\\log\drivers\\' . $driver;
            return new $class;
        });
        self::$_driver = $di->get('log', true);
    }

    public static function debug($msg) {
        return self::_write('DEBUG', $msg);
    }

    public static function info($msg) {
        return self::_write('INFO', $msg);
    }

    public static function warning($msg) {
        return self::_write('WARNING', $msg);
    }

    protected static function _write($type, $msg) {
        if (is_array($msg)) {
            $msg = json_encode($msg);
        }

        return self::$_driver->write($type, $msg);
    }

}

