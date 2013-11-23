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
//if ($_SERVER["REQUEST_METHOD"] != "POST") exit;
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
$typeid = $_REQUEST['typeid'];
if ($typeid == 1 && Copyright)
{
	$db = new DB();
	//最新開獎記錄
	$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`  FROM g_history9 WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 0,19";
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
	$gameinfo = new GameInfojsk3();
	$row1 = json_encode($gameinfo->OpenNumberCount());
	echo <<<JSON
			{
				"winMoney" : $winMoney,
				"number" : $number,
				"ballArr" : $ballArr,  
				"row1" : $row1
			}
JSON;
exit;
}
else if ($typeid == 2 && Copyright)
{
	$db = new DB();
	$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan9 WHERE g_lock = 2  LIMIT 1";
	$result = $db->query($sql, 1);
	$endTime = strtotime($result[0]['g_feng_date']) - time();
	$openTime =  strtotime($result[0]['g_open_date']) - time(); 
	$Phases = $result[0]['g_qishu'];
	$RefreshTime = 90;
	if($openTime<=0){
		auto_kaipan(9);
		$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan9 WHERE g_lock = 2  LIMIT 1";
		$result = $db->query($sql, 1);
		$endTime = strtotime($result[0]['g_feng_date']) - time();
		$openTime =  strtotime($result[0]['g_open_date']) - time();
		$Phases = $result[0]['g_qishu'];
		$RefreshTime = 90;
	} 
	$mid = $_REQUEST['mid'];
	for($i=1;$i<=17;$i++)$f.=",`h{$i}`";
	$sql = "SELECT `g_type` {$f} FROM `g_odds9`     ORDER BY g_id ASC";
	$oddsResult = $db->query($sql, 1); 
	$list = array();
	for ($i=0; $i<count($oddsResult); $i++)
	{
		$str=$oddsResult[$i]['g_type'];
		foreach ($oddsResult[$i] as $key=>$value)
		{
			$arrList[$i][$key] = setoddsjsk3($key, $value,$user, 0,$str);
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
	$result = $db->query("SELECT `g_qishu` FROM `g_history9` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
} 
?>