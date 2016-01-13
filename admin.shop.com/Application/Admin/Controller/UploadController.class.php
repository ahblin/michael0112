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
        $config = array(
            'autoSub'      => true, //自动子目录保存文件
            'subName'      => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'     => './Uploads/', //保存根路径
            'saveName'     => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
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