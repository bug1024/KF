<?php namespace app\controller;

use core\Controller;

class IndexController extends Controller {


    public function indexAction() {
        $this->assign('framework', 'KF');
        $this->display('index.php');
    }

    public function listAction() {
        var_dump('list');
    }
}



