<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';

	$id=$_POST['zid'];
	$type=$_POST['type'];
	$db=new DB();
	//zerc20120802
	$gwin=$type=='yes'? 1:0;
	$gfail=$type=='yes'? 0:1;
	if($gwin==1){
		$sql = "update g_zhudan set g_awin=$gwin,g_afail=$gfail where g_id='$id'";
	}else{
		$sql = "update g_zhudan set g_awin=$gwin where g_id='$id'";
	}
	$db->query($sql, 2);
	echo $gwin+"";
?>