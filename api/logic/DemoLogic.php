<?php namespace api\logic;

class DemoLogic {

    public static function  getList($param) {
        return \api\dao\DemoDao::getList($param);
    }

}

