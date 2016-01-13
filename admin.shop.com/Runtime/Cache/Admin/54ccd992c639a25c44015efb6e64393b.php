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
    <!--预留css的位置-->
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
                <td class="label">品牌名称</td>
                <td>
                    <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/>
                </td>
            </tr>
            <tr>
                <td class="label">品牌网址</td>
                <td>
                    <input type='text' name='url' maxlength='60' value='<?php echo ($url); ?>'/>
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type='file' class="uploadify-button" name='logo' id="file_upload_1" maxlength='60'/>

                    <div class="upload-img-box" style="display: none">
                        <div class="upload-pre-item">
                            <img src="">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type='text' name='sort' maxlength='40' size='15' value='<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>'/>
                </td>
            </tr>
            <tr>
                <td class="label">品牌简介</td>
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
                    <input type="submit" class="button" value=" 确定 "/>
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

    <script type="text/javascript" src="http://admin.shop.com/Public/uploadify/jquery.uploadify.min.js" ></script>
    <script>
        $(function(){
            $("#file_upload_1").uploadify({
                height        : 30,
                swf           : 'http://admin.shop.com/Public/uploadify/uploadify.swf',
                uploader      : "<?php echo U('Upload/upload');?>",
                width         : 120,
                buttonText    : '上传图片',
                'fileSizeLimit' : '1MB',
                'formData'      : {'dir' : 'xxxxx'},
                'fileTypeExts' : '*.gif; *.jpg; *.png',
                'onUploadSuccess' : function(file, data, response) {
                    $('.upload-img-box').show();
                    $('.upload-pre-item img').attr('src','http://admin.shop.com/Uploads/'+data);
                },
                'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                }
            });
        });
    </script>

<div id="footer">
Made By Michael</div>
</body>
</html>