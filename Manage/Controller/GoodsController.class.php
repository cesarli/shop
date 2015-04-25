<?php
namespace Manage\Controller;
use Think\Controller;
class GoodsController extends BaseController {
    public function goodsList()
    {
        $model = M('Goods');
        $result = $model->where('is_trash = 0')->order('goods_id desc')->select();
        $this->assign('goods_info',$result);
        $this->display('goodslist');
    }
    public function modgoods($goods_id)
    {
        if(IS_POST){
            $model = M('Goods');
            $goods_name = I('post.goods_name','');
            $goods_num = I('post.goods_num',0);
            $goods_class = I('post.goods_class',0);
            $is_on_sale = I('post.is_on_sale',0);
            $goods_ct_price = I('post.goods_ct_price',0);
            $goods_cu_price = I('post.goods_cu_price',0);
            $goods_ag_price = I('post.goods_ag_price',0);
            $goods_mem_price = I('post.goods_mem_price',0);
            $goods_price = I('post.goods_price',0);
            $is_discount = I('post.is_discount',0);
            $goods_discount = I('post.goods_discount',0);
            $goods_sort = I('post.goods_sort',0);
            $goods_des = I('post.goods_des','','trim');
            $data = array(
                'goods_id' => $goods_id,
                'goods_name' => $goods_name,
                'goods_num' => $goods_num,
                'goods_class' => $goods_class,
                'is_on_sale' => $is_on_sale,
                'goods_ct_price' => $goods_ct_price,
                'goods_cu_price' => $goods_cu_price,
                'goods_ag_price' => $goods_ag_price,
                'goods_mem_price' => $goods_mem_price,
                'goods_price' => $goods_price,
                'is_discount' => $is_discount,
                'goods_discount' => $goods_discount,
                'goods_sort' => $goods_sort,
                'goods_des' => $goods_des,
                'create_time' => time(),
            );
            if($_FILES['goods_img_ori']['name'] != ''){
                $upload = new \Think\Upload();
                $upload->maxSize   =     3145728 ;//
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');//
                $upload->savePath  =      'GoodsImage/';
                $info   =   $upload->upload();
                if(!$info) {
                    $this->error($upload->getError());
                }else{
                    $data['goods_img_ori'] = $info['goods_img_ori']['savepath'].$info['goods_img_ori']['savename'];
                }
            }
            if($model->save($data)){
                $this->success('修改成功',U('Goods/GoodsList'));
            }else{
                $this->error('修改失败,请检查是否有非法字符');
            }
            exit;
        }
        $model = M('Goods');
        $goods_info = $model->where("goods_id = '%d'",array($goods_id))->find();
        $model = M('GoodsClass');
        $result = $model->where('is_show = 1')->order('sort desc')->select();
        $result = getTree($result);
        $this->assign('class_info',$result);
        $this->assign('goods_info',$goods_info);
        $this->display('modgoods');
    }
    public function addGoods()
    {
        if(IS_POST){
            $model = M('Goods');
            $goods_name = I('post.goods_name','');
            $goods_num = I('post.goods_num',0);
            $goods_class = I('post.goods_class',0);
            $is_on_sale = I('post.is_on_sale',0);
            $goods_ct_price = I('post.goods_ct_price',0);
            $goods_cu_price = I('post.goods_cu_price',0);
            $goods_ag_price = I('post.goods_ag_price',0);
            $goods_mem_price = I('post.goods_mem_price',0);
            $goods_price = I('post.goods_price',0);
            $is_discount = I('post.is_discount',0);
            $goods_discount = I('post.goods_discount',0);
            $goods_sort = I('post.goods_sort',0);
            $goods_des = I('post.goods_des','','trim');
            $data = array(
                'goods_name' => $goods_name,
                'goods_num' => $goods_num,
                'goods_class' => $goods_class,
                'is_on_sale' => $is_on_sale,
                'goods_ct_price' => $goods_ct_price,
                'goods_cu_price' => $goods_cu_price,
                'goods_ag_price' => $goods_ag_price,
                'goods_mem_price' => $goods_mem_price,
                'goods_price' => $goods_price,
                'is_discount' => $is_discount,
                'goods_discount' => $goods_discount,
                'goods_sort' => $goods_sort,
                'goods_des' => $goods_des,
                'create_time' => time(),
            );
            $upload = new \Think\Upload();
            $upload->maxSize   =     3145728 ;//
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');//
            $upload->savePath  =      'GoodsImage/';
            $info   =   $upload->upload();
            if(!$info) {
                $this->error($upload->getError());
            }else{
                $data['goods_img_ori'] = $info['goods_img_ori']['savepath'].$info['goods_img_ori']['savename'];
            }
            if($model->add($data)){
                $this->success('添加完成',U('Goods/GoodsList'));
            }else{
                $this->error('添加失败,请检查是否有非法字符',U('Goods/addGoods'));
            }
            exit;
        }
        $model = M('GoodsClass');
        $result = $model->where('is_show = 1')->order('sort desc')->select();
        $result = getTree($result);
        $this->assign('class_info',$result);
        $this->display('addgoods');
    }
    public function delGoods($goods_id)
    {
        $GoodsClass = M('Goods');
        if($GoodsClass->delete($goods_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function goodsClass()
    {
        $model = M('GoodsClass');
        $result = $model->order('sort asc')->select();
        $result = getTree($result);
        $this->assign('class_info',$result);
        $this->display('goodsclass');
    }
    public function addClass()
    {
        if(IS_POST){
            $model = M('GoodsClass');
            $class_name = I('post.class_name','');
            $is_show = I('post.is_show',0);
            $parent_id = I('post.parent_id',0);
            $sort = I('post.sort',0);
            $model->create(array(
                'class_name' => $class_name,
                'is_show' => $is_show,
                'sort' => $sort,
                'parent_id' => $parent_id
            ));
            if($model->add()){
                $this->success('添加完成',U('Goods/goodsClass'));
            }else{
                $this->error('添加失败',U('Goods/addClass'));
            }
            exit;
        }
        $model = M('GoodsClass');
        $result = $model->where('is_show = 1')->order('sort desc')->select();
        $result = getTree($result);
        $this->assign('class_info',$result);
        $this->display('addclass');
    }

    public function modClass($class_id)
    {
        if(IS_POST){
            $model = M('GoodsClass');
            $class_name = I('post.class_name','');
            $is_show = I('post.is_show',0);
            $parent_id = I('post.parent_id',0);
            $sort = I('post.sort',0);
            $model->create(array(
                'class_id' => $class_id,
                'class_name' => $class_name,
                'is_show' => $is_show,
                'sort' => $sort,
                'parent_id' => $parent_id
            ));
            if($model->save()){
                $this->success('更改完成',U('Goods/goodsClass'));
            }else{
                $this->error('更改失败');
            }
            exit;
        }
        $model = M('GoodsClass');
        $mode_info = $model->where("class_id = '%d'",array($class_id))->find();
        $result = $model->where('is_show = 1')->order('sort desc')->select();
        $result = getTree($result);
        $this->assign('class_info',$result);
        $this->assign('mode_info',$mode_info);
        $this->display('modclass');
    }

    public function delClass($class_id)
    {
        $GoodsClass = M('GoodsClass');
        if($GoodsClass->delete($class_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
}