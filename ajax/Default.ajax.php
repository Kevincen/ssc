<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:914190123
  Author: Version:1.0
  Date:2011-12-12
*/
define('Copyright', '作者QQ:914190123');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
if ($_SERVER["REQUEST_METHOD"] != "POST") {exit;}
include_once ROOT_PATH.'function/cheCookie.php';
include_once ROOT_PATH.'config/Odds.php';

$typeId = $_POST['typeid'];

if ($typeId == "sessionId" && Copyright)
{
	$_SESSION['guid_code'] = uniqid(time(),true);
	echo 1;
}

if ($typeId == "openNumber")
{
	include_once ROOT_PATH.'function/cheCookie.php';
	//最新开奖记录
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8` FROM `g_history` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	//当前用户今天输赢
	$winMoney = json_encode(getWin ($user));
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0 && Copyright)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr
			}
JSON;
	
}

if ($typeId == "postodds")
{
	if ($user[0]['g_look'] == 2) exit('true');
}

if ($typeId == "action" && Copyright)
{
	$nid = @$_POST['nid'];
	$oArr = array();
	$p=1;
	switch ($nid)
	{
		case 'g1': $p=35; $g_id = "Ball_1"; break;
		case 'g2': $p=35; $g_id = "Ball_2"; break;
		case 'g3': $p=35; $g_id = "Ball_3"; break;
		case 'g4': $p=35; $g_id = "Ball_4"; break;
		case 'g5': $p=35; $g_id = "Ball_5"; break;
		case 'g6': $p=35; $g_id = "Ball_6"; break;
		case 'g7': $p=35; $g_id = "Ball_7"; break;
		case 'g8': $p=35; $g_id = "Ball_8"; break;
		case 'k1': $p=8; $g_id = "Ball_9"; break;
		case 'k2': $p=8; $g_id = "Ball_10"; break;
	}
	$oArr = selectOdds($p, $g_id); //賠率
	//判斷當前登錄帳號的盤口
	$oddsMax = 0;
	$ConfigModel= configModel("`g_odds_ratio_b1`,`g_odds_ratio_b2`,`g_odds_ratio_b3`,`g_odds_ratio_b4`,`g_odds_ratio_b5`,`g_odds_ratio_c1`,`g_odds_ratio_c2`,`g_odds_ratio_c3`,`g_odds_ratio_c4`,`g_odds_ratio_c5`");
	foreach ($oArr[0] as $key=>$val)
	{
		if($nid=='g1'||$nid=='g2'||$nid=='g3'||$nid=='g4'||$nid=='g5'||$nid=='g6'||$nid=='g7'||$nid=='g8')
		{
			$oArr[0][$key] = setodds($key, $val, $ConfigModel, $user, 0,$nid);
		} 
		else if ($nid=='k1') {
			$oArr[0][$key] = setodds($key, $val, $ConfigModel, $user, 1);
		}
		else {
			$oArr[0][$key] = setodds($key, $val, $ConfigModel, $user, 2);
		}
	}
	
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM `g_kaipan` WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$odds = json_encode($oArr);
		$RefreshTime = 90; //刷新時間
		echo <<<JSON
			{"Phases" : $Phases,
			"endTime" : "$endTime",
			"openTime" : "$openTime",
			"refreshTime" : "$RefreshTime",
			"odds" : $odds
			}
JSON;
	}
	exit;
}

if ($typeId == "sumball_s")
{
	$href = get_ball_str ($_POST['href']) - 1;
	$result = history_result(0);
	global $BallString, $BallString_a;
	$row_2 = $href == 8 ? sum_str_s ($result, $href, 25, TRUE) : sum_str_s ($result, $href); //1-8號球-號碼
	$row_3 = sum_str_s ($result, $href, 25, FALSE, 3);	//1-8號球-大小
	$row_4 = sum_str_s ($result, $href, 25, FALSE, 1);	//1-8號球-單雙
	$row_5 = sum_str_s ($result, $href, 25, FALSE, 5, NULL, 0);	//1-8號球-尾數大小
	$row_6 = sum_str_s ($result, $href, 25, FALSE, 7, NULL, 0);	//1-8號球-合數單雙
	$row_7 = sum_str_s ($result, $href, 25, FALSE, 8);	//1-8號球-方位
	$row_8 = sum_str_s ($result, $href, 25, FALSE, 9);	//1-8號球-中發白
	$row_9 = sum_str_s ($result, $href, 25, FALSE, FALSE, 2, 0); 	//總和大小
	$row_10 = sum_str_s ($result, $href, 25, FALSE, FALSE, 4, 0);	//總和單雙
	$row_11 = sum_str_s ($result, $href, 25, FALSE, FALSE, 6, 0);	//總和尾數大小
	$row_12 = sum_str_s ($result, $href, 25, TRUE);	//龍虎
	
	//雙面計算
	$num_arr = sum_ball_count_1 ($BallString, $BallString_a, $result, 2); 
	arsort($num_arr);
	
	$row_1 = json_encode($num_arr);
	$row_2 = json_encode($row_2);
	$row_3 = json_encode($row_3);
	$row_4 = json_encode($row_4);
	$row_5 = json_encode($row_5);
	$row_6 = json_encode($row_6);
	$row_7 = json_encode($row_7);
	$row_8 = json_encode($row_8);
	$row_9 = json_encode($row_9);
	$row_10 = json_encode($row_10);
	$row_11 = json_encode($row_11);
	$row_12 = json_encode($row_12);
	echo <<<JSON
		{
			"row_1" : $row_1,
			"row_2" : $row_2,
			"row_3" : $row_3,
			"row_4" : $row_4,
			"row_5" : $row_5,
			"row_6" : $row_6,
			"row_7" : $row_7,
			"row_8" : $row_8,
			"row_9" : $row_9,
			"row_10" : $row_10,
			"row_11" : $row_11,
			"row_12" : $row_12
		}
JSON;
	exit;
}

if ($typeId == "sumball")
{
	$gid=(int)@$_POST['gid'];
	if (is_int($gid))
	{
		$result = history_result(0);
		$BallArr = sum_ball_count ($result, $gid);
		$row_1 = json_encode($BallArr['row_1']);
		$row_2 = json_encode($BallArr['row_2']);
		echo <<<JSON
				{
					"row_1" : $row_1,
					"row_2" : $row_2
				}
JSON;
	}
	exit;
}

if ($typeId == "getwin"){
	$winMoney = json_encode(getWin ($user));
	echo  $winMoney;
}

?>