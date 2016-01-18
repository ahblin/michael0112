<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/17
 * Time: 20:27
 */

namespace Admin\Model;


class GoodsPhotoModel extends BaseModel
{
    public function getPhoto($id){
        $rows = $this->where("goods_id=$id")->select();
        return $rows;
    }
    public function remove($id){
        return $this->where(array('id'=>$id))->delete();
    }
}