<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/9
 * Time: 14:23
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    //开启批量验证
    protected $patchValidate = true;

    public function getListWithPage($wheres = array())
    {
        //定义pageRasult为数组,rows为每页数据显示,pageTool是分页工具条
        //定义每页显示的数据的限制  status>-1
        $wheres['status'] = array('gt', -1);
        //分页工具条
        $totalRows = $this->where($wheres)->count();
        $listRows = 2;
        //生成page对象,并设置分页工具条的显示状态
        $pageModel = new Page($totalRows, $listRows);
        //设置分页工具条的外观
        $pageModel->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $pageTool = $pageModel->show();
        //如果总行数小于或等于每页起始行数,则将起始行数设置为总行数减去每页显示的行数
        if ($totalRows <= $pageModel->firstRow) {
            $pageModel->firstRow = $totalRows - $listRows;
            if ($pageModel->firstRow <= 0) {
                $pageModel->firstRow = 0;
            }
        }
        //每页显示条数
        $rows = $this->where($wheres)->limit($pageModel->firstRow, $pageModel->listRows)->select();
        //将结果返回
        return array('rows' => $rows, 'pageTool' => $pageTool);
    }

    /**
     * 查询出状态大于-1
     */
    public function getListNoPage($field = "*")
    {
        return $this->field($field)->where(array('status' => array('gt', -1)))->select();
    }

    /**
     * 点击删除,将status状态设置为-1
     * @param $id
     * @return bool
     */
    public function remove($id)
    {
        return parent::save(array('status' => -1, 'id' => $id));
    }

    /**
     * 修改删除专用方法:修改status的值
     * @param $id
     * @param int $status
     * @return bool
     */
    public function changeStatus($id, $status = -1)
    {
        $data = array('status' => $status, 'id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', "CONCAT(name,'_del')");
        }
        return parent::save($data);
    }
}