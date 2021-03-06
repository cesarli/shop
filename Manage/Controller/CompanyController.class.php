<?php
namespace Manage\Controller;
use Think\Controller;
class CompanyController extends BaseController {

    public function active()
    {
        $model = M('Active');
        $result = $model->order('sort asc')->select();
        $this->assign('active_info',$result);
        $this->display('active');
    }
    public function delActive($at_id)
    {
        $GoodsClass = M('Active');
        if($GoodsClass->delete($at_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function modActive($at_id)
    {
        if(IS_POST){
            $model = M('Active');
            $title = I('post.title','');
            $content = I('post.content','');
            $sort = I('post.sort',50);
            $model->create(array(
                'a_id' => $at_id,
                'title' => $title,
                'content' => $content,
                'sort' => $sort
            ));
            if($model->save()){
                $this->success('更改完成',U('Company/active'));
            }else{
                $this->error('更改失败');
            }
            exit;
        }
        $model = M('Active');
        $result = $model->where('a_id ='.$at_id)->find();
        $this->assign('active',$result);
        $this->display('modactive');
    }

    public function addActive()
    {
        if(IS_POST){
            $model = M('Active');
            $title = I('post.title','');
            $content = I('post.content','');
            $sort = I('post.sort',50);
            $model->create(array(
                'title' => $title,
                'content' => $content,
                'sort' => $sort
            ));
            if($model->add()){
                $this->success('添加完成',U('Company/addActive'));
            }else{
                $this->error('添加失败,请检查数据是否输入完整或者含有特殊字符');
            }
            exit;
        }
        $this->display('addactive');
    }

    public function about()
    {
        if(IS_POST){
            $model = M('Config');
            $con_desc = I('post.con_desc','');
            $model->create(array(
                'config_id' => 2,
                'con_desc' => $con_desc,
            ));
            if($model->save()){
                $this->success('修改完成');
            }else{
                $this->error('修改失败');
            }
            exit;
        }
        $model = M('Config');
        $result = $model->where('config_id = 2')->find();
        $this->assign('con_info',$result);
        $this->display('about');
    }

    public function addArticle()
    {
        if(IS_POST){
            $model = M('Article');
            $at_title = I('post.at_title','');
            $at_content = I('post.at_content','');
            $at_author = I('post.at_author','');
            $create_time = strtotime(I('post.create_time',0));
            $is_show = I('post.is_show',1);
            $model->create(array(
                'at_title' => $at_title,
                'at_content' => $at_content,
                'at_author' => $at_author,
                'create_time' => $create_time,
                'is_show' => $is_show
            ));
            if($model->add()){
                $this->success('添加完成',U('Company/articleList'));
            }else{
                $this->error('添加失败,请检查数据是否输入完整或者含有特殊字符');
            }
            exit;
        }
        $this->display('addarticle');
    }
    public function modArticle($at_id)
    {
        if(IS_POST){
            $model = M('Article');
            $at_title = I('post.at_title','');
            $at_content = I('post.at_content','');
            $at_author = I('post.at_author','');
            $create_time = strtotime(I('post.create_time',0));
            $is_show = I('post.is_show',1);
            $model->create(array(
                'at_id' => $at_id,
                'at_title' => $at_title,
                'at_content' => $at_content,
                'at_author' => $at_author,
                'create_time' => $create_time,
                'is_show' => $is_show
            ));
            if($model->save()){
                $this->success('更改完成',U('Company/articleList'));
            }else{
                $this->error('更改失败');
            }
            exit;
        }
        $model = M('Article');
        $result = $model->where('at_id ='.$at_id)->order('at_id asc')->find();
        $this->assign('at_info',$result);
        $this->display('modarticle');
    }
    public function delArticle($at_id)
    {
        $GoodsClass = M('Article');
        if($GoodsClass->delete($at_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function articleList()
    {
        $model = M('Article');
        $result = $model->field('at_id,at_title,at_author,create_time,is_show')->order('at_id asc')->select();
        $this->assign('article_info',$result);
        $this->display('articlelist');
    }
    public function title()
    {
        $model = M('Bar');
        $result = $model->order('bar_sort asc')->select();
        $this->assign('bar_info',$result);
        $this->display();
    }

    public function modtitle($bar_id)
    {
        if(IS_POST){
            $model = M('Bar');
            $bar_name = I('post.bar_name','');
            $bar_sort = I('post.bar_sort',0);
            $is_show = I('post.is_show',0);
            $model->create(array(
                'bar_id' => $bar_id,
                'bar_name' => $bar_name,
                'bar_sort' => $bar_sort,
                'is_show' => $is_show,
            ));
            if($model->save()){
                $this->success('更改完成',U('Company/title'));
            }else{
                $this->error('更改失败');
            }
            exit;
        }
        $model = M('Bar');
        $bar_info = $model->where("bar_id = '%d'",array($bar_id))->find();
        $this->assign('bar_info',$bar_info);
        $this->display('modtitle');
    }


}