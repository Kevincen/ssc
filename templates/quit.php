<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-8
*/
define('Copyright', 'зїепQQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';

$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
		$sql = "UPDATE `g_user` SET `g_state` =0,`g_out` =0 WHERE `g_name` = '{$name}'";
		$result = $db->query($sql, 2);

setcookie("g_user", "", 0, "/");
setcookie("g_uid", "", 0, "/");

include_once '../function/script.php';
href("/");
?>