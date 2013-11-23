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
`g_up_odds_mix`,
`g_odds_execution_lock`,
`g_odds_num_gx`,
`g_odds_str_gx`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`");
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit;
		
	$Pid = $_POST['pid'];
	switch ($Pid)
	{
		case 1 :
			getNumberList();
			break;
		case 2 :
			setNumberAndPlanning();
			break;
		case 3 :
			isUserSession();
			break;
		case 4 :
			getNumberByBall ($_POST['numberid']);
			break;
	}

	
}

/**
 * 5分鐘清空過期的登錄用戶
 */
function isUserSession()
{
	global $ConfigModel;
	$minutes = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s"))-($ConfigModel['g_out_time']*60));
	$db = new DB();
	$sql = "UPDATE `g_rank` SET `g_out`=0 WHERE g_count_time < '{$minutes}' AND `g_out`=1";
	$db->query($sql, 2);
	$sql = "UPDATE `g_user` SET `g_out`=0 WHERE g_count_time < '{$minutes}' AND `g_out`=1 ";
	$db->query($sql, 2);
	$sql = "UPDATE `g_relation_user` SET `g_out`=0 WHERE g_count_time < '{$minutes}' AND `g_out`=1 ";
	$db->query($sql, 2);
}

/**
 * 讀取未開獎、已開盤的期數
 * Enter description here ...
 */
function getNumberList ()
{
	global $ConfigModel;
	if ($ConfigModel['g_automatic_open_number_lock']==1)
	{
		$db = new DB();
		$number = null;
		$endTime =null;
		$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan3` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
		$List = getFile();
		if ($result && $result[0]['g_qishu'] >= $List['openTerm'])
		{
			$error = 0;
			$number = json_encode($result[0]['g_qishu']);
			$endTime = json_encode(strtotime($result[0]['g_open_date']) - time());
		}
		else
		{
			$error = 1;
			$number = $result[0]['g_qishu'];
			$lastNum = mb_substr($number, -2);
			if ($lastNum < 50)
			{
				$nextNumber = $number+1;
				//刪除開獎時間已經結束的期數、最後一期不執行刪除
				if ($db->query("DELETE FROM `g_kaipan3` WHERE g_qishu = '{$number}' AND `g_lock` = 2 LIMIT 1 ", 2))
					$db->query("UPDATE `g_kaipan3` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2);
				getNumberList();
				return ;
			}
			else if ($lastNum == 50)
			{
				InsertNumbergx ($number,$ConfigModel['g_insert_number_day'], $ConfigModel['g_close_time']);
				getNumberList ();
			}
		}
	}
	else 
	{
		$number = '""';
		$endTime = '""';
		$error = 9;
	}
	echo <<<JSON
			{
				"number" : $number,
				"endTime" : $endTime,
				"error" : $error
			}
JSON;
}

/**
 * 設置下一期開獎信息
 */
function setNumberAndPlanning ()
{
	$db = new DB();
	$result = $db->query("SELECT `g_qishu` FROM `g_kaipan3` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
	$List = getFile();
	if ($result && $result[0]['g_qishu'] >= $List['openTerm'])
	{
		$date = date('Y-m-d H:i');
		$nums = $result[0]['g_qishu'];
		$lastNum = mb_substr($nums, -2);
		//將開獎時間已經結束的期數添加到歷史記錄
		if (!$db->query("SELECT `g_id` FROM `g_history3` WHERE `g_qishu` = '{$nums}' AND `g_game_id` = 3 LIMIT 1", 0))
			$db->query("INSERT INTO `g_history3` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$nums}', '{$date}', 3) ", 2);
		if ($lastNum < 50)
		{
			/**
			 * 開啟下一期期數
			 * 刪除開獎時間已經結束的期數
			 */
			$number = $nums+1;
			if ($db->query("UPDATE `g_kaipan3` SET `g_lock` = 2 WHERE `g_qishu` = '{$number}' LIMIT 1 ", 2))
				$db->query("DELETE FROM `g_kaipan3` WHERE g_qishu = '{$nums}' AND `g_lock` = 2 LIMIT 1 ", 2);
		}
		echo 1;
	}
	else 
	{
		echo 2;
	}
}

/**
 * 讀取即將開獎號碼
 * @param int
 * Enter description here ...
 */
function getNumberByBall ($number)
{
	$List = getFile();
	$_number = $number;
	if ($_number == $List['openTerm']) //期數一致
	{
		setBall($List, $_number);
	}
	else 
	{
		$List = getFile2();
		if ($_number == $List['openTerm'])
		{
			setBall($List, $_number);
		}
		else 
		{
			$List = getFile3();
			if ($_number == $List['openTerm'])
			{
				setBall($List, $_number);
			}
			else 
			{
				echo 2;
			}
		}
	}
}

function setBall($List, $_number)
{
	//已獲取到號碼
	$db = new DB();

	//$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	$set = "`g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}'  ";
	$db->query("UPDATE `g_history3` SET {$set} WHERE g_qishu = '{$_number}' LIMIT 1 ", 2);


	//還原賠率
	initializeOdds();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) < 50)
	{
		$AutomaticOdds = new AutomaticOddsgx($ConfigModel['g_up_odds_mix'], $ConfigModel['g_odds_num'], $ConfigModel['g_odds_str']);
		$AutomaticOdds->UpExecution();
	}
	//結算
	inventory ($_number, $ConfigModel);
}

/**
 * 結算報表
 * @param int 已經開獎的期數
 * Enter description here ...
 */
function inventory ($number, $ConfigModel)
{

	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountgx($number);
		$Amount->ResultAmount();
	}
	echo 1;
	if (mb_substr($number, -2) == 50)
	{
		//金額還原
		//$Amount->RestoreMoney($ConfigModel['g_restore_money_lock']);
		
		//加載期數
		InsertNumbergx($ConfigModel['g_insert_number_day'], $ConfigModel['g_close_time']);
		
		//數據庫備份
		/*$dateTime = date('YmdHis');
		$mysqlDataBak = new MysqlDataBak($BakPassWord, $dateTime);
		$mysqlDataBak->FormatTables();*/
	}
}

/**
 * 讀取官方開獎號碼
 * Enter description here ...
 * @return object
 */


function getFile()
{
	$List = array();
	$url = "http://www.lehecai.com/lottery/ajax_latestdrawn.php?lottery_type=545";
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->data[0]->phase;
	$List['openResult'] = $fileString->data[0]->result->result[0]->data;
	return $List;
}
/*
function getFile()
{
	$List = array();
	$url = "http://113.105.169.163:8585/json/list.txt?v=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->number;
	$List['openResult'] = $fileString->list;
	return $List;
	
	$List = array();
	$url = "http://98.126.141.148/ad.html";
	$fileString = urldecode(@file_get_contents($url));
	//$fileString = json_decode($fileString);
	$numbersList=explode('#',$fileString);
	$List['openTerm'] = $numbersList[0];
	$List['openResult'] = explode(';',$numbersList[1]);
	return $List;
	
}*/



function getFile2()
{
	/*$url = "http://www.gdfczx.org.cn/FetchData.action?name=L07RaffleData&_=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = trim($fileString);
	$fileString = mb_substr($fileString, 14, mb_strlen($fileString)-15);
	$fileString = json_decode($fileString);
	$s = array(); 
	$p=0;
	$c = $fileString->awardInfoList[0]->luckNum;
	while ($p<mb_strlen($c)){
		$s[] = mb_substr($c, $p,2);
		$p=$p+2;
	}
	$List['openTerm'] = $fileString->issueName;
	$List['openResult'] =$s;
	return $List;*/

}

?>