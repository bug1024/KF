<?php namespace api\logic;

class DemoLogic {

    public static function  getOne($param) {
        (new \api\model\DemoModel)->getOne($param);
        return (new \api\model\DemoModel)->getOne($param);
    }

}

