<?php
namespace Admin\Controller;
header("Content-type:text/html;charset=utf-8");


use Think\Controller;

class AutoController extends Controller
{
    public function index()
    {
        if (IS_POST) {

            /**
             * 自动创建控制器
             */
            $table_name = I('post.name');
            $controller_name = parse_name($table_name, 1);
            $sql = "SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_SCHEMA = '".C('DB_NAME')."' AND TABLE_NAME = '{$table_name}'";
            $model = M();
            $comment = $model->query($sql);
            if($comment == false){
                $this->error('无此表格,请重新输入!');
                return;
            }
            $meta_title = $comment[0]['table_comment'];
            ob_start();
            require  APP_PATH.'Admin/Common/controller.tpl';
            $controller_model = "<?php\r\n".ob_get_clean();
            $controllrt_path = APP_PATH.'Admin/Controller/'.$controller_name.'Controller.class.php';
            file_put_contents($controllrt_path,$controller_model);

            /**
             * 自动创建模型
             * 1.为表格不为空的字段设置不能为空
             * 1.1找到字段有限制不能为空的字段
             * 1.2再去模板中判断,不为空的就验证
             */
            $sql2 = "show full columns from $table_name";
            $fields = $model->query($sql2);
            foreach($fields as $k => &$field){
                if($field['field']=='id'){
                    unset($fields[$k]);
                }
                if(strpos($field['comment'],'@')!==false){
                    $patten = '/(.*)@([a-z]*)\|?(.*)/';
                    preg_match($patten,$field['comment'],$result);
                    $field['comment'] = $result[1];
                    $field['input_type'] = $result[2];
                    if(!empty($result[3])){
                        parse_str($result[3],$option_values);
                        $field['choice'] = $option_values;
                    }
                }
            }
            unset($field);
            /*dump($fields);
            exit;*/
            ob_start();
            require  APP_PATH.'Admin/Common/model.tpl';
            $model_model = "<?php\r\n".ob_get_clean();
            $model_path = APP_PATH.'Admin/Model/'.$controller_name.'Model.class.php';
            file_put_contents($model_path,$model_model);

            /**
             * 生成编辑页面
             */

            ob_start();
            require  APP_PATH.'Admin/Common/edit.tpl';
            $edit_model = ob_get_clean();
            $edit_path = APP_PATH.'Admin/View/'.$controller_name;
            /*dump($edit_model);
            exit;*/
            if(!is_dir($edit_path)){
                mkdir($edit_path,0777,true);
            }
            $model_path = $edit_path.'/edit.html';
            file_put_contents($model_path,$edit_model);

            /**
             * 生成index界面
             */

            ob_start();
            require  APP_PATH.'Admin/Common/index.tpl';
            $index_model = ob_get_clean();
            //用生成edit的$edit_path文件夹
            $index_path = $edit_path.'/index.html';
            file_put_contents($index_path,$index_model);

            //所有代码执行完毕,跳转
            $this->success('添加成功!',U('index'));

        } else {

            $this->assign('meta_title','自动生成控制器和模型');
            $this->display('edit');
        }
    }
}