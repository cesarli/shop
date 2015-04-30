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

    public function login()
    {
        if(IS_POST){
            $auth_name = I('post.mem_name','');
            $auth_pwd = I('post.mem_pwd','');
            if(!$auth_name || $auth_name == '用戶名'){
                $this->error('请输入用户名',U('Index/login'),2);
            }
            if(!$auth_pwd || $auth_pwd == '密码'){
                $this->error('请输入密码',U('Index/login'),2);
            }
            $model = M('Mem');
            $reinfo = $model->where("mem_name='%s' and mem_pwd='%s'",array($auth_name,$auth_pwd))->find();
            if($reinfo){
                $this->success('登陆成功，正在为您跳转',U('/Index/index'),2);
                session('mem_id',$reinfo['mem_id']);
                session('is_login',1);
                session('mem_name',$reinfo['mem_name']);
                S('user_info',$reinfo,300);
            }else{
                $this->error('密码错误');
            }
        }

        $this->display('login');
    }
}