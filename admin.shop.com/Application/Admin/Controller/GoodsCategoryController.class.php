<?php
namespace Admin\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title='商品分类';


    /**
     * 钩子方法,用于覆盖父类钩子方法
     */
    protected function _beforDisplay(){
        $jsonlist = $this->model->getJson();
        $this->assign('zNodes',$jsonlist);
    }
}