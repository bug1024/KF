<?php namespace api\logic;

class DemoLogic {

    public static function  getOne($param) {
        (new \api\model\DemoModel)->getOne($param);
        return (new \api\model\DemoModel)->getOne($param);
    }

    public static function getCache() {
        $redis = (new \core\cache\RedisClient(\core\Conf::get('redis/redis1')));
        return $redis->get('key');
    }

}

