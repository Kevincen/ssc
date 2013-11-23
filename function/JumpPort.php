<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-7
*/
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');

$home = $_SERVER["SERVER_NAME"];
$port = $_SERVER["SERVER_PORT"];
global $Home,$sHome,$Port,$sPort;
$a = 0;
for ($i=0; $i<count($Home); $i++)
{
	if ($home == $Home[$i] && $port == $Port[$i])
	{
		//前臺登入點
		$a= 1;
		break;
	}
	else if ($home == $sHome[$i] && $port == $sPort[$i])
	{
		//後臺登陸點
		$a= 3;
		break;
	}
	else if ($home == $dHome[$i] && $port == $dPort[$i])
	{
		//代理登陸點
		$a= 2;
		break;
	}
	else if ($home == $hHome[$i] && $port == $hPort[$i])
	{
		//导航登陸點
		$a= 4;
		break;
	}
}
if ($a == 0)
	exit('PortError');
else 
	return $a;















?>