<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-7
*/
error_reporting(E_ALL^E_NOTICE);
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
// by wjl 尝试修复excute maxtime limit 错误
//见网址http://bbs.csdn.net/topics/60317411
set_time_limit(3600);
//end by wjl
if (!isset($_SESSION)) session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
include_once ROOT_PATH.'config/config.php';
include_once ROOT_PATH.'config/HTML.php';
include_once ROOT_PATH.'class/DB.php';
include_once ROOT_PATH.'class/Page.php';
include_once ROOT_PATH.'class/Matchs.php';
include_once ROOT_PATH.'class/SumAmount.php';
include_once ROOT_PATH.'class/SumAmountcq.php';
include_once ROOT_PATH.'class/SumAmountxj.php';
include_once ROOT_PATH.'class/SumAmountgx.php';
include_once ROOT_PATH.'class/SumAmountpk.php';
include_once ROOT_PATH.'class/SumAmountlhc.php';
include_once ROOT_PATH.'class/SumAmountnc.php';
include_once ROOT_PATH.'class/SumAmountjsk3.php';
include_once ROOT_PATH.'class/AutomaticOdds.php';
include_once ROOT_PATH.'class/AutomaticOddscq.php';
include_once ROOT_PATH.'class/AutomaticOddsgx.php';
include_once ROOT_PATH.'class/AutomaticOddspk.php';
include_once ROOT_PATH.'class/AutomaticOddsxj.php';
include_once ROOT_PATH.'class/AutomaticOddsnc.php';
include_once ROOT_PATH.'class/GameInfo.php';
include_once ROOT_PATH.'class/GameInfolhc.php';
include_once ROOT_PATH.'class/GameInfoxj.php';
include_once ROOT_PATH.'class/GameInfojsk3.php';
include_once ROOT_PATH.'function/script.php';
include_once ROOT_PATH.'function/numberVal.php';
include_once ROOT_PATH.'function/parameter.php';
include_once ROOT_PATH.'function/pregMatch.php';
include_once ROOT_PATH.'function/opNumberList.php'; 
include_once ROOT_PATH.'tools/IpLocationApi/libs/iplocation.class.php';
include_once ROOT_PATH.'class/Lang.php'; //简繁转换
?>