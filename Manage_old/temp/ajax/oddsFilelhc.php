<?php
define('Copyright', '作者QQ:1834219632');
//if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Manage/ExistUser.php';
	global $Users;
	$db=new DB();
	$mid = $_REQUEST['mid']; 
	if ($mid == 1)
	{
		include_once ROOT_PATH.'class/UserReportInfolhc.php';
		$userReportInfolhc = new UserReportInfolhc($Users[0]);
		$result = $userReportInfolhc->GetNumberAll();
		$result = json_encode($result);
		$infolhc = $userReportInfolhc->GetInfolhc();
		$infolhc = json_encode($infolhc);
		echo <<<JSON
				{
					"timeList" : $result,
					"infolhc" : $infolhc
				}
JSON;
	}
	if ($mid == 2)
	{
		$h=null;
		for ($i=1; $i<=78; $i++){$h .="h{$i},";}
		$h=substr($h,0,strlen($h)-1);
		$sql = "SELECT $h FROM `g_odds_lhc`  ORDER BY g_id ASC";
		$oddsResult = $db->query($sql, 1);
		$list = array();
		for ($i=0; $i<count($oddsResult); $i++)
		{
			foreach ($oddsResult[$i] as $k=>$v)
			{
				if ($v != null)
					$list[$i][$k] = $v;
			}
		}
		$list = json_encode($list);
		echo <<<JSON
				{
					"oddsList" : $list
				}
JSON;
	}
	if ($mid == 3)
	{
		$sql = "SELECT g_qishu FROM g_history_lhc WHERE g_ball_1 is not null   ORDER BY g_id DESC LIMIT 1";
		$result = $db->query($sql, 0);
		echo  $result[0][0];
	}
	if ($mid == 4)
	{
		include_once ROOT_PATH.'class/GameInfolhc.php';
		include_once ROOT_PATH.'class/UserReportInfolhc.php';
		$userReportInfo = new UserReportInfolhc($Users, 1);
		$winMoney = json_encode($userReportInfo->SumResult($Users));
		$gameInfo = new GameInfolhc();
		$result = $gameInfo->OpenNumberCountb();
		$result = json_encode($result);
		echo <<<JSON
				{
					"dayWin" : $winMoney,
					"result" : $result
				}
JSON;
	}
	if ($mid == 5)
	{
		echo 'cccc';
	}
	if ($mid == 'kaijiang'){
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
		echo <<<JSON
				{
					"winMoney" : $winMoney,
					"number" : $number,
					"ballArr" : $ballArr
				}
JSON;
exit;
	}
}
?>