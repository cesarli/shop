<?php
namespace Manage\Controller;
use Think\Controller;
class CompanyController extends BaseController {
    public function title()
    {
        $model = M('Bar');
        $result = $model->order('bar_sort asc')->select();
        $this->assign('bar_info',$result);
        $this->display();
    }
}