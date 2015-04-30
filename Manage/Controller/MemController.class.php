<?php
namespace Manage\Controller;
use Think\Controller;
class MemController extends BaseController {

    public function orderList()
    {
        $Model = M();
        $sql = "SELECT m.mem_name,m.mem_card_num,m.mem_type,m.mem_int,o.* FROM `order` AS o LEFT JOIN `mem` AS m ON m.mem_card_num = o.mem_card_num";
        $order_info = $Model->query($sql);
        $this->assign('order_info',$order_info);
        $this->display();
    }
    public function delOrder($order_id)
    {
        $GoodsClass = M('Order');
        if($GoodsClass->delete($order_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function modOrder($order_id)
    {
        if(IS_POST){
            $model = M('Order');
            $start_time = strtotime(I('post.start_time',''));
            $end_time = strtotime(I('post.end_time',''));
            $sale_price = I('post.sale_price',0);
            $mem_card_num = I('post.mem_card_num',0);
            $model->create(array(
                'order_id' => $order_id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'sale_price' => $sale_price,
                'mem_card_num' => $mem_card_num
            ));
            if($model->save()){
                $this->success('更改完成',U('Mem/orderList'));
            }else{
                $this->error('更改失败');
            }
            exit;
        }
        $model = M('Order');
        $order_info = $model->where("order_id = '%d'",array($order_id))->find();
        $this->assign('order_info',$order_info);
        $this->display();
    }

    public function addOrder()
    {
        if(IS_POST){
            $model = M('Order');
            $start_time = strtotime(I('post.start_time',''));
            $end_time = strtotime(I('post.end_time',''));
            $sale_price = I('post.sale_price',0);
            $mem_card_num = I('post.mem_card_num',0);
            $model->create(array(
                'start_time' => $start_time,
                'end_time' => $end_time,
                'sale_price' => $sale_price,
                'mem_card_num' => $mem_card_num
            ));
            if($model->add()){
                $this->success('添加完成',U('Mem/OrderList'));
            }else{
                $this->error('添加失败,请检查数据是否输入完整或者含有特殊字符');
            }
            exit;
        }
        $this->display();
    }
    public function modMem($mem_id)
    {
        if(IS_POST){
            $model = M('Mem');
            $mem_name = I('post.mem_name','');
            $mem_pwd = I('post.mem_pwd','');
            $mem_email = I('post.mem_email','');
            $mem_phone = I('post.mem_phone','');
            $mem_id_card = I('post.mem_id_card',0);
            $mem_card_num = I('post.mem_card_num',0);
            $mem_type = I('post.mem_type',0);
            $mem_int = I('post.mem_int',0);
            $is_show_ct = I('post.is_show_ct',0);
            $is_show_cu = I('post.is_show_cu',0);
            $is_show_ag = I('post.is_show_ag',0);
            $is_show_mem = I('post.is_show_mem',0);
            $is_show_price = I('post.is_show_price',0);
            $is_show_disc = I('post.is_show_disc',0);
            $data = array(
                'mem_id' => $mem_id,
                'mem_name' => $mem_name,
                'mem_pwd' => $mem_pwd,
                'mem_email' => $mem_email,
                'mem_phone' => $mem_phone,
                'mem_id_card' => $mem_id_card,
                'mem_card_num' => $mem_card_num,
                'mem_type' => $mem_type,
                'mem_int' => $mem_int,
                'is_show_ct' => $is_show_ct,
                'is_show_cu' => $is_show_cu,
                'is_show_ag' => $is_show_ag,
                'is_show_mem' => $is_show_mem,
                'is_show_price' => $is_show_price,
                'is_show_disc' => $is_show_disc,
                'create_time' => time()
            );
            if($model->save($data)){
                $this->success('修改成功',U('Mem/memlist'));
            }else{
                $this->error('修改失败,请检查是否有非法字符');
            }
            exit;
        }
        $model = M('Mem');
        $mem_info = $model->where("mem_id = '%d'",array($mem_id))->find();
        $this->assign('mem_info',$mem_info);
        $this->display('modmem');
    }
    public function delMem($mem_id)
    {
        $GoodsClass = M('Mem');
        if($GoodsClass->delete($mem_id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }
    public function addMem()
    {
        if(IS_POST){
            $model = M('Mem');
            $mem_name = I('post.mem_name','');
            $mem_pwd = I('post.mem_pwd','');
            $mem_email = I('post.mem_email','');
            $mem_phone = I('post.mem_phone','');
            $mem_id_card = I('post.mem_id_card',0);
            $mem_card_num = I('post.mem_card_num',0);
            $mem_type = I('post.mem_type',0);
            $mem_int = I('post.mem_int',0);
            $is_show_ct = I('post.is_show_ct',0);
            $is_show_cu = I('post.is_show_cu',0);
            $is_show_ag = I('post.is_show_ag',0);
            $is_show_mem = I('post.is_show_mem',0);
            $is_show_price = I('post.is_show_price',0);
            $is_show_disc = I('post.is_show_disc',0);
            $data = array(
                'mem_name' => $mem_name,
                'mem_pwd' => $mem_pwd,
                'mem_email' => $mem_email,
                'mem_phone' => $mem_phone,
                'mem_id_card' => $mem_id_card,
                'mem_card_num' => $mem_card_num,
                'mem_type' => $mem_type,
                'mem_int' => $mem_int,
                'is_show_ct' => $is_show_ct,
                'is_show_cu' => $is_show_cu,
                'is_show_ag' => $is_show_ag,
                'is_show_mem' => $is_show_mem,
                'is_show_price' => $is_show_price,
                'is_show_disc' => $is_show_disc,
                'create_time' => time()
            );

            if($model->add($data)){
                $this->success('添加完成',U('Mem/addmem'));
            }else{
                $this->error('添加失败,请检查是否有非法字符',U('Mem/addmem'));
            }
            exit;
        }
        $this->display('addmem');
    }

    public function memList()
    {
        $model = M('Mem');
        $result = $model->order('mem_id desc')->select();
        $this->assign('mem_info',$result);
        $this->display();
    }
}