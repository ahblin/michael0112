namespace Admin\Model;

class <?php echo $controller_name; ?>Model extends BaseModel
{
    /**
    * 每个模型有自己的验证方法,下面方法只是将表格字段限制不能为空的(not null),
    * 做了一个限制不能为空
    */
    protected $_validate = array(
        <?php foreach($fields as $field){
        if($field['null']=='YES'){
            continue;
        }else{
        echo "array('{$field['field']}','require','{$field['comment']}不能够为空'),\r\n        ";
        }
        }?>
    );
}