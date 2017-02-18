<?php namespace app\controller;

use core\Controller;
use api\logic\DemoLogic;

class IndexController extends Controller {

    public function indexAction() {
        $ret = DemoLogic::getOne([]);
        var_dump($ret);

        $name = DemoLogic::getName();

        $this->assign('framework', $name);
        $this->display('index.php');
    }

    public function listAction() {
        $ret = DemoLogic::getOne([]);
        echo json_encode($ret);
    }
}

