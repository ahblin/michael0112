<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/14
 * Time: 1:08
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    public function upload(){
        $dir = I('post.dir');
        //如果要将配置放到配置文件中,需要将$dir提出来
        $config = array(
            //'autoSub'      => true, //自动子目录保存文件
            //'subName'      => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'     => './', //保存根路径
            //'saveName'     => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'driver'       => 'Upyun', // 文件上传驱动
            'driverConfig'     => array(
                'host'     => 'v0.api.upyun.com', //又拍云服务器
                'username' => 'brazor', //又拍云用户
                'password' => 'brazorbrazor', //又拍云密码
                'bucket'   => $dir, //空间名称
                'timeout'  => 90, //超时时间
            ),
        );
        $upload = new Upload($config);
        $result = $upload->uploadOne($_FILES['Filedata']);
        if($result!==false){
            echo  $result['savepath'].$result['savename'];
        }else{
            echo $upload->getError();
        }

    }
}