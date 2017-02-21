<?php namespace core\log\drivers;

class File {

    public function write($type, $msg) {
        $time = microtime(true);
        list($s, $ms) = explode('.', $time);
        $msg =  $type . ':' . date('Y-m-d H:i:s.', $s) . $ms . ', ' . $msg . PHP_EOL;

        return file_put_contents(DATA_PATH . "$type.log", $msg, FILE_APPEND);
    }

}

