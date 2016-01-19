<?php
defined('WEB_PATH') or define('WEB_PATH','http://www.shop.com');
return array(
    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'shop', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '123456', // 密码


    //替换字符串
    'TMPL_PARSE_STRING'=>array(
        '__CSS__' => WEB_PATH.'/Public/css',
        '__IMG__'=> WEB_PATH.'/Public/images',
        '__JS__'=> WEB_PATH.'/Public/js',
        '__UEDITOR__'=>WEB_PATH.'/Public/ueditor',
        '__UPLOAD__'=>WEB_PATH.'/Uploads', //代表brand_logo空间的域名

        /*
        '__BRAND__'=>'http://brand-logo.b0.upaiyun.com/', //代表brand_logo空间的域名
        '__GOODS__'=>'http://itsource-goods.b0.upaiyun.com/', //代表brand_logo空间的域名
        '__UEDITOR__'=>WEB_PATH.'Public/Home/ueditor',*/
    ),
    //'SHOW_PAGE_TRACE' =>true,
);