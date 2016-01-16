$(function () {
    /**
     * ajax-post的函数
     * 包括表单提交,和全选的复选框
     * if里面是有表格的情况,就是表单提交
     * else则是没有表单,全选框(class="allChoose"),单个复选框(class="choose")
     *
     */
    $('.ajax-post').click(function () {
        var form = $(this).closest('form');
        var url;
        var params;
        //表单提交
        if (form.length!=0) {
            url = form.attr('action');
            params = form.serialize();
            //form.ajaxSubmit({success: show_msg});
            // 如果加上if (form.length!=0)判断,此方法有问题,暂时不用
        } else {
            //复选框
            url = $(this).attr('url');
            params = $('.choose').serialize();
        }
        $.post(url, params,show_msg);
        return false;
    });

    /**
     * ajax-get的函数
     * 找到有class="ajax-get"的标签,并加上事件
     */
    $('.ajax-get').click(function () {
        //获得标签的url地址
        var url = $(this).attr('href');
        $.get(url, show_msg);
        return false;  //取消该标签的默认操作
    });

    //设置全选,点击全选就选择全部
    $('.allChoose').click(function () {
        $('.choose').prop('checked', $(this).prop('checked'))
    });

    //当选项全部选择的话,全选框也选中-->当未选中的选项为0个的时候,就表示全部都选中了
    $('.choose').click(function () {
        $('.allChoose').prop('checked', $('.choose:not(:checked)').length == 0)
    });

});

/**
 * 弹出框显示效果
 * @param data
 */
function show_msg(data) {
    //如果成功,status则==1,失败==0
    if (data.status) {
        layer.msg(data.info, {
            icon: 1,//图标0-6
            offset: 0,//位置距离上边距
            shift: 0, //动画类型0-6
            time: 1000,//出现时长
        }, function () {
            //弹出框消失后的操作(回调函数)
            location.href = data.url;
        })

    } else {
        layer.msg(data.info, {
            icon: 2,//图标0-6
            offset: 0,//位置距离上边距
            shift: 0, //动画类型0-6
            time: 1000,//出现时长
        })
    }
}