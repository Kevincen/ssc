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
global $Users;
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_4'])){
	if ($Users[0]['g_lock_1_4'] !=1) 
		exit(back('您的權限不足！'));
}

$db=new DB();

if (isset($_GET['delid']) && isset($_GET['sid']))
{
	if (!Matchs::isNumber($_GET['delid'])) 
		exit(back($_GET['delid'].'# 注單不存在！'));
		
	$delid = $_GET['delid'];
	$sid = $_GET['sid'];
	$or = null;
	$result = $db->query("SELECT g_id, g_type, g_mumber_type, g_nid, g_mingxi_1, g_jiner, g_win FROM g_zhudan WHERE g_id = '{$delid}' LIMIT 1", 1);
	if ($result)
	{
		if ($result[0]['g_mumber_type']!=5)
		{
			if ($sid == 1) //金額還原
			{
				$sql = "SELECT g_name, g_money_yes FROM g_user WHERE g_name = '{$result[0]['g_nid']}' LIMIT 1";
				$userName = $db->query($sql, 1);
				if($result[0]['g_win']<0){
				$money = $userName[0]['g_money_yes'] - $result[0]['g_win'];
				}else{
				$money = $userName[0]['g_money_yes'] - $result[0]['g_win']+$result[0]['g_jiner'];
				}
				$sql = "UPDATE g_user SET g_money_yes = '{$money}' WHERE g_name = '{$userName[0]['g_name']}' LIMIT 1";
				$db->query($sql, 2);
			}
			$or = "OR g_t_id = '{$delid}'";
		}
		
		$sql = "DELETE FROM `g_zhudan` WHERE g_id = '{$delid}' {$or}";
		$db->query($sql, 2);
		if ($sid == 1 && $result[0]['g_mumber_type']!=5)
			exit(back($delid.'# 注單刪除成功，【原始金額: '.$userName[0]['g_money_yes'].'】   刪除后金額: '.$money.''));
		else
			exit(back($delid.'# 注單刪除成功'));
	}
	else 
	{
		exit(back($_GET['delid'].'# 注單不存在！'));
	}
}
else if (isset($_GET['startNumber']) && isset($_GET['endNumber']) && !empty($_GET['startNumber']) && !empty($_GET['endNumber']))
{
	$startNumber = $_GET['startNumber'];
	$endNumber = $_GET['endNumber'];
	if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2)
		$from =" g_type = '重慶時時彩' ";
	else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3)
		$from =" g_type = '廣西快樂十分' ";
	else
		$from =" g_type = '廣東快樂十分' ";
	$db->query("DELETE FROM g_zhudan WHERE {$from} and g_qishu >= '{$startNumber}' AND g_qishu <= '{$endNumber}'", 2);
	exit(back('執行成功'));
}
else 
{
	exit(back('期數類型錯誤'));
}

?>