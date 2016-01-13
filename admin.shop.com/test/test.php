<?php
header("Content-type:text/html;charset=utf-8");

$str = "品牌简介@textarea";
$str = "是否显示@radio|1=是&0=否";
$patten = '/(.*)@([a-z]*)\|?(.*)/';
preg_match($patten,$str,$result);
echo '<pre>';
var_dump($result);
?>
<input type="text" value="11111" readonly>
