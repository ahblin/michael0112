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
        /**
         * 以下是get方式访问之前需要准备数据
         */

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

        //准备会员级别的列表

        $model = D('MemberLevel');
        $member_level_list = $model->getListNoPage('id,name');
        $this->assign('member_level_list',$member_level_list);


        /**
         * 以下是post方式访问的时候需要准备的数据
         */

        //准备简介的数据,add和编辑唯一区别就是有id
        $id=I('get.id');
        if($id){
            //准备商品简介
            $model = M('GoodsIntro');
            $row = $model->find($id);
            $this->assign('goods_intro',$row);

            //准备商品价格的回显

            $model = D('GoodsMemberPrice');
            $rows = $model->getPrice($id);//得到关联数组
            $this->assign('goods_member_price',$rows);
        }
    }

}