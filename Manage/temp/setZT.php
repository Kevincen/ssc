<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';

	$uid=$_POST['uid'];
	$type=$_POST['type'];
	$utype=$_POST['utype'];
	$db=new DB();
	if($utype=='1'){
	$utname='g_rank';
	$uziduan='g_lock';
	$g_name='g_name';
	}
	else if($utype=='2'){
	$utname='g_user';
	$uziduan='g_look';
	$g_name='g_name';
	}
	else{
	$utname='g_relation_user';
	$uziduan='g_lock';
	$g_name='g_s_name';
	}
	
	$sql = "update {$utname} set {$uziduan}={$type} where {$g_name}='{$uid}'";
	$db->query($sql, 2);
	if($type==1) 
	echo '啟用';
	if($type==2)
	echo '凍結';
	if($type==3)
	echo '停用';
?>