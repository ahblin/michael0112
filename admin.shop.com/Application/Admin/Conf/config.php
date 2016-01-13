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
    ),

);