<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){

        $this->display('index');
    }
    public function test()
    {
        $this->initModel();
    }
}