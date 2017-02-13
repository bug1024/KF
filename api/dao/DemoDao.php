<?php namespace api\dao;

class DemoDao {

    public static function  getList($param) {
        $db = (\core\Container::instance())->get('db1');
        return $db->sql('select * from toutiao limit 1');
    }

}

