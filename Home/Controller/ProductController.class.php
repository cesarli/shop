<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function plist(){

        $this->display('plist');
    }
    public function instance(){
        $this->display('instance');
    }
}
