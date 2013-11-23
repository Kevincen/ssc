<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-18
*/
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$dateTime = date('Y-m-d H:i:s');
$a = date('Y-m-d ').'01:55:00';
global $stratGamexj, $endGamexj;
if ( ($dateTime < $stratGamexj && $dateTime > $a) || $dateTime > $endGamexj)
{
	header("Location: ./right.php"); exit;
}
?>