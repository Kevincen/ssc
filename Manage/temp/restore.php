<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
$db = new DB();
$method=$_REQUEST['method'];
if($method=="all"){
	RestoreMoney(1);
	echo "<script>alert('所有类型为信用额度的会员以还原完毕')</script>";
}else if(isset($_REQUEST['gname'])){
	$g_name = $_REQUEST['gname'];
	$sql = "UPDATE `g_user` SET `g_money_yes` = g_money WHERE `g_name` = '$g_name' and iscash='0'  ";
	$db->query($sql, 2);
	echo "<script>alert('会员{$g_name}信用额度还原完毕')</script>";
}
?>