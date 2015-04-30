<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $model = M('Active');
        $result = $model->order('sort desc')->limit(3)->select();
        $this->assign('active_info',$result);
        $article = M('Article');
        $a_result = $article->order('at_id desc')->limit(3)->select();
        $this->assign('art_info',$a_result);
        $this->display('index');
    }
}