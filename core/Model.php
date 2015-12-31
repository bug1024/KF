<?php namespace core;

use core\ext\db\DBMysqli;

abstract class Model {

    protected $database;

    protected $table;

    protected $handle = null;

    public function __construct() {
       $di = Container::instance();
       $this->handle = $di->get($this->database);
    }

    public function getOne() {
    }

    public function getRows() {
    }

    public function getCount() {
    }

    public function insert() {
    }

    public function delete() {
    }

    public function lastSql() {
    }

    public function lastId() {
    }


    public function __call($method, $argv) {
        //return call_user_func_array([$this->db, $method], $argv);
    }

}
