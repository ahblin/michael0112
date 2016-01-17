<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/17
 * Time: 16:35
 */

namespace Admin\Model;


class GoodsMemberPriceModel extends BaseModel
{
    public function getPrice($id){
        $theres=array();
        $theres['goods_id']  = array('eq',$id);
        $rows = $this->getListNoPage('member_level_id,price',$theres);
        //处理数据,将id作为键,price作为值,方便页面显示
        $res = array();
        foreach ($rows as $v) {
            $res[$v['member_level_id']] = $v['price'];
        }
        return $res;
    }


    /**
     * 找到商品对应会员级别价格
     * @param string $field
     * @param array $wheres
     * @return mixed
     */
    public function getListNoPage($field = "*",$wheres=array())
    {
        return $this->field($field)->where($wheres)->select();
    }
}