<?php
namespace Admin\Model;

class GoodsModel extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate = array(
        /*array('name','require','商品名称不能够为空'),
        array('short_name','require','简称不能够为空'),
        array('sn','require','货号不能够为空'),
        array('goods_category_id','require','商品分类不能够为空'),
        array('brand_id','require','商品品牌不能够为空'),
        array('supplier_id','require','供货商不能够为空'),
        array('shop_price','require','本店价格不能够为空'),
        array('market_price','require','市场价格不能够为空'),
        array('logo','require','商品LOGO不能够为空'),
        array('stock','require','库存不能够为空'),
        array('goods_status','require','商品状态不能够为空'),
        array('status','require','是否显示不能够为空'),*/
            );
    public function add($postData){
        $this->startTrans();//开启事物

        //更新goods表
        $this->dealStatus();//处理status
        $id = parent::add();
        if($id===false){
            $this->rollback();//可以不用提醒,add会有提示
            return false;
        }

        //生成sn
        $sn = date('Ymd').str_pad($id,9,0,STR_PAD_LEFT );
        $rst = parent::save(array('id'=>$id,'sn'=>$sn));
        if($rst===false){
            $this->rollback();
            $this->error = '保存货号失败!';
            return false;
        }

        //将intro加入goods_intro表格
        $model = M('GoodsIntro');
        $result = $model->add(array('goods_id'=>$id,'intro'=>$postData['intro']));
        if($result===false){
            $this->rollback();
            $this->error = '保存商品描述失败!';
            return false;
        }

        //更新goods_member_price表
        $result = $this->dealPrice($id,$postData);


        //提交事务
        $this->commit();
        return $id;
    }

    /**
     *
     * 处理status的值方便输出到网页
     * @param mixed|string $postData
     * @return bool
     */
    public function save($postData){
        $id = $this->data['id'];
        $this->startTrans();//开启事物

        //更新goods表
        $this->dealStatus();//处理status
        $rst = parent::save();
        if($rst===false){
            $this->rollback();
            return false;
        }
        //更新goods_intro表
        $model = M('GoodsIntro');
        $result = $model->save(array('goods_id'=>$id,'intro'=>$postData['intro']));
        if($result===false){
            $this->rollback();
            $this->error = '保存商品描述失败!';
            return false;
        }

        //更新goods_member_price表
        $result = $this->dealPrice($id,$postData);

        //提交事务
        $this->commit();
        return $rst;


    }

    private function dealPrice($id,$postData){
        $model = D('GoodsMemberPrice');

        //先删除id对应的数据
        $result = $model->where("goods_id=$id")->delete();
        if($result===false){
            $this->rollback();
            $this->error = '保存商品会员价格失败!';
            return false;
        }

        //再输入id相关的信息
        $adddvalue=array();
        foreach($postData['member_level_price'] as $k=> $v){
            $adddvalue[] = array('goods_id'=>$id,'member_level_id'=>$postData['member_level_id'][$k],'price'=>$postData['member_level_price'][$k]);
        }
        $result = $model->addAll($adddvalue);
        if($result===false){
            $this->rollback();
            $this->error = '保存商品分类价格失败!';
            return false;
        }
        return $result;
    }


    private function dealStatus(){
        $goods_status=0;
        foreach($this->data['goods_status'] as $v){
            $goods_status = $goods_status | $v;
        }
        $this->data['goods_status'] = $goods_status;
    }

    public function changeStatus($id, $status = -1)
    {
        //开启事物
        $this->startTrans();
        $goods_data = array('status' => $status, 'id' => array('in', $id));
        $goods_intro_data = array('status' => $status, 'goods_id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', "CONCAT(name,'_del')");
        }
        //删除goods表数据
        $rst = parent::save($goods_data);
        if($rst===false){
            $this->rollback();
            $this->error = '删除商品失败!';
            return false;
        }
        //删除goods_intro表数据
        $model = M('GoodsIntro');
        $result= $model->save($goods_intro_data);
        if($result===false){
            $this->rollback();
            $this->error = '删除描述失败!';
            return false;
        }

        //删除goods_member_price表信息
        $model = D('GoodsMemberPrice');

        //先删除id对应的数据
        $result = $model->where("goods_id=$id")->delete();
        if($result===false){
            $this->rollback();
            $this->error = '删除分级价格失败!';
            return false;
        }

        $this->commit();
        return $rst;
    }
}