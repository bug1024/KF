<?php namespace app\controller;

use core\Controller;
use api\logic\DemoLogic;

class IndexController extends Controller {

    public function indexAction() {

        $ret = DemoLogic::getList([]);
        var_dump($ret);

        $this->assign('framework', 'jeet-php');
        $this->display('index.php');
    }

    public function listAction() {
        var_dump('list');
    }
}



