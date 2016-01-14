<?php
namespace Admin\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title='商品分类';

    /**
     * 增删改查的增
     */
    public function add()
    {
        if (IS_POST) {
            //获得数据
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    //成功后返回cookie保存的地址
                    $this->success('操作成功!', cookie('url'));
                    return;
                };
            };
            $this->error('操作失败' . model_error($this->model));
        } else {

            $jsonlist = $this->model->getJson();
            $this->assign('zNodes',$jsonlist);

            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }
    /**
     * 增删改查的改
     * @param $id
     */
    public function edit($id)
    {
        if (IS_POST) {
            //获得数据
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
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
            $jsonlist = $this->model->getJson();
            $this->assign('zNodes',$jsonlist);
            $this->assign('meta_title', '编辑' . $this->meta_title);
            //选择显示页面
            $this->display('edit');
        }

    }
}