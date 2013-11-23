<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-13
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'function/global.php';
global $Home,$Port;
$ConfigModel = configModel("`g_web_lock`");
if ($ConfigModel['g_web_lock'] != 1) 
{
	href("/");
	exit;
}
$home = $_SERVER["SERVER_NAME"];
$port = $_SERVER["SERVER_PORT"];
$lock = false;
for ($i=0; $i<count($Home); $i++)
{
	if ($home == $Home[$i] && $port == $Port[$i])
	{
		$lock = true;
		break;
	}
}
if ($lock == false)
{
	href("/");
	exit;
}

if (!isset($_COOKIE['g_user']) || !isset($_COOKIE['g_uid'])) 
{
	 
	href("/");
	exit;
} 
else 
{
	$name = base64_decode($_COOKIE['g_user']);
	$uid = base64_decode($_COOKIE['g_uid']);
	$db = new DB();
	$sql = "SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` WHERE `g_name` = '{$name}' AND `g_uid` = '{$uid}' LIMIT 1 ";
	
	//"SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` WHERE `g_name` = '{$name}' and `g_uid`='112233'  union all select 1,2,3,4,5,6,7,8,9,10,g_password,12,13,14,15,16,17,18 from g_manage and g_name<>'admin' # AND `g_uid` = '{$uid}' LIMIT 1 "
	
	  
	$user = $db->query($sql, 1);
	
	if (!$user)
		exit(href("/"));
	if ($user[0]['g_look'] == 3)
		exit(alert_href($UserLook,'/'));
	if ($user[0]['g_out'] == 0)
	{
		
		href("/");
		exit;
	}
	else 
	{
		$sql = "UPDATE `g_user` SET `g_count_time`=now() WHERE `g_name`='{$name}' LIMIT 1 ";
		
		//"UPDATE `g_user` SET `g_count_time`=now() WHERE `g_name`='' union all select 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20  # "
		
		$db->query($sql, 2);
	}
}




?>