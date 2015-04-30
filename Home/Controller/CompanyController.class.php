<?php
namespace Home\Controller;
use Think\Controller;
class CompanyController extends BaseController {
    public function news()
    {
        $model = M('Article');
        $result = $model->field('at_id,at_title,at_author,create_time,is_show')->order('at_id asc')->select();
        $this->assign('article_info',$result);
        $this->display('news');
    }

    public function join()
    {
        $this->display('join_form');
    }
    public function part()
    {
        $config_model = M('Config');
        $about = $config_model->where("con_name = 'about'")->find();
        $this->assign('about',$about);
        $this->display('about');
    }
}