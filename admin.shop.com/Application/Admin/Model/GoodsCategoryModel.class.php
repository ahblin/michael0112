<?php
namespace Admin\Model;

use Admin\Service\NestedSetsService;

class GoodsCategoryModel extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate = array(
        array('name','require','分类名称不能够为空'),
        array('parent_id','require','父分类不能够为空'),
        array('lft','require','左边界不能够为空'),
        array('rgt','require','右边界不能够为空'),
        array('level','require','层级不能够为空'),
        array('status','require','是否显示不能够为空'),
    );
    public function getList($wheres = array())
    {
        //定义每页显示的数据的限制  status>-1
        $wheres['status'] = array('gt', -1);
        //每页显示条数
        $rows = $this->where($wheres)->order('lft')->select();
        //将结果返回
        return array('rows' => $rows);
    }
    public function getJson(){
        $wheres['status'] = array('gt', -1);
        $rows = $this->field('id,name,parent_id')->where($wheres)->order('lft')->select();
        return json_encode($rows);
    }
    public function add(){
        //创建可以执行sql的类对象
        $nsmodel = new NestedSetsModel();
        //计算边界
        $result = new NestedSetsService($nsmodel,'goods_category','lft','rgt','parent_id','id','level');
        //$result = new NestedSetsService($nsmodel,'goods_category','lft','rgt','parent_id','id','level');
        //添加的节点信息放到哪个父节点下. 并且返回该节点对应的id
        return $result->insert($this->data['parent_id'],$this->data,'bottom');
    }

    public function save(){
        //>>1.创建能够执行sql的对象
        $dbMysql = new DbMysqlInterfaceImplModel();

        //>>2.计算边界
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');

        //>>3.将指定的节点移动一个父分类下面
        $nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);

        //>>4.需要将请求中的其他数据修改到数据库中
        return parent::save();
    }
}