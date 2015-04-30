<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function plist(){
        $model = M('Goods');
        $result = $model->where('is_trash = 0')->order('goods_sort desc')->select();
        $this->assign('goods_info',$result);
        $this->display('plist');
    }
    public function instance(){
        $this->display('instance');
    }
}
