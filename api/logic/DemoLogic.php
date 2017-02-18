<?php namespace api\logic;

class DemoLogic {

    public static function  getOne($param) {
        (new \api\model\DemoModel)->getOne($param);
        return (new \api\model\DemoModel)->getOne($param);
    }

    public static function getName() {
        $di = \core\Container::instance();
        $di->set('redis1', function() {
            return (new \core\cache\RedisClient(\core\Conf::get('redis/redis1')));
        });
        $redis = $di->get('redis1');
        $redis->set('name', 'jee-php');
        return $redis->get('name');
    }

}

