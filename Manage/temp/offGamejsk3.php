<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-18
*/
error_reporting(E_ALL^E_NOTICE^E_WARNING);
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$dateTime = date('Y-m-d H:i:s');  
if ( $dateTime < $stratGamejsk3 || $dateTime > $endGamejsk3)
{
	header("Location: ./right.php"); exit;
}
?>