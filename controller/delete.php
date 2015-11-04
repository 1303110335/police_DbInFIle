<?php
require_once '../class/inc.php';
function __autoload($className){
	require_once '../class/'.$className.'.class.php';
};

$db = new FileDB($filePath,$recordsFile,$seperator,$SEPERATORS);

$id = $_GET['id'];
if(!is_numeric($id)){
	die('传入参数错误!');
}
echo 'haha';
$result = $db->delete($id);
header('Location:../indexs.php');
//echo $message = $result?"删除成功!<a href='indexs.php?act=select'>返回</a>":"不存在该Id的记录!<a href='indexs.php?act=select'>返回</a>";
clearstatcache();
exit;