<?php namespace api\logic;

class DemoLogic {

    public static function  getOne($param) {
        return (new \api\dao\DemoDao)->getOne($param);
    }

}

