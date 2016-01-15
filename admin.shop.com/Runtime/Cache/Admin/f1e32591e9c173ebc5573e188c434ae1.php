<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title> 管理中心 -  <?php echo ($meta_title); ?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://admin.shop.com/Public/css/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery1-11.3.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/common.js" ></script>
    
    <link rel="stylesheet" href="http://admin.shop.com/Public/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"> <?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#"> 管理中心</a></span>
    <span id="search_id" class="action-span1"> -  <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">

    <form method="post" action="<?php echo U();?>" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">分类名称</td>
                <td>
                    <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/>
                </td>
            </tr>
            <tr>
                <td class="label">父分类</td>
                <td>
                    <input type='hidden' class="parent_id" name='parent_id' value="0"/>
                    <input type='text' class="parent_name" name='parent_name' maxlength='60' value='默认顶级分类' disabled="disabled"/>
                    <ul id="treeDemo" class="ztree" ></ul>
                </td>
            </tr>
            <tr>
                <td class="label">分类简介</td>
                <td>
                    <textarea name='intro' cols='60' rows='4'><?php echo ($intro); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type='radio' class='status' name='status' value='1'/> 是
                    <input type='radio' class='status' name='status' value='0'/> 否
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br/>
                    <input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <input type="submit" class="button " value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>

</div>
<script>
    $(function(){
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>

    <script type="text/javascript" src="http://admin.shop.com/Public/ztree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" >
        $(function(){

            //将模板中的代码copy过来修改
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    },
                },
                //设置点击事件,将选中的名字和id放到上面的显示框和隐藏域中
                callback: {
                    onClick: function(event, treeId, treeNode){  //treeNode就是点击的这个节点
                        //将节点的id(就是数据库中的id) 和节点的name复制给  parent_name和parent_id表单元素
                        $('.parent_id').val(treeNode.id);
                        $('.parent_name').val(treeNode.name);

                    }
                }
            };

            //得到符合规则的json字符串
            var zNodes =<?php echo ($zNodes); ?>;

            //找到字符串,并创建树对象treeObj
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);

            <?php if(empty($id)): ?>treeObj.expandAll(true);
            <?php else: ?>
                //如果是编辑,需要回显,根据接收到的一条数据中的parent_id选中对象选项
                var parent_id= <?php echo ($parent_id); ?>;
                //找到父节点对应的节点
                var node = treeObj.getNodeByParam("id",parent_id);
                //选中此节点
                treeObj.selectNode(node);
                //将选中的节点信息更新到隐藏域的id,和显示框的名字中
                $('.parent_id').val(node.id);
                $('.parent_name').val(node.name);<?php endif; ?>







            /*<?php if(empty($id)): ?>//表示添加,  展开所有的节点
                    treeObj.expandAll(true);
            <?php else: ?>
            //表示编辑. 从treeObj中找到需要被选中的节点对象
            var parent_id = <?php echo ($parent_id); ?>;
            var node = treeObj.getNodeByParam('id',parent_id); //根据parent_id自己的值,找自己对应的节点
            treeObj.selectNode(node); //通过树对象treeObj 选中 找到的节点node

            //将选中的节点的名字和id赋值给表单元素
            $('.parent_name').val(node.name);
            $('.parent_id').val( node.id);<?php endif; ?>*/
        })
    </script>

<div id="footer">
Made By Michael</div>
</body>
</html>