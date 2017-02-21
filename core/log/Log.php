<?php namespace core\log;

class Log {

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

        $di = \core\Container::instance();

        return $di->get('log', true)->write($type, $msg);
    }

}

