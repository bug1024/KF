<?php namespace app\controller;

use core\Controller;
use api\interfaces\DemoInterface;

class IndexController extends Controller {


    public function indexAction() {

        $ret = DemoInterface::get();
        var_dump($ret);

        $this->assign('framework', 'KF');
        $this->display('index.php');
    }

    public function listAction() {
        var_dump('list');
    }
}



