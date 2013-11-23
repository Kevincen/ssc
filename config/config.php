<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
date_default_timezone_set("PRC"); 
include_once ROOT_PATH.'class/DB.php';

//前臺域名
$Home[0] = 'hy.bk86.us';
$Home[1] = '';
$Home[2] = '';
$Home[3] = '';
$Home[4] = '';
$Home[5] = '';
$Home[6] = '';
$Home[7] = '';
$Home[8] = '';
$Home[9] = '';

//前臺端口
$Port[0] = '80';
$Port[1] = '';
$Port[2] = '';
$Port[3] = '';
$Port[4] = '';
$Port[5] = '';
$Port[6] = '';
$Port[7] = '';
$Port[8] = '';
$Port[9] = '';


//代理域名
$dHome[0] = 'dl.bk86.us';
$dHome[1] = '';
$dHome[2] = '';
$dHome[3] = '';
$dHome[4] = '';
$dHome[5] = '';
$dHome[6] = '';
$dHome[7] = '';
$dHome[8] = '';
$dHome[9] = '';

//代理端口
$dPort[0] = '80';
$dPort[1] = '';
$dPort[2] = '';
$dPort[3] = '';
$dPort[4] = '';
$dPort[5] = '';
$dPort[6] = '';
$dPort[7] = '';
$dPort[8] = '';
$dPort[9] = '';


//导航域名
$hHome[0] = 'f1.bk86.us';
$hHome[1] = '';
$hHome[2] = '';
$hHome[3] = '';
$hHome[4] = '';
$hHome[5] = '';
$hHome[6] = '';
$hHome[7] = '';
$hHome[8] = '';
$hHome[9] = '';

//导航端口
$hPort[0] = '80';
$hPort[1] = '';
$hPort[2] = '';
$hPort[3] = '';
$hPort[4] = '';
$hPort[5] = '';
$hPort[6] = '';
$hPort[7] = '';
$hPort[8] = '';
$hPort[9] = '';


//後臺域名
$sHome[0] = 'gl.bk86.us';
$sHome[1] = '';
$sHome[2] = '';
$sHome[3] = '';
$sHome[4] = '';
$sHome[5] = '';
$sHome[6] = '';
$sHome[7] = '';
$sHome[8] = '';
$sHome[9] = '';

//後臺端口
$sPort[0] = '80';
$sPort[1] = '';
$sPort[2] = '';
$sPort[3] = '';
$sPort[4] = '';
$sPort[5] = '';
$sPort[6] = '';
$sPort[7] = '';
$sPort[8] = '';
$sPort[9] = '';




$db=new DB();
$resultTime = $db->query('select g_open_time_gd,g_open_time_cq,g_open_time_gx,g_open_time_pk,g_open_time_nc from g_config limit 1',1);


//每天盤口開啟時間
$stratGame = date('Y-m-d').' '.$resultTime[0]['g_open_time_gd'];

//每天盤口關閉時間
$endGame = date('Y-m-d').' 23:00:00';

//每天盤口開啟時間
$stratGamecq = date('Y-m-d').' '.$resultTime[0]['g_open_time_cq'];

//每天盤口關閉時間
$endGamecq = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 01:55';


//每天盤口開啟時間
$stratGamegx = date('Y-m-d').' '.$resultTime[0]['g_open_time_gx'];

//每天盤口關閉時間
$endGamegx = date('Y-m-d').' 21:50:00';

//每天盤口開啟時間
$stratGamepk = date('Y-m-d').' '.$resultTime[0]['g_open_time_pk'];

//每天盤口關閉時間
$endGamepk = date('Y-m-d').' 23:59:00';

$oncontextmenu = '';// 'oncontextmenu="return false"';

$CONFIG["lhc_rgb"]=array(
		"red_arr"=>array("01","02","07","08","12","13","18","19","23","24","29","30","34","35","40","45","46"),
		"green_arr"=>array("05","06","11","16","17","21","22","27","28","32","33","38","39","43","44","49"),
		"blue_arr"=>array("03","04","09","10","14","15","20","25","26","31","36","37","41","42","47","48"),
		"SX"=>array(
			"牛"=>array("05","17","29","41"),
			"虎"=>array("04","16","28","40"),
			"兔"=>array("03","15","27","39"),
			"龍"=>array("02","14","26","38"),
			"蛇"=>array("01","13","25","37","49"),
			"馬"=>array("12","24","36","48"),
			"羊"=>array("11","23","35","47"),
			"猴"=>array("10","22","34","46"),
			"雞"=>array("09","21","33","45"),
			"狗"=>array("08","20","32","44"),
			"豬"=>array("07","19","31","43"),
			"鼠"=>array("06","18","30","42")
		),
		"JQ"=>array("牛","馬","羊","雞","狗","豬"),//家禽
		"WH"=>array(
			'金'=>array("10", "11", "18", "19", "26", "27", "40", "41", "48", "49"),
			'木'=>array("01", "08", "09", "22", "23", "30", "31", "38", "39"),
			"水"=>array("06", "07", "14", "15", "28", "29", "36", "37", "44", "45"),
			"火"=>array("02", "03", "16", "17", "24", "25", "32", "33", "46", "47"),
			"土"=>array("04", "05", "12", "13", "20", "21", "34", "35", "42", "43"),
		),
		
);


//每天盤口開啟時間
$stratGamenc = date('Y-m-d').' '.$resultTime[0]['g_open_time_nc'];

//每天盤口關閉時間
$endGamenc = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 01:55';
//每天盤口開啟時間
$stratGamexj = date('Y-m-d').' 10:00:00'; 
//每天盤口關閉時間
$endGamexj = date( "Y-m-d ", mktime(0, 0, 0, date('m'), date('d')+1, date('Y'))).' 01:55'; 

//每天盤口開啟時間
$stratGamejsk3 = date('Y-m-d').' 08:30:00'; 
//每天盤口關閉時間
$endGamejsk3 = date( "Y-m-d").' 22:11:00'; 

$iscash=false;
?>