<?php namespace api\service;

class DemoService {

    public static function  getList($param) {
        return \api\logic\DemoLogic::getList($param);
    }

}
