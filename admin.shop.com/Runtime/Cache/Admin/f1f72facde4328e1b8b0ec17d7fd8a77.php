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
    
    <link rel="stylesheet" href="http://admin.shop.com/Public/ztree/css/zTreeStyle/zTreeStyle.css" type="text/css">

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="<?php echo U('Index/index');?>" target="_top">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="<?php echo U();?>" name="searchForm" method="get">
            <img src="http://admin.shop.com/Public/images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
            <input type="text" name="search" size="15" value="<?php echo ($search); ?>" placeholder="请输入关键字"/>
            <input id="citySel" type="text" class="goods_category" size="15" value="" placeholder="请选择分类" readonly="readonly"/>
            <input type="hidden" id="goods_category_id" name="goods_category_id" value="">
            <div id="menuContent" class="menuContent" style="display:none; position: absolute;">
                <ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul>
            </div>
            <?php echo arr2select('brand_id',$brand_lists,I('get.brand_id'));?>
            <?php echo arr2select('supplier_id',$supplier_lists,I('get.supplier_id'));?>
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
                    <th>商品名称</th>
                    <th>简称</th>
                    <th>货号</th>
                    <th>商品分类</th>
                    <th>商品品牌</th>
                    <th>供货商</th>
                    <th>本店价格</th>
                    <th>市场价格</th>
                    <th>精品</th>
                    <th>新品</th>
                    <th>热销</th>
                    <th>库存</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td width="30"><?php echo ($row["id"]); ?><input type="checkbox" name="id[]" value="<?php echo ($row["id"]); ?>" class="choose">
                        </td>
                        <td class='first-cell' align='center'><?php echo ($row["name"]); ?></td>
                        <td align='center'><?php echo ($row["short_name"]); ?></td>
                        <td align='center'><?php echo ($row["sn"]); ?></td>
                        <td align='center'><?php echo ($row["goods_category_name"]); ?></td>
                        <td align='center'><?php echo ($row["brand_name"]); ?></td>
                        <td align='center'><?php echo ($row["supplier_name"]); ?></td>
                        <td align='center'><?php echo ($row["shop_price"]); ?></td>
                        <td align='center'><?php echo ($row["market_price"]); ?></td>
                        <td align='center'><img src="http://admin.shop.com/Public/images/<?php echo ($row["is_best"]); ?>.gif"/></td>
                        <td align='center'><img src="http://admin.shop.com/Public/images/<?php echo ($row["is_new"]); ?>.gif"/></td>
                        <td align='center'><img src="http://admin.shop.com/Public/images/<?php echo ($row["is_hot"]); ?>.gif"/></td>
                        <td align='center'><?php echo ($row["stock"]); ?></td>
                        <td align="center">
                            <a class="ajax-get" href="<?php echo U('changeStatus',array('id'=>$row['id'],'status'=>(1-$row['status'])));?>">
                                <img src="http://admin.shop.com/Public/images/<?php echo ($row["status"]); ?>.gif"/>
                            </a>
                        </td>
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



    <script type="text/javascript" src="http://admin.shop.com/Public/ztree/js/jquery.ztree.core-3.5.js"></script>
    <script>
        $(function(){
            /**********************************分类树状展示 开始*************************************************/
            //将模板中的代码copy过来修改
            var setting = {
                view: {
                    dblClickExpand: false
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id"
                    }
                },
                callback: {
                    onClick: onClick
                }
            };

            //得到符合规则的json字符串
            var zNodes =<?php echo ($zNodes); ?>;



            function onClick(e, treeId, treeNode) {
                console.debug(treeNode);
                var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
                        nodes = zTree.getSelectedNodes(),
                        v = "";
                nodes.sort(function compare(a,b){return a.id-b.id;});
                for (var i=0, l=nodes.length; i<l; i++) {
                    v += nodes[i].name + ",";
                }
                if (v.length > 0 ) v = v.substring(0, v.length-1);
                var cityObj = $("#citySel");
                var goos_category_id_Obj = $("#goods_category_id");
                cityObj.attr("value", v);
                goos_category_id_Obj.attr("value", treeNode.id);
            }

            function showMenu() {
                var cityObj = $("#citySel");
                var cityOffset = $("#citySel").offset();
                $("#menuContent").css({left:cityOffset.left + "px", top:cityOffset.top + cityObj.outerHeight() + "px"}).slideDown("fast");

                $(window.document).bind("mousedown", onBodyDown);
            }
            function hideMenu() {
                $("#menuContent").fadeOut("fast");
                $(window.document).unbind("mousedown", onBodyDown);
            }
            function onBodyDown(event) {
                if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length>0)) {
                    hideMenu();
                }
            }

            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            treeObj.expandAll(true);
            $('.goods_category').click(function(){
                showMenu();
            })


            <?php if(!empty($_GET['goods_category_id'])): ?>var goods_category_id = <?php echo ($_GET['goods_category_id']); ?>;
                var node = treeObj.getNodeByParam('id',goods_category_id);
                $('#goods_category_id').val(node.id);
                $('#citySel').val(node.name);<?php endif; ?>
        })
    </script>

<div id="footer">
    Made By Michael
</div>
</body>
</html>