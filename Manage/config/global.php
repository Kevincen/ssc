<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:84887817
  Author: Version:1.0
  Date:2011-12-27
*/
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ：914190123');
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!isset($_SESSION)) session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
include_once ROOT_PATH.'class/UserModel.php';
include_once ROOT_PATH.'class/DB.php';
include_once ROOT_PATH.'class/Matchs.php';
include_once ROOT_PATH.'class/Detailed.php';
include_once ROOT_PATH.'class/Page.php';
include_once ROOT_PATH.'class/UserReportInfo.php';
include_once ROOT_PATH.'class/UserReportInfogx.php';
include_once ROOT_PATH.'class/UserReportInfopk.php';
include_once ROOT_PATH.'class/UserReportInfonc.php';
include_once ROOT_PATH.'config/HTML.php';
include_once ROOT_PATH.'config/Odds.php';
include_once ROOT_PATH.'config/config.php';
include_once ROOT_PATH.'function/script.php';
include_once ROOT_PATH.'function/parameter.php';
include_once ROOT_PATH.'function/pregMatch.php';
include_once ROOT_PATH.'tools/IpLocationApi/libs/iplocation.class.php';
?>