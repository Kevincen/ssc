<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-27
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $ConfigModel,$sHome,$sPort;

$home = $_SERVER["SERVER_NAME"];
$port = $_SERVER["SERVER_PORT"];
$lock = true;
for ($i=0; $i<count($sHome); $i++)
{
	if ($home == $sHome[$i] && $port == $sPort[$i])
	{
		$lock = true;
		break;
	}
}

for ($i=0; $i<count($dHome); $i++)
{
	if ($home == $dHome[$i] && $port == $dPort[$i])
	{
	
		$lock = true;
		break;
	}
}

if ($lock == false){
	href("/");
	exit;
}

if ($_COOKIE['manage_user'] == null || $_COOKIE['manage_uid'] == null ||  !isset($_SESSION['loginId']) || !isset($_SESSION['sName']))
{
	href("quit.php");
	exit;
}
$name = base64_decode($_COOKIE['manage_user']);
$uid = base64_decode($_COOKIE['manage_uid']);
$_SESSION['loginId'] = $_SESSION['loginId'];
$_SESSION['sName'] = $_SESSION['sName'];
$userModel = new UserModel();
$db=new DB();
if (isset($_SESSION['son'])) 
{ //子帳號
	$Users = $userModel->GetUserModel(null, $_SESSION['sName'], null, true);
	if (!$Users) href("quit.php");
	if ($ConfigModel['g_web_lock'] != 1) 
		exit(back($ConfigModel['g_web_text']));
	if (!$db->query("SELECT g_s_name FROM g_relation_user WHERE g_s_uid = '{$uid}' LIMIT 1 ", 0)) 
		exit(href('quit.php'));
	if ($Users[0]['g_s_lock'] == 3 || $Users[0]['g_lock'] == 3)
		exit(alert_href($UserLook, 'quit.php')); //帳號已被停用
	if ($Users[0]['g_s_out'] == 0) {
			href("quit.php");
			exit;
		} else {
			$sql = "UPDATE `g_relation_user` SET `g_out` =1, `g_count_time`=now() WHERE `g_s_name`='{$_SESSION['sName']}' LIMIT 1 ";
			$db->query($sql, 2);
		}
}
else
{
	$Users = $userModel->GetUserModel($_SESSION['loginId'], $_SESSION['sName']);
	if (!$Users)
	href("quit.php");
	if ($Users[0]['g_login_id'] != 89) {
		if ($ConfigModel['g_web_lock'] != 1) 
			exit(back($ConfigModel['g_web_text']));
		if (!$db->query("SELECT `g_name` FROM `g_rank` WHERE g_uid = '{$uid}' LIMIT 1 ", 0)) 
		//	exit(href('quit.php'));
		if ($Users[0]['g_lock'] == 3)
			exit(alert_href($UserLook, 'quit.php')); //帳號已被停用
		if ($Users[0]['g_out'] == 0) {
		//	href("quit.php");
		//	exit;
		} else {
			$sql = "UPDATE `g_rank` SET `g_out` =1, `g_count_time`=now() WHERE `g_name`='{$_SESSION['sName']}' LIMIT 1 ";
			$db->query($sql, 2);
		}
	} else {
        if (!$db->query("SELECT g_name FROM g_manage WHERE g_uid = '{$uid}' LIMIT 1 ", 0)){
        //    exit(href('quit.php'));
        }
    }
}

        $Users[0]['g_Lnid'] = $userModel->GetLoginIdByString ($_SESSION['loginId']);
        $LoginId =$Users[0]['g_login_id'];
?>