<?php namespace core;

class Log {

    public static function debug($msg) {

    }

    public static function info($msg) {

    }

    public static function warning($msg) {

    }

    protected static function _write($msg) {
        if (is_array($msg)) {
            $msg = json_encode($msg);
        }

        // @TODO
    }

}

