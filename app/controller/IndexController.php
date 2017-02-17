<?php namespace app\controller;

use core\Controller;
use api\logic\DemoLogic;

class IndexController extends Controller {

    public function indexAction() {
        $ret = DemoLogic::getOne([]);
        var_dump($ret);

        $ret = DemoLogic::getCache();
        var_dump($ret);

        $this->assign('framework', 'jeet-php');
        $this->display('index.php');
    }

    public function listAction() {
        $ret = DemoLogic::getOne([]);
        echo json_encode($ret);
    }
}

