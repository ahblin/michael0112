<?php
namespace Admin\Controller;

class ArticleController extends BaseController
{
    protected $meta_title='文章';
    protected $trans=true;//默认不传

    public function _before_edit_display(){
        $model = M('ArticleCategory');
        $rows = $model->select();
        $this->assign('article_categorys',$rows);
    }

    public function search($name){
        //准备搜索数据
        $model = D('Article');
        $wheres['name']=array('like',"%{$name}%");
        $rows = $model->field('id,name')->where($wheres)->select();
        $this->ajaxReturn($rows);
    }
}