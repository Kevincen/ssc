<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';

	$id=$_POST['zid'];
	$type=$_POST['type'];
	$db=new DB();
	//zerc20120802
	$gwin=$type=='yes'? 0:1;
	$gfail=$type=='yes'? 1:0;
	if($gfail==1){
		$sql = "update g_user set g_autowin=$gwin, g_autofail=$gfail where g_id='$id'";
	}else{
		$sql = "update g_user set g_autofail=$gfail where g_id='$id'";
	}
	$db->query($sql, 2);
	echo $gfail+"";
?>