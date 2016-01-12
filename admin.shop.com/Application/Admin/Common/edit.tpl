<extend name="Common/edit"/>
<block name="form">
    <form method="post" action="{:U()}" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <?php foreach($fields as $field): ?>
            <tr>
                <td class="label"><?php echo $field['comment']; ?></td>
                <td>
                    <?php
                        if($field['field']=='sort'){
                            echo "<input type='text' name='sort' maxlength='40' size='15' value='{\$sort|default=20}' />";
                        }elseif(!isset($field['input_type'])){
                            echo "<input type='text' name='{$field['field']}' maxlength='60' value='{\${$field['field']}}'/>";
                        }elseif($field['input_type']=='file'){
                            echo "<input type='file' name='{$field['field']}' maxlength='60'/>";
                        }elseif($field['input_type']=='radio'){
                            foreach($field['choice'] as $k=>$v){
                            echo "<input type='radio' class='{$field['field']}' name='{$field['field']}' value='{$k}'/> {$v}";
                            }
                        }elseif($field['input_type']=='textarea'){
                            echo "<textarea name='{$field['field']}' cols='60' rows='4'>{\${$field['field']}}</textarea>";
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" align="center"><br/>
                    <input type="hidden" name="id" value="{$id}">
                    <input type="submit" class="button ajax-post" value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>
</block>