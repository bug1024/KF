<?php namespace app\controller;

use core\Controller;

class IndexController extends Controller {


    public function indexAction() {
        $db    = $this->di->get('db');
        $users = $db->sql('select * from users');

        $this->assign('framework', 'KF');
        $this->assign('users', $users);
        $this->display('index.php');
    }

    public function listAction() {
        var_dump('list');
    }
}



