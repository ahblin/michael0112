<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/18
 * Time: 23:25
 */

namespace Admin\Model;


class GoodsArticleModel extends BaseModel
{
    public function getArticle($id){
        $this->alias('ga');
        $this->field('ga.article_id as article_id,a.name as article_name');
        $this->join('JOIN article AS a ON a.id = ga.article_id');
        $rows = $this->where("ga.goods_id=$id")->select();
        return $rows;
    }
}