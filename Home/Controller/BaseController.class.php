<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->initModel();
    }

    public function initModel()
    {
        $model = M('bar');
        $bar_list = $model->where('is_show = 1')->order('bar_sort asc')->select();
        $this->assign('bar_list',$bar_list);
    }
}