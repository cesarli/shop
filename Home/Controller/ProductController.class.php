<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function plist(){
        $model = M('Goods');
        $list = $model->where('is_trash = 0')->order('goods_sort desc')->page($_GET['p'].',15')->select();
        $this->assign('goods_infso',$list);
        $count      = $model->where('is_trash = 0')->count();//
        $Page       = new \Think\Page($count,15);//
        $Page->setConfig('header','个会员');
        $show       = $Page->show();//
        $this->assign('page',$show);//
        $this->display('plist');
    }
    public function instance(){
        $this->display('instance');
    }
}
