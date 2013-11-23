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
//include_once ROOT_PATH.'Manage/config/config.php';
global $user;
$tid = $_POST['tid'];

if ($tid == 1)
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
	$mid = 5;
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
else if ($tid == 2)
{
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan2 WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result && Copyright)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90; //刷新時間
		if($openTime<=0){
			auto_kaipan(2);
			$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan2 WHERE g_lock = 2  LIMIT 1";
			$result = $db->query($sql, 1);
			$endTime = strtotime($result[0]['g_feng_date']) - time();
			$openTime =  strtotime($result[0]['g_open_date']) - time();
			$Phases = $result[0]['g_qishu'];
			$RefreshTime = 90;
		}
		//取出1-8球和總和龍虎雙面賠率
		$db=new DB();
		$sql = "SELECT  `h11`, `h12`, `h13`, `h14`  FROM `g_odds2` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' OR `g_type` = 'Ball_3' OR `g_type` = 'Ball_4' OR `g_type` = 'Ball_5'   ORDER BY g_id ASC ";
		$sresult = $db->query($sql, 1);
		$sql = "SELECT `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`  FROM `g_odds2` WHERE g_type = 'Ball_6' ORDER BY g_id ASC ";
		$eresult = $db->query($sql, 1);
		$list = array_merge($sresult, $eresult);
		$oddsMax = 0;
		$ConfigModel= configModel("`g_odds_ratio_cq_b1`,`g_odds_ratio_cq_b2`,`g_odds_ratio_cq_b3`,`g_odds_ratio_cq_c1`,`g_odds_ratio_cq_c2`,`g_odds_ratio_cq_c3`");
		$arrList = array();
		for ($i=0; $i<count($list); $i++){
			foreach ($list[$i] as $key=>$value){
				$arrList[$i][$key] = setoddscq($key, $value, $ConfigModel, $user, 1);
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
	$result = $db->query("SELECT `g_qishu` FROM `g_history2` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}











?>