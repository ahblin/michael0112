<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/14
 * Time: 15:57
 */

namespace Admin\Model;


/**
 * 实现接口,组成sql语句,但是需要注意每一个方法具体的返回值
 * Class NestedSetsModel
 * @package Admin\Model
 */
class NestedSetsModel implements  DbMysqlInterfaceModel
{
    //定义下面方法需要的模型类
    private $model;

    public function __construct(){
        $this->model = M();
    }
    public function connect()
    {
        // TODO: Implement connect() method.
        echo 'connect...';
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect...';
        exit;
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo 'free...';
        exit;
    }

    public function query($sql, array $args = array())
    {
        //>>1.根据实际的拼装出sql
        $finalSQL = $this->buildSQL(func_get_args());
        //$tempSQL = $this->buildSQL(func_get_args());
        //>>2.然后进行执行..
        return  $this->model->execute($finalSQL);
    }


    /**
     * INSERT INTO goods_category SET name='澶уお闃�',parent_id='4',intro='澶уお闃�',status='1',id='',lft='46',rgt='47',level='4'
     * @param string $sql
     * @param array $args
     */
    public function insert($sql, array $args = array())
    {

        //得到所有参数
        $params = func_get_args();
        //将sql模板弹出
        $sql = array_shift($params);
        //将表名弹出
        $table_name = array_shift($params);
        //将?T用表名替换
        $sql = str_replace('?T',$table_name,$sql);
        //循环剩下的$params,拼接成一个sql语句
        $tmp_sql = '';
        foreach($params[0] as $k =>$v){
            /*//id字段自增,不加入sql,如果不加此判断,需要到mysql.ini修改 sql-mod
            if($k=='id'){
                continue;
            }*/
            $tmp_sql.="{$k}='{$v}',";
        }
        //生成最终sql
        $sql = str_replace('?%',$tmp_sql,$sql);
        //除去最后的逗号
        $sql = rtrim($sql,',');
        //执行sql语句
        $rst = $this->model->execute($sql);
        if($rst!==false){
            return $this->model->getLastSql();
        }else{
            return false;
        }


        /*//>>1.获取实际参数
        //>>2.取出sql模板
        $sql = array_shift($params);
        //>>3.取出表名
        $table_name = array_shift($params);
        //>>4. 将sql模板中的?T换为表名
        $sql = str_replace('?T',$table_name,$sql);
        //>>5.取出需要插入数据库中的值
        $params = array_shift($params);
        $values = '';
        foreach($params as $k=>$v){
            $values.="{$k}='{$v}',";
        }
        $values = rtrim($values,',');
        $sql=str_replace('?%',$values,$sql);

        $model = M();
        $result = $model->execute($sql); //执行insert语句
        if($result===false){  //执行失败返回false
            return false;
        }else{
            //执行成功返回最后的id
            return $model->getLastInsID();//获取最后一个id值
        }*/
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo 'update...';
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo 'getAll...';
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo 'getAssoc...';
        exit;
    }

    /**
     * 根据sql查询出一行记录
     * @param string $sql
     * @param array $args
     */
    public function getRow($sql, array $args = array())
    {
        //>>1.得到真正传递过来的参数拼装SQL
        $finalSQL = $this->buildSQL(func_get_args());
        //>>2.执行sql
        $rows = $this->model->query($finalSQL);
        return empty($rows)?false:$rows[0];  //查询出来一行就返回一行, 没有查询出来就返回false


        //得到所有参数,并构建sql语句
        /*$parames = func_get_args();
        $rows = array_shift($parames);
        $pattern = '/\?[FTN]/';
        $rows = preg_split($pattern ,$rows);
        $finalSQL = '';
        foreach($rows as $k => $row){
            $finalSQL.=$row.$parames[$k];
        }
        //执行sql语句
        $result = $this->model->query($finalSQL);
        return empty($result)?false:$result[0];*/
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo 'getCol...';
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        //组成sql
        $finalSQL = $this->buildSQL(func_get_args());
        //得到二维数组
        $rows = $this->model->query($finalSQL);
        //取出需要返回的具体值
        $row = array_values($rows[0]);
        return empty($row)?false:$row[0];

        /*dump($row[0]);
        exit;
        $tempSQL = $this->buildSQL(func_get_args());
        $model = M();
        $rows = $model->query($tempSQL); //得到二维数组
        $row = $rows[0]; //得到其中的第一个小数组
        $values = array_values($row);  //小数组中的值
        return $values[0];  //值的第一元素.*/
    }


    /**
     * 根据参数拼装sql
     * @param $params
     */
    private  function buildSQL($params){
        $sql = array_shift($params);  //弹出的sql
        $sqls = preg_split('/\?[FTN]/',$sql);
        $tempSQL = '';
        foreach($sqls as $k=>$v){
            $tempSQL.= ($v.$params[$k]);
        }
        return $tempSQL;
    }

}