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
    <span class="action-span1"><a href="<?php echo U('Index/index');?>"> 管理中心</a></span>
    <span id="search_id" class="action-span1"> -  <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">

    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="detail-tab">详细描述</span>
            <span class="tab-back" id="mix-tab">会员价格</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab">商品相册</span>
            <span class="tab-back" id="article-tab">关联文章</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form method="post" action="<?php echo U();?>" enctype="multipart/form-data">
            <table cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td class="label">商品名称</td>
                    <td>
                        <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/>
                    </td>
                </tr>
                <tr>
                    <td class="label">简称</td>
                    <td>
                        <input type='text' name='short_name' maxlength='60' value='<?php echo ($short_name); ?>'/>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品分类</td>
                    <td>
                        <input type='hidden' class="goods_category_id" name='goods_category_id' />
                        <input type='text' class="goods_category_name" name='goods_category_name' maxlength='60' value='只能选择最小分类' disabled="disabled"/>
                        <ul id="treeDemo" class="ztree" ></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌</td>
                    <td>
                        <!--调用自动生成select的函数-->
                        <?php echo arr2select('brand_id',$brand_lists,$brand_id);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">供货商</td>
                    <td>
                        <!--调用自动生成select的函数-->
                        <?php echo arr2select('supplier_id',$supplier_lists,$supplier_id);?>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店价格</td>
                    <td>
                        <input type='text' name='shop_price' maxlength='60' value='<?php echo ($shop_price); ?>'/>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场价格</td>
                    <td>
                        <input type='text' name='market_price' maxlength='60' value='<?php echo ($market_price); ?>'/>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品LOGO</td>
                    <td>
                        <input type='file' class="uploadify-button" id="file_upload_1" maxlength='60'/>
                        <input type='hidden' class="logo" name="logo" value="<?php echo ($logo); ?>"/>

                        <div class="upload-img-box" style="display: none">
                            <div class="upload-pre-item" >
                                <img src="http://php1009-0114.b0.upaiyun.com/<?php echo ($logo); ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="label">库存</td>
                    <td>
                        <input type='text' name='stock' maxlength='60' value='<?php echo ($stock); ?>'/>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品状态</td>
                    <td>
                        <input type='checkbox' class='goods_status' name='goods_status[]' value='1'/> 精品
                        <input type='checkbox' class='goods_status' name='goods_status[]' value='2'/> 新品
                        <input type='checkbox' class='goods_status' name='goods_status[]' value='4'/> 热销
                    </td>
                </tr>
                <tr>
                    <td class="label">是否显示</td>
                    <td>
                        <input type='radio' class='status' name='status' value='1'/> 是
                        <input type='radio' class='status' name='status' value='0'/> 否
                    </td>
                </tr>
            </table>
            <table style="display: none">
                <tr>
                    <td colspan="2">
                        <textarea name="intro" id="intro" cols="30" rows="3"><?php echo ($goods_intro["intro"]); ?></textarea>
                    </td>
                </tr>
            </table>
            <table style="display: none">
                <?php if(is_array($member_level_list)): $i = 0; $__LIST__ = $member_level_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$member_level): $mod = ($i % 2 );++$i;?><tr>
                        <td class="label">
                            <?php echo ($member_level["name"]); ?>:
                        </td>
                        <td>
                            <input type="text" name="member_level_price[<?php echo ($member_level['id']); ?>]" value="<?php echo ($goods_member_price[$member_level['id']]); ?>">
                            <input type="hidden" name="member_level_id[<?php echo ($member_level['id']); ?>]" value="<?php echo ($member_level['id']); ?>">
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <table style="display: none">
                <tr>
                    <td class="label">商品属性</td>
                    <td>
                        <input type="text" name="goods_property">
                    </td>
                </tr>
            </table>
            <table style="display: none">
                <tbody><tr>
                    <td class="label">商品相册</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="javascript:;" onclick="addImg(this)">[+]</a>
                        图片描述 <input type="text" name="img_desc[]" size="20">
                        上传文件 <input type="file" name="img_url[]">
                        <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]">
                    </td>
                </tr>
                </tbody>
            </table>
            <table style="display: none">
                <tr>
                    <td class="label">关联文章</td>
                    <td>
                        <input type="text" name="article-tab">
                    </td>
                </tr>
            </table>
            <div align="center">
                    <input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <input type="submit" class="button " value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
            </div>
        </form>
    </div>

