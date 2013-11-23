<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-15
*/
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] == 89 &&  isset($_GET['uid']) && isset($_GET['sid']) && isset($_GET['code']))
{
	$name = $_GET['uid'];
	$sid = $_GET['sid'];
	$code = $_GET['code'];
	
	
	
	$db = new DB();
	
	$sql = "SELECT * FROM `g_manage` WHERE g_name = '{$Users[0]['g_name']}' ";
	$result = $db->query($sql, 1);
	
	if($result[0]['g_code']==$code){
	
	$form = $sid == 2 ? "g_rank" : "g_user";
	$sql = "SELECT g_nid, g_name FROM `{$form}` WHERE g_name = '{$name}' LIMIT 1";
	$username = $db->query($sql, 0);
	if ($username)
	{
		if ($sid == 2)
		{
			$p = " g_user.g_nid LIKE '{$username[0][0]}%' ";
			$w = "g_s_nid LIKE '{$username[0][0]}%'";
			
			$sql = "DELETE `g_rank`, `g_relation_user`, `g_send_back`, `g_autolet`, `g_insert_log`, `g_login_log` FROM g_rank
			LEFT JOIN g_relation_user ON g_relation_user.g_s_nid = g_rank.g_nid
			LEFT JOIN g_send_back ON g_send_back.g_name = g_rank.g_name
			LEFT JOIN g_autolet ON g_autolet.g_name = g_rank.g_name
			LEFT JOIN g_insert_log ON g_insert_log.g_name = g_rank.g_name
			LEFT JOIN g_login_log ON g_login_log.g_name = g_rank.g_name
			WHERE g_rank.g_nid LIKE '{$username[0][0]}%'";
			$db->query($sql, 2);
		}
		else 
		{
			$p = " g_user.g_name = '{$username[0][1]}' ";
			$w = "g_nid = '{$username[0][1]}'";
		}
		
		$sql = "DELETE `g_user`, `g_panbiao`, `g_insert_log`, `g_login_log` FROM g_user
		LEFT JOIN g_panbiao ON g_panbiao.g_nid = g_user.g_name
		LEFT JOIN g_insert_log ON g_insert_log.g_name = g_user.g_name
		LEFT JOIN g_login_log ON g_insert_log.g_name = g_user.g_name
		WHERE {$p}";
		$db->query($sql, 2);
		
		$sql = "DELETE FROM g_zhudan WHERE {$w}";
		$db->query($sql, 2);
		exit(back('刪除成功'));
	}
	}else{
		exit(back('安全码错误！'));
	}
}
?>