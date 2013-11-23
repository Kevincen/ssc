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
	$sql = "SELECT  `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`  FROM g_history_lhc WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1";
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
	$mid = $_REQUEST['mid'];
	$gameInfo = new GameInfolhc(); 
	if( $mid <= 7){ //特碼---正碼(1-6)
		$resulta = $gameInfo->OpenNumberCounta ($mid, 0, -1);
		$resultb = $gameInfo->OpenNumberCounta ($mid, 0, 0);
		$resultc = $gameInfo->OpenNumberCounta ($mid, 1, 0);
		$resultd = $gameInfo->OpenNumberCounta ($mid, 2, 0);
		$resulte = $gameInfo->OpenNumberCounta ($mid, 3, 0);
		$resultf = $gameInfo->OpenNumberCounta ($mid, 4, 0);
	}else if($mid==8){ //正碼
		$resulta = $gameInfo->OpenNumberCounta ($mid, 0, 1);
		$resultb = $gameInfo->OpenNumberCounta ($mid, 5, 2);
		$resultc = $gameInfo->OpenNumberCounta ($mid, 6, 2);
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==9){ //半波
		$resulta = $gameInfo->OpenNumberCounta (7, 7, 3);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==10){ //五行
		$resulta = $gameInfo->OpenNumberCounta (7, 8, 3);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==11){ //特碼生肖
		$resulta = $gameInfo->OpenNumberCounta (7, 9, 3);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==12){ //一肖
		$resulta = $gameInfo->OpenNumberCounta (0, 10, 4);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==13){ //特尾
		$resulta = $gameInfo->OpenNumberCounta (7, 11, 3);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}else if($mid==15){ //特碼頭
		$resulta = $gameInfo->OpenNumberCounta (7, 12, 3);
		$resultb = array();
		$resultc = array();
		$resultd = array();
		$resulte = array();
		$resultf = array();
	}
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
	$sql = "SELECT  `g_qishu`, `g_feng_date`, `g_open_date`  FROM g_kaipan_lhc WHERE g_lock = 2  LIMIT 1";
	$result = $db->query($sql, 1);
	$endTime = strtotime($result[0]['g_feng_date']) - time();
	$openTime =  strtotime($result[0]['g_open_date']) - time();
	$Phases = $result[0]['g_qishu'];
	$RefreshTime = 90;
	$mid = $_REQUEST['mid'];
	for($i=1;$i<=78;$i++)$f.=",`h{$i}`";
	$sql = "SELECT `g_type` {$f} FROM `g_odds_lhc`     ORDER BY g_id ASC";
	$oddsResult = $db->query($sql, 1); 
	$list = array();
	for ($i=0; $i<count($oddsResult); $i++)
	{
		$str=$oddsResult[$i]['g_type'];
		foreach ($oddsResult[$i] as $key=>$value)
		{
			$arrList[$i][$key] = setoddslhc($key, $value,$user, 0,$str);
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
	$result = $db->query("SELECT `g_qishu` FROM `g_history_lhc` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
	$number = $result[0][0];
	echo $number;
} 
?>