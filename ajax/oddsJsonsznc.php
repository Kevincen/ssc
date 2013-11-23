<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-12
*/

define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
//if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
include_once ROOT_PATH.'function/cheCookie.php';
include_once ROOT_PATH.'config/Odds.php';
//include_once ROOT_PATH.'Manage/config/config.php';
global $user;
$tid = $_REQUEST['tid'];

if ($tid == 1)
{
	//最新开奖记录
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` FROM `g_history5` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	
	//当前用户今天输赢
	$winMoney = json_encode(getWin ($user));
	
	//雙面長龍
	global $BallString,$BallString_nc;
	$results = history_resultnc(0);
	$num_arr = sum_ball_count_1_nc ($BallString, $BallString_nc, $results, 3);
	arsort($num_arr);
	$num_arr = json_encode($num_arr);

	$row_1 = sum_str_s_nc ($results, 0);
	$row_2 = sum_str_s_nc ($results, 1);
	$row_3 = sum_str_s_nc ($results, 2);
	$row_4 = sum_str_s_nc ($results, 3);
	$row_5 = sum_str_s_nc ($results, 4);
	$row_6 = sum_str_s_nc ($results, 5);
	$row_7 = sum_str_s_nc ($results, 6);
	$row_8 = sum_str_s_nc ($results, 7); //1-8號球-號碼
	
	//$row_1 = sum_str_s ($results, 8, 25, FALSE, FALSE, 2, 0); 	//總和大小
	//$row_2 = sum_str_s ($results, 8, 25, FALSE, FALSE, 4, 0);	//總和單雙
	//$row_3 = sum_str_s ($results, 8, 25, FALSE, FALSE, 6, 0);	//總和尾數大小
	//$row_4 = sum_str_s ($results, 8, 25, TRUE);	//龍虎
	
	$row_1 = json_encode($row_1);
	$row_2 = json_encode($row_2);
	$row_3 = json_encode($row_3);
	$row_4 = json_encode($row_4);
	$row_5 = json_encode($row_5);
	$row_6 = json_encode($row_6);
	$row_7 = json_encode($row_7);
	$row_8 = json_encode($row_8);
	
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr,
				"num_arr" : $num_arr,
				"row_1" : $row_1,
				"row_2" : $row_2,
				"row_3" : $row_3,
				"row_4" : $row_4,
				"row_5" : $row_5,
				"row_6" : $row_6,
				"row_7" : $row_7,
				"row_8" : $row_8
			}
JSON;
exit;
}
else if ($tid == 2)
{
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan5 WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result && Copyright)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90; //刷新時間
		
		if($openTime<=0){
			auto_kaipan(5);
			$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan5 WHERE g_lock = 2  LIMIT 1";
			$result = $db->query($sql, 1);
			$endTime = strtotime($result[0]['g_feng_date']) - time();
			$openTime =  strtotime($result[0]['g_open_date']) - time();
			$Phases = $result[0]['g_qishu'];
			$RefreshTime = 90;
		}
		//取出1-8球和總和龍虎雙面賠率
		$db=new DB();
		$sql = "SELECT  `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`,`g_type` FROM `g_odds5` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' OR `g_type` = 'Ball_3' OR `g_type` = 'Ball_4' OR `g_type` = 'Ball_5' OR `g_type` = 'Ball_6' OR `g_type` = 'Ball_7' OR `g_type` = 'Ball_8' ORDER BY g_id ASC ";
		$sresult = $db->query($sql, 1);
		$list = $sresult;
		$oddsMax = 0;
		$ConfigModel= configModel("`g_odds_ratio_nc_b1`,`g_odds_ratio_nc_b2`,`g_odds_ratio_nc_b3`,`g_odds_ratio_nc_b4`,`g_odds_ratio_nc_b5`,`g_odds_ratio_nc_c1`,`g_odds_ratio_nc_c2`,`g_odds_ratio_nc_c3`,`g_odds_ratio_nc_c4`,`g_odds_ratio_nc_c5`");
		$arrList = array();
		for ($i=0; $i<count($list); $i++){
					switch($list[$i]['g_type']){
						case 'Ball_1':$str='g1';break;
						case 'Ball_2':$str='g2';break;
						case 'Ball_3':$str='g3';break;
						case 'Ball_4':$str='g4';break;
						case 'Ball_5':$str='g5';break;
						case 'Ball_6':$str='g6';break;
						case 'Ball_7':$str='g7';break;
						case 'Ball_8':$str='g8';break;
				}
			foreach ($list[$i] as $key=>$value){
				$arrList[$i][$key] = setoddsnc($key, $value, $ConfigModel, $user, 0,$str);
			}
		}
		$arrList = json_encode($arrList);
		echo <<<JSON
			{
			"Phases" : $Phases,
			"endTime" : "$endTime",
			"openTime" : "$openTime",
			"refreshTime" : "$RefreshTime",
			"oddsList" : $arrList
			}
JSON;
	}
}
else if ($tid == 3)
{
	$db = new DB();
	$result = $db->query("SELECT `g_qishu` FROM `g_history5` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}











?>
