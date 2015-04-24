<?php
namespace Manage\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        S(array('type'=>'file','length'=>10,'expire'=>300));
    }

    public function checkLogin()
    {
        $access = CONTROLLER_NAME.'/'.ACTION_NAME;

        $ban_arr = array(
            'Index/login',
        );
        if(!in_array($access,$ban_arr) && !session('is_login')){

            $this->success('请先登陆后操作',U('/Index/login'));
        }
    }

    public function getUserInfo()
    {
        if(S('user_info')){
            return S('user_info');
            exit;
        }elseif(intval(session('user_id')) > 0){
            $model = D('Auth');
            $reinfo = $model->where("auth_id=".session('user_id'))->find();
            if($reinfo){
                S('user_info',$reinfo,300);
                return $reinfo;
            }else{
                $this->success('请先登陆后操作',U('/Index/login'));
            }
        }else{
            $this->success('请先登陆后操作',U('/Index/login'));
        }
    }
}