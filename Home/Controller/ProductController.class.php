<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function plist(){
        $model = M('GoodsClass');
        $class = $model->where('is_show = 1')->order('sort desc')->select();
        $class = getTree($class);
        $this->assign('class',$class);
        if(isset($_GET['cid']) && is_numeric($_GET['cid'])){
            $class_id = intval($_GET['cid']);
            $model = M('Goods');
            $list = $model->where('is_trash = 0 and goods_class = '.$class_id)->order('goods_sort desc')->page($_GET['p'].',15')->select();
            $this->assign('goods_info',$list);
            $count = $model->where('is_trash = 0 and goods_class = '.$class_id)->count();
            $page = new \Think\Page($count,15);
            $page->setConfig('theme','<ul><li>%HEADER%</li>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul>');
            $page->setConfig('header','共 %TOTAL_ROW% 条记录');
            $page->setConfig('prev','上一页');
            $page->setConfig('next','下一页');
            $page->setConfig('first','首页');
            $page->setConfig('end','尾页');
            $show = $page->show();
            $this->assign('page',$show);
            $this->display('plist');
            exit;
        }
        $model = M('Goods');
        $list = $model->where('is_trash = 0')->order('goods_sort desc')->page($_GET['p'].',15')->select();
        $this->assign('goods_info',$list);
        $count = $model->where('is_trash = 0')->count();
        $page = new \Think\Page($count,15);
        $page->setConfig('theme','<ul><li>%HEADER%</li>%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul>');
        $page->setConfig('header','共 %TOTAL_ROW% 条记录');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('end','尾页');
        $show = $page->show();
        $this->assign('page',$show);
        $this->display('plist');
    }
    public function instance(){
        $this->display('instance');
    }
}
