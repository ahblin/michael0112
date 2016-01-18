<?php
/**
 * Created by PhpStorm.
 * User: Brazor
 * Date: 2016/1/18
 * Time: 13:05
 */

namespace Admin\Controller;


class GoodsPhotoController extends BaseController
{
    public function remove($id){
        $model = D('GoodsPhoto');
        $model->remove($id);
    }
}