<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/9
 * Time: 14:12
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    //定义模型类
    protected $model;
    //定义一个变量限制在create之后还需不需要将post数据传给模型处理
    protected $trans=false;//默认不传

    //避免覆盖父类构造函数
    public function _initialize()
    {
        $this->model = D(CONTROLLER_NAME);
    }

    /**
     * 增删改查的查
     * 显示每页的信息和分页工具条
     */
    public function index()
    {
        //获得get穿过来的search
        $search = I('get.search', '');
        cookie('search', $search);
        if (cookie('search')) {
            $search = urldecode($search);
        }

        //设定查询的条件
        if (!empty($search)) {
            $wheres['name'] = array('like', "%$search%");
        }
        $pageResult = $this->model->getListWithPage($wheres);
        //将查询语句发配到网页,方便回显
        $pageResult['search'] = $search;
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title);
        //分配好数据后,将访问的url地址保存到cookie里面,方便下面方法调用
        $urlmsg = $_SERVER['REQUEST_URI'];
        cookie('url', $urlmsg);

        //设定钩子方法,为了子类覆盖,为主页显示之前提供数据
        $this->_before_index_display();
        $this->display('index');
    }


    /**
     * 用于子类覆盖,为了再index显示之前提供数据
     */
    protected function _before_index_display(){

    }
    /**
     * 钩子方法,在每个页面展示之前,用于各个控制器操作或获得其他信息
     */
    protected function _before_edit_display(){}

    /**
     * 增删改查的改
     * @param $id
     */
    public function edit($id)
    {
        if (IS_POST) {
            //获得数据
            if ($this->model->create() !== false) {
                if ($this->model->save($this->trans?I('post.'):'') !== false) {
                    //成功后返回cookie保存的地址
                    $this->success('操作成功!', cookie('url'));
                    return;
                };
            };
            $this->error('操作失败' . model_error($this->model));
        } else {
            //用id查找一条数据
            $row = $this->model->find($id);
            //将数据分配到页面
            $this->assign($row);
            $this->_before_edit_display();
            $this->assign('meta_title', '编辑' . $this->meta_title);
            //选择显示页面
            $this->display('edit');
        }

    }

    /**
     * 增删改查的增
     */
    public function add()
    {
        if (IS_POST) {
            //获得数据
            if ($this->model->create() !== false) {
                if ($this->model->add($this->trans?I('post.'):'') !== false) {
                    //成功后返回cookie保存的地址
                    $this->success('操作成功!', cookie('url'));
                    return;
                };
            };
            $this->error('操作失败' . model_error($this->model));
        } else {
            $this->_before_edit_display();
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**
     * 修改删除专用方法:修改status的值
     * @param $id
     * @param int $status
     */
    public function changeStatus($id, $status = -1)
    {
        if ($this->model->changeStatus($id, $status) !== false) {
            //成功后返回cookie保存的地址
            $this->success('操作成功!', cookie('url'));
        } else {
            $this->error('操作失败' . model_error($this->model));
        }
    }
}