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
	$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`  FROM g_history8 WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1";
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
	$GameInfoxj = new GameInfoxj();
	$result = $GameInfoxj->OpenNumberCount($mid);
	$result = json_encode($result);
	$resulta = $GameInfoxj->OpenNumberCounta (1, 0, -1);
	$resultb = $GameInfoxj->OpenNumberCounta (2, 0, -1);
	$resultc = $GameInfoxj->OpenNumberCounta (3, 0, -1);
	$resultd = $GameInfoxj->OpenNumberCounta (4, 0, -1);
	$resulte = $GameInfoxj->OpenNumberCounta (5, 0, -1);
	$resulth = $GameInfoxj->OpenNumberCountb();
	$resulta = json_encode($resulta);
	$resultb = json_encode($resultb);
	$resultc = json_encode($resultc);
	$resultd = json_encode($resultd);
	$resulte = json_encode($resulte);
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
				"row8" : $resulth
			}
JSON;
exit;
}
else if ($tid == 2)
{
	//獲取封盤時間、開獎時間、刷新時間
	$db = new DB();
	$result = $db->query("SELECT `g_qishu`, `g_feng_date`, `g_open_date` FROM g_kaipan8 WHERE `g_lock` = 2 LIMIT 1 ", 1);
	if ($result && Copyright)
	{
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90; //刷新時間
		if($openTime<=0){
			auto_kaipan(8);
			$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan8 WHERE g_lock = 2  LIMIT 1";
			$result = $db->query($sql, 1);
			$endTime = strtotime($result[0]['g_feng_date']) - time();
			$openTime =  strtotime($result[0]['g_open_date']) - time();
			$Phases = $result[0]['g_qishu'];
			$RefreshTime = 90;
		}
		//取出1-8球和總和龍虎雙面賠率
		$db=new DB();
		$sql = "SELECT  `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`,`g_type`  FROM `g_odds8` WHERE `g_type` = 'Ball_1' OR `g_type` = 'Ball_2' OR `g_type` = 'Ball_3' OR `g_type` = 'Ball_4' OR `g_type` = 'Ball_5'   ORDER BY g_id ASC ";
		$sresult = $db->query($sql, 1);
		$list = $sresult;
		$oddsMax = 0;
		 
		$arrList = array();
		for ($i=0; $i<count($list); $i++){
			$str=$list[$i]['g_type'];
			foreach ($list[$i] as $key=>$value){
				$arrList[$i][$key] = setoddsxj($key, $value, NULL, $user, 0,$str);
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
	$result = $db->query("SELECT `g_qishu` FROM `g_history8` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
}











?>