<?php
header("Content-type:text/html;charset=utf-8");

$arr = array(
    array('abc' => 1, 'value' => 100),
    array('abc' => 2, 'value' => 200),
    array('abc' => 3, 'value' => 300),
);

echo '<pre>';
$res = array();
foreach ($arr as $v) {
    $res[$v['abc']] = $v['value'];
}
var_dump($res);