<?php
defined('WEB_PATH') or define('WEB_PATH','http://admin.shop.com');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'=>array(
        '__CSS__' => WEB_PATH.'/Public/css',
        '__IMG__'=> WEB_PATH.'/Public/images',
        '__JS__'=> WEB_PATH.'/Public/js',
        '__LAYER__'=> WEB_PATH.'/Public/layer/layer.js',
        '__UPLOADIFY__'=> WEB_PATH.'/Public/uploadify',
        '__UEDITOR__'=> WEB_PATH.'/Public/ueditor',
        //'__UPLOAD__'=>'http://php1009-0114.b0.upaiyun.com', //代表brand_logo空间的域名
        '__UPLOAD__'=>'http://admin.shop.com/Uploads', //代表brand_logo空间的域名
        '__TREEGRID__'=>WEB_PATH.'/Public/treegrid', //代表brand_logo空间的域名
        '__ZTREE__'=>WEB_PATH.'/Public/ztree', //代表brand_logo空间的域名
        '__NESTEDSETS__'=>WEB_PATH.'/Public/nestedsets', //代表brand_logo空间的域名
    ),
    //'SHOW_PAGE_TRACE' =>true,

);