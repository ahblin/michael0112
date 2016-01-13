<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>管理中心 - 商品供应商 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://admin.shop.com/Public/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="http://admin.shop.com/Public/css/page.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/jquery1-11.3.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/js/common.js"></script>
    <!--为以后子模板中的css留一个位置-->
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加供应商</a></span>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品供应商 </span>

    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="" name="searchForm">
            <img src="http://admin.shop.com/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
            <input type="text" name="search" size="15" value="<?php echo ($search); ?>"/>
            <input type="submit" value=" 搜索 " class="button"/>
        </form>
    </div>

<input type="button" value=" 删除 " class="button ajax-post" url="<?php echo U('changeStatus');?>"/>
<input type="button" value=" 显示 " class="button ajax-post" url="<?php echo U('changeStatus',array('status'=>1));?>"/>
<input type="button" value=" 隐藏 " class="button ajax-post" url="<?php echo U('changeStatus',array('status'=>0));?>"/>

    <form method="post" action="" name="listForm">
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th>全选 <input type="checkbox" class="allChoose"></th>
                    <th>品牌名称</th>
                    <th>品牌网址</th>
                    <th>品牌LOGO</th>
                    <th>排序</th>
                    <th>品牌简介</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td width="30"><?php echo ($row["id"]); ?><input type="checkbox" name="id[]" value="<?php echo ($row["id"]); ?>" class="choose">
                        </td>
                        <td class='first-cell' align='center'><?php echo ($row["name"]); ?></td>
                        <td align='center'><?php echo ($row["url"]); ?></td>
                        <td align='center'><img src="http://admin.shop.com/Uploads/<?php echo ($row["logo"]); ?>" width="30"></td>
                        <td align='center'><?php echo ($row["sort"]); ?></td>
                        <td align='center'><?php echo ($row["intro"]); ?></td>
                        <td align="center"><a class="ajax-get"
                                              href="<?php echo U('changeStatus',array('id'=>$row['id'],'status'=>(1-$row['status'])));?>"><img
                                src="http://admin.shop.com/Public/images/<?php echo ($row["status"]); ?>.gif"/></a></td>
                        <td align="center">
                            <a class="ajax-post" href="<?php echo U('edit',array('id'=>$row['id']));?>" title="编辑">编辑</a> |
                            <a class="ajax-get" href="<?php echo U('changeStatus',array('id'=>$row['id']));?>" title="编辑">移除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div id="turn-page" class="page">
                <?php echo ($pageTool); ?>
            </div>
        </div>
    </form>


<!--为以后的子模板预留js的位置-->
<div id="footer">
    Made By Michael
</div>
</body>
</html>