</div>
<script>
    $(function(){
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    })
</script>

    <script type="text/javascript" src="http://admin.shop.com/Public/uploadify/jquery.uploadify.min.js" ></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/ztree/js/jquery.ztree.core-3.5.js"></script>

    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://admin.shop.com/Public/ueditor/ueditor.all.min.js"> </script>
    <script>
        $(function(){
            /**********************************Tab展示添加列表 开始*************************************************/
            $('#tabbar-div span').click(function(){
                $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
                $(this).removeClass('tab-back').addClass('tab-front');
                var index = $(this).index();
                $('#tabbody-div form table').hide();//先将所有table隐藏
                $('#tabbody-div form>table').eq(index).show();//将点击按钮对应的索引table显示出来

                //优化代码,在点击第二个tab的时候再显示编辑器
                if(index==1){
                    /**********************************载入编辑器 开始*************************************************/
                    var ue = UE.getEditor('intro', {
                        /*toolbars: [
                            ['fullscreen', 'source', 'undo', 'redo', 'bold']
                        ],*/
                        initialFrameHeight:280,
                        autoHeightEnabled: true,
                        autoFloatEnabled: true
                    });
                    /**********************************载入编辑器 结束*************************************************/
                }


            });
            /**********************************Tab展示添加列表 结束*************************************************/

            /**********************************上传插件 开始*************************************************/
            $("#file_upload_1").uploadify({
                height        : 30,
                swf           : 'http://admin.shop.com/Public/uploadify/uploadify.swf',
                uploader      : "<?php echo U('Upload/upload');?>",
                width         : 120,
                buttonText    : '上传图片',
                'fileSizeLimit' : '1MB',
                'formData'      : {'dir' : 'php1009-0114'},
                'fileTypeExts' : '*.gif; *.jpg; *.png',
                'onUploadSuccess' : function(file, data, response) {
                    $('.upload-img-box').show();
                    $('.upload-pre-item img').attr('src','http://php1009-0114.b0.upaiyun.com/'+data);
                    $('.logo').val(data);
                },
                'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                }
            });

            /**********************************上传插件 结束*************************************************/
            /**********************************分类树状展示 开始*************************************************/
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
                    beforeClick: function (treeId, treeNode, clickFlag) {
                        if(treeNode.isParent){
                            layer.msg('只能选择最小的分类',{
                                time:1000,  //等待时间后关闭
                                offset: 0,  //设置位置
                                icon:2,  //设置提示框中的图标
                                shift :0, //动画效果0-6
                            });
                            return false;//取消默认操作
                        };
                    },
                    onClick: function(event, treeId, treeNode){  //treeNode就是点击的这个节点
                        //将节点的id(就是数据库中的id) 和节点的name复制给  parent_name和parent_id表单元素
                        $('.goods_category_id').val(treeNode.id);
                        $('.goods_category_name').val(treeNode.name);

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
            var goods_category_id= <?php echo ($goods_category_id); ?>;
            //找到父节点对应的节点
            var node = treeObj.getNodeByParam("id",goods_category_id);
                //选中此节点
            treeObj.selectNode(node);
                //将选中的节点信息更新到隐藏域的id,和显示框的名字中
            $('.goods_category_id').val(node.id);
            $('.goods_category_name').val(node.name);
            /**********************************多选回显 开始*************************************************/
            var goods_status = <?php echo ($goods_status); ?>;
            var gd_status=[];
            for(var i=0;i<$('.goods_status').length;i++){
                var obj = $('.goods_status')[i];
                if(obj.value & goods_status){
                    gd_status.push(obj.value);
                };
            }
            $('.goods_status').val(gd_status);

            /**********************************多选回显 结束*************************************************/
            $('.upload-img-box').show();
            $('.upload-pre-item img').attr('src','http://php1009-0114.b0.upaiyun.com/'+data);<?php endif; ?>

            /**********************************分类树状展示 结束*************************************************/




        });
    </script>

<div id="footer">
Made By Michael</div>
</body>
</html>