<?php
namespace Admin\Model;

class MemberLevelModel extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate = array(
        array('name','require','会员级别名称不能够为空'),
        array('low','require','最低积分不能够为空'),
        array('high','require','最高积分不能够为空'),
        array('discount','require','折扣不能够为空'),
        array('status','require','是否显示不能够为空'),
            );
}