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
            'rootPath'     => './', //保存根路径
            'driver'       => 'Upyun', // 文件上传驱动
            'driverConfig'     => array(
                'host'     => 'v0.api.upyun.com', //又拍云服务器
                'username' => 'brazor', //又拍云用户
                'password' => 'brazorbrazor', //又拍云密码
                'bucket'   => $dir, //空间名称
                'timeout'  => 90, //超时时间
            ),
        );
        $upload = new Upload();
        $result = $upload->uploadOne($_FILES['Filedata']);
        if($result!==false){
            echo  $result['savepath'].$result['savename'];
        }else{
            echo $upload->getError();
        }

    }
}