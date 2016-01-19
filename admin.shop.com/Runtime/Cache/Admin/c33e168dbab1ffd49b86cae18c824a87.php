<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理中心 - 商品<?php echo ($meta_title); ?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/page.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery1-11.3.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/common.js"></script>
    
    <link rel="stylesheet" href="http://admin.shop.com/Public/treegrid/css/jquery.treegrid.css">

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>" target="_top">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="" name="searchForm">
            <img src="http://admin.shop.com/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
            <input type="text" name="search" size="15" value="<?php echo ($search); ?>"/>
            <input type="submit" value=" 搜索 " class="button"/>
        </form>
    </div>



    <form method="post" action="" name="listForm">
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1" class="tree">
                <tr>
                    <th>分类名称</th>
                    <th>分类简介</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr class="treegrid-<?php echo ($row["id"]); ?> <?php if(($row["parent_id"]) != "0"): ?>treegrid-parent-<?php echo ($row["parent_id"]); endif; ?>">
                        <td class='first-cell' align='left'><?php echo ($row["name"]); ?></td>
                        <td align='center'><?php echo ($row["intro"]); ?></td>
                        <td align="center"><a class="ajax-get"
                                              href="<?php echo U('changeStatus',array('id'=>$row['id'],'status'=>(1-$row['status'])));?>"><img
                                src="http://admin.shop.com/Public/images/<?php echo ($row["status"]); ?>.gif"/></a></td>
                        <td align="center">
                            <a href="<?php echo U('edit',array('id'=>$row['id']));?>" title="编辑">编辑</a> |
                            <a class="ajax-get" href="<?php echo U('changeStatus',array('id'=>$row['id']));?>" title="编辑">移除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div id="turn-page" class="page">
                <?php echo ($pageTool); ?>
            </div>
        </div>
    </form>



    <script type="text/javascript" src="http://admin.shop.com/Public/treegrid/js/jquery.treegrid.js"></script>
    <script>
        $(function () {
            $('.tree').treegrid();
        })
    </script>

<div id="footer">
    Made By Michael
</div>
</body>
</html>