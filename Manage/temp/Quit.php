<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-25
*/

define('Copyright', 'зїепQQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';

$name = base64_decode($_COOKIE['manage_user']);
$db = new DB();
		$sql = "UPDATE `g_manage` SET `g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);
		
		$sql = "UPDATE `g_rank` SET `g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);

		
		$sql = "UPDATE `g_relation_user` SET `g_out` =0 WHERE `g_s_name` = '{$name}'";
		$result = $db->query($sql, 2);
		
setcookie("manage_user", "", 0, "/");
setcookie("manage_uid", "", 0, "/");
 unset($_SESSION['loginId']);
 unset($_SESSION['sName']);
include_once '../../function/script.php';
href("/");
?>