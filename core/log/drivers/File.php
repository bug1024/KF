<?php namespace core\log\drivers;

class File {

    public function write($type, $msg) {
        $msg =  $type . ':' . date('Y-m-d H:i:s') . ', ' . $msg . PHP_EOL;

        return file_put_contents(DATA_PATH . "$type.log", $msg, FILE_APPEND);
    }

}

