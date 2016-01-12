<extend name="Common/index"/>
<block name="list">
    <form method="post" action="" name="listForm">
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th>全选 <input type="checkbox" class="allChoose"></th>
                    <?php foreach($fields as $field):?>
                    <th><?php echo $field['comment'] ?></th>
                    <?php endforeach; ?>
                    <th>操作</th>
                </tr>
                <volist name="rows" id="row">
                    <tr>
                        <td width="30">{$row.id}<input type="checkbox" name="id[]" value="{$row.id}" class="choose">
                        </td>
                        <?php foreach($fields as $field){
                            if($field['field']=="name"){
                                echo  "<td class='first-cell' align='center'>{\$row.name}</td>";
                            }elseif($field['field']=="status"){
                                echo "<td align=\"center\"><a class=\"ajax-get\" href=\"{:U('changeStatus',array('id'=>\$row['id'],'status'=>(1-\$row['status'])))}\"><img src=\"__IMG__/{\$row.status}.gif\"/></a></td>";
                            }else{
                                echo "<td align='center'>{\$row.{$field['field']}}</td>";
                            }
                        }
                        ?>
                        <td align="center">
                            <a class="ajax-post" href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
                            <a class="ajax-get" href="{:U('changeStatus',array('id'=>$row['id']))}" title="编辑">移除</a>
                        </td>
                    </tr>
                </volist>
            </table>
            <div id="turn-page" class="page">
                {$pageTool}
            </div>
        </div>
    </form>
</block>