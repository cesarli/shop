<?php
namespace Manage\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function login()
    {
        if(IS_POST){
            $auth_name = I('post.auth_name','');
            $auth_pwd = I('post.auth_pwd','');
            if(!$auth_name || $auth_name == '用戶名'){
                $this->error('请输入用户名','/manage.php/Index/login',3);
            }
            if(!$auth_pwd || $auth_pwd == '密码'){
                $this->error('请输入密码','/manage.php/Index/login',3);
            }
            $model = D('Auth');
            $reinfo = $model->where("auth_name='%s' and auth_pwd='%f'",array($auth_name,$auth_pwd))->select();
            xmp($reinfo);
        }

        $this->display('login');
    }

    public function index(){
        $this->display('index');
    }

    public function left()
    {
        $this->display('left');
    }

    public function top()
    {
        $this->display('top');
    }

    public function main()
    {
        $this->display('main');
    }

}