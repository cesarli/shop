<?php
namespace Manage\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function login()
    {
        if(IS_POST){
            $auth_name = I('post.auth_name','');
            $auth_pwd = md5(I('post.auth_pwd',''));
            if(!$auth_name || $auth_name == '用戶名'){
                $this->error('请输入用户名',U('Index/login'),2);
            }
            if(!$auth_pwd || $auth_pwd == '密码'){
                $this->error('请输入密码',U('Index/login'),2);
            }
            $model = D('Auth');
            $reinfo = $model->where("auth_name='%s' and auth_pwd='%s'",array($auth_name,$auth_pwd))->find();
            if($reinfo){
                $this->success('登陆成功，正在为您跳转',U('/Index/index'),2);
                session('user_id',$reinfo['auth_id']);
                session('is_login',true);
                $model-> where('auth_id='.$reinfo['auth_id'])->setField('last_login',time());
                $reinfo['last_login'] = time();
                S('user_info',$reinfo,300);
            }else{
                $this->error('密码错误');
            }
        }

        $this->display('login');
    }

    public function loginOut()
    {
        session(null);
        S('user_info',null);
        $this->success('退出成功',U('Index/login'),2);
    }

    public function index(){
        $this->display('index');
    }

    public function test()
    {
        xmp($this->getUserInfo());
    }

    public function left()
    {
        $this->display('left');
    }

    public function top()
    {
        $user_info = $this->getUserInfo();
        $this->assign('user_info',$user_info);
        $this->display('top');
    }

    public function main()
    {
        $user_info = $this->getUserInfo();
        $this->assign('user_info',$user_info);
        $this->display('main');
    }

}