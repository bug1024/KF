<?php namespace core;

use core\db\DBMysqli;

abstract class Model {

    protected $_database;

    protected $_table;

    protected $_handle = null;

    public function __construct() {
        $di = Container::instance();
        $di->set($this->_database, function() {
            $config = Conf::get('db/' . $this->_database);
            return (new DBMysqli($config));
        }, true);
        $this->_handle = $di->get($this->_database);
    }

    public function getOne() {
        $sql = "select * from {$this->_table} limit 1";
        return $this->_handle->sql($sql);
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

