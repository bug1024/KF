<?php namespace api\interfaces;

use api\models\DemoModel;

class DemoInterface {

    public static function get() {
        return (new DemoModel())->sql('select * from users');
    }


}
