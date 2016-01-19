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
    public function getListWithPage($wheres = array())
    {
        //定义每页显示的数据的限制  status>-1
        $wheres['status'] = array('gt', -1);
        //每页显示条数
        $rows = $this->where($wheres)->order('lft')->select();
        //将结果返回
        return array('rows' => $rows);
    }
    public function getJson($fields){
        $wheres['status'] = array('gt', -1);
        $rows = $this->field($fields)->where($wheres)->order('lft')->select();
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


    public function changeStatus($id, $status = -1)
    {
        //根据自己的id,找到子孙id,如果没有子孙,返回的是自己的id
        $sql = "select child.id from  goods_category as child,goods_category as parent where  parent.id = {$id}  and child.lft>=parent.lft  and child.rgt<=parent.rgt";
        $rows = $this->query($sql);
        $id  = array_column($rows,'id');
        $data = array('status' => $status, 'id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', "CONCAT(name,'_del')");
        }
        return parent::save($data);
    }

    /**
     * 根据分类ID找到子分类的id
     * @param $cid
     */
    public function getCategoryIds($cid){
        $sql = "select c.id from goods_category as p join goods_category as c on c.lft<=p.lft and c.rgt>=p.rgt where p.id ={$cid} ORDER BY c.lft";
        $rows = $this->query($sql);
        return array_column($rows,'id');
    }
}