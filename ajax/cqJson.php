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
if ($_SERVER["REQUEST_METHOD"] != "POST") exit;
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
$typeid = $_POST['typeid'];
if ($typeid == 1 && Copyright)
{
	$db = new DB();
	//最新開獎記錄
	$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`  FROM g_history2 WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1";
	$result = $db->query($sql, 0);
	$number = $result[0][0];
	$ballArr = array();
	for ($i=0; $i<count($result[0]); $i++)
	{
		if ($i != 0)
			$ballArr[] = $result[0][$i];
	}
	$ballArr = json_encode($ballArr);
	$winMoney = json_encode(getWin ($user));
	$mid = $_POST['mid'];
	$gameInfo = new GameInfo();
	$result = $gameInfo->OpenNumberCount($mid);
	$result = json_encode($result);
	$resulta = $gameInfo->OpenNumberCounta ($mid, 0, -1);
	$resultb = $gameInfo->OpenNumberCounta ($mid, 3, 0);
	$resultc = $gameInfo->OpenNumberCounta ($mid, 4, 0);
	$resultd = $gameInfo->OpenNumberCounta (null, 5, 1);
	$resulte = $gameInfo->OpenNumberCounta (null, 6, 1);
	$resultf = $gameInfo->OpenNumberCounta (null, 2, 2);
	$resulth = $gameInfo->OpenNumberCountb();
	$resulta = json_encode($resulta);
	$resultb = json_encode($resultb);
	$resultc = json_encode($resultc);
	$resultd = json_encode($resultd);
	$resulte = json_encode($resulte);
	$resultf = json_encode($resultf);
	$resulth = json_encode($resulth);
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr,
				"row1" : $result,
				"row2" : $resulta,
				"row3" : $resultb,
				"row4" : $resultc,
				"row5" : $resultd,
				"row6" : $resulte,
				"row7" : $resultf,
				"row8" : $resulth
			}
JSON;
exit;
}
else if ($typeid == 2 && Copyright)
{
	$db = new DB();
	$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan2 WHERE g_lock = 2  LIMIT 1";
	$result = $db->query($sql, 1);
	$endTime = strtotime($result[0]['g_feng_date']) - time();
	$openTime =  strtotime($result[0]['g_open_date']) - time();
	$Phases = $result[0]['g_qishu'];
	$RefreshTime = 90;
	if($openTime<=0){
		auto_kaipan(2);
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan2 WHERE g_lock = 2  LIMIT 1";
		$result = $db->query($sql, 1);
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90;
	} 
	$mid = $_POST['mid'];
	$sql = "SELECT `g_type`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14` FROM `g_odds2` WHERE g_type = 'Ball_{$mid}' OR g_type ='Ball_6' OR g_type='Ball_7' OR g_type ='Ball_8' OR g_type='Ball_9' ORDER BY g_id ASC";
	$oddsResult = $db->query($sql, 1);
	$ConfigModel= configModel("`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");
	
	$list = array();
	for ($i=0; $i<count($oddsResult); $i++)
	{
		foreach ($oddsResult[$i] as $k=>$v)
		{
			//1-5號碼
			if ($oddsResult[$i]['g_type'] == 'Ball_1' || $oddsResult[$i]['g_type'] == 'Ball_2' || $oddsResult[$i]['g_type'] == 'Ball_3' || $oddsResult[$i]['g_type'] == 'Ball_4' || $oddsResult[$i]['g_type'] == 'Ball_5')
			{
				if ($k != 'g_type' && $k != 'h11' &&$k != 'h12' &&$k != 'h13' &&$k != 'h14' && $v != null)
				{
					$arrList[$i][$k] = setoddscq($k, $v, $ConfigModel, $user, 0,$oddsResult[$i]['g_type']);
				}
				else if ($k != 'g_type' && $v != null)
				{
					$arrList[$i][$k] = setoddscq($k, $v, $ConfigModel, $user, 1);
				}
			}
			else if ($oddsResult[$i]['g_type'] == 'Ball_6' && $k != 'g_type' && $v != null && Copyright)
			{
				$arrList[$i][$k] = setoddscq($k, $v, $ConfigModel, $user, 1,$oddsResult[$i]['g_type']);
			}
			else if (($oddsResult[$i]['g_type'] == 'Ball_7'||$oddsResult[$i]['g_type'] == 'Ball_8'||$oddsResult[$i]['g_type'] == 'Ball_9') && $k != 'g_type' && $v != null)
			{
				$arrList[$i][$k] = setoddscq($k, $v, $ConfigModel, $user, 2,$oddsResult[$i]['g_type']);
			}
		}
	}
	$arrList = json_encode($arrList);
	echo <<<JSON
			{
				"Phases" : $Phases,
				"endTime" : "$endTime",
				"openTime" : "$openTime",
				"refreshTime" : "$RefreshTime",
				"oddslist" : $arrList
			}
JSON;
	exit;
}
else if ($typeid == 3)
{
	$db = new DB();
	$result = $db->query("SELECT `g_qishu` FROM `g_history2` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}













?>