<?php
namespace Admin\Model;

class ArticleModel extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate_1 = array(
        array('name','require','文章名称不能够为空'),
        array('article_category_id','require','文章分类ID不能够为空'),
        array('inputtime','require','录入时间不能够为空'),
        array('status','require','是否显示不能够为空'),
            );


    public function add($postData){
        $this->startTrans();//开启事务

        //更新article表
        $id = parent::add();
        if($id===false){
            $this->rollback();//可以不用提醒,add会有提示
            return false;
        }

        //更新atricle_content表
        $model = M('ArticleContent');
        $result = $model->add(array('article_id'=>$id,'content'=>$postData['article_content']));
        if($result===false){
            $this->rollback();
            $this->error = '保存文章内容失败!';
            return false;
        }

        //提交事务
        $this->commit();

        return $result;
    }
    public function edit(){
        echo 111;
        exit;
    }
}