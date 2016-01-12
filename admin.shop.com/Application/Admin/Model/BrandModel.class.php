<?php
namespace Admin\Model;

class BrandModel extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate = array(
        array('name','require','品牌名称不能够为空'),
        array('url','require','品牌网址不能够为空'),
        array('logo','require','品牌LOGO不能够为空'),
        array('sort','require','排序不能够为空'),
        array('status','require','是否显示不能够为空'),
            );
}