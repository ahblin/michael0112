<?php
namespace Admin\Controller;

class GoodsController extends BaseController
{
    protected $meta_title='商品';

    //需要在create之后传入post数据处理
    protected $trans=true;


    /**
     * 钩子方法,用于覆盖父类钩子方法
     */
    protected function _befor_display(){
        //准备分类列表
        $model = D('GoodsCategory');
        $jsonlist = $model->getJson('id,name,parent_id');
        $this->assign('zNodes',$jsonlist);


        //准备品牌列表
        $model = D('Brand');
        $brand_list = $model->getListNoPage('id,name');
        $this->assign('brand_lists',$brand_list);


        //准备供货商列表
        $model = D('Supplier');
        $supplier_list = $model->getListNoPage('id,name');
        $this->assign('supplier_lists',$supplier_list);


        //准备简介的数据,add和编辑唯一区别就是有id
        $id=I('get.id');
        if($id){
            $model = M('GoodsIntro');
            $row = $model->find($id);
            $this->assign('goods_intro',$row);
        }
    }

}