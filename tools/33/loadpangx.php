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
$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_up_odds_mix_gx`,
`g_odds_execution_lock`,
`g_odds_num_gx`,
`g_odds_str_gx`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`");

if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit;

$number=$_GET['number'];

if (isset($number)){
InsertNumbergx ($number);
}



?>