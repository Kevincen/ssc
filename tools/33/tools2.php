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
//include_once ROOT_PATH.'Manage/config/config.php';
$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_automatic_open_result_lock`,
`g_up_odds_mix_cq`,
`g_odds_num_cq`,
`g_odds_str_cq`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`,
`g_odds_execution_lock`,
`g_insert_number_day`,
`g_restore_money_lock`");
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ($_SERVER["SERVER_NAME"] != '127.0.0.1') exit;
		
	$Pid = $_POST['pid'];
	switch ($Pid)
	{
		case 1 :
			getNumberList_s();
			break;
		case 2 :
			setNumberAndPlanning_s();
			break;
		case 4 :
			getNumberByBall_s ($_POST['numberid']);
			break;
	}
/*
//补奖
	$Listb = getFile2();
	$bnumberid=$Listb['openTerm'];
	$list_o = $Listb['openResult'];
	$db_b = new DB();
	$sql = "select * from g_history2 where g_qishu='{$bnumberid}' ";
	$result_b=$db_b->query($sql, 1);
	if($result_b){
	if($result_b[0]['g_ball_1']==null)
	setBall($Listb, $bnumberid);
	//echo "OK";
	}else{
	//echo "未开盘";
	}
	*/
}

/**
 * 讀取未開獎、已開盤的期數
 * Enter description here ...
 */
function getNumberList_s ()
{
	global $ConfigModel;
	if ($ConfigModel['g_automatic_open_number_lock']==1)
	{
		$db = new DB();
		$number = null;
		$endTime =null;
		$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan2` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
		$List = getFile2 ();
		if (($result && $result[0]['g_qishu'] >= $List['openTerm']))
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
			if ($lastNum != 23)
			{
				//刪除開獎時間已經結束的期數、最後一期不執行刪除
				$db->query("DELETE FROM `g_kaipan2` WHERE g_qishu = '{$number}' AND `g_lock` = 2 LIMIT 1 ", 2);
				//開啟下一期期數
				$nextNumber = mb_substr($number, -3) == 120 ? date( "Ymd", mktime(0, 0, 0, date('m'), date('d'), date('Y'))).'001' : $number+1;
				$db->query("UPDATE `g_kaipan2` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2);
				getNumberList_s();
				return ;
			}
			else
			{
				InsertNumbers ();
				getNumberList_s ();
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
function setNumberAndPlanning_s ()
{
	$db = new DB();
	$result = $db->query("SELECT `g_qishu` FROM `g_kaipan2` WHERE `g_lock` = 2 ORDER BY g_qishu DESC LIMIT 1 ", 1);
	$List = getFile2 ();
	if ($result && $result[0]['g_qishu'] >= $List['openTerm'])
	{
		$date = date('Y-m-d H:i');
		$nums = $result[0]['g_qishu'];
		//將開獎時間已經結束的期數添加到歷史記錄
		if (!$db->query("SELECT `g_id` FROM `g_history2` WHERE `g_qishu` = '{$nums}' AND `g_game_id` = 1 LIMIT 1", 0))
			$db->query("INSERT INTO `g_history2` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$nums}', '{$date}', 2) ", 2);
			
		$lastNum = mb_substr($nums, -2);
		if ($lastNum != 23)
		{
			/**
			 * 開啟下一期期數
			 * 刪除開獎時間已經結束的期數
			 */
			$number = mb_substr($nums, -3) == 120 ? date( "Ymd", mktime(0, 0, 0, date('m'), date('d'), date('Y'))).'001' : $nums+1;
			$db->query("UPDATE `g_kaipan2` SET `g_lock` = 2 WHERE `g_qishu` = '{$number}' LIMIT 1 ", 2);
			$db->query("DELETE FROM `g_kaipan2` WHERE g_qishu = '{$nums}' AND `g_lock` = 2 LIMIT 1 ", 2);
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
function getNumberByBall_s ($number)
{
	global $ConfigModel;
	if ($ConfigModel['g_automatic_open_result_lock']==1)
	{
	$List = getFile2();
	$_number = $number;
	if ($_number == $List['openTerm']) //期數一致
	{
		setBall($List, $_number);
	}
	else 
	{
		$List = getFile();
		if ($_number == $List['openTerm'])
			setBall($List, $_number);
		else 
			echo 2;
	}
	}else{
		loadp($number);
		echo 1;
	}
}

function setBall($List, $_number)
{
	//已獲取到號碼
	$db = new DB();
	//$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}' ";
	$db->query("UPDATE `g_history2` SET {$set} WHERE g_qishu = '{$_number}' LIMIT 1 ", 2);
	
	//還原賠率
	initializeOddscq();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) != 23)
	{
		$AutomaticOddscq = new AutomaticOddscq($ConfigModel['g_up_odds_mix_cq'], $ConfigModel['g_odds_num_cq'], $ConfigModel['g_odds_str_cq']);
		$AutomaticOddscq->UpExecution();
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
		$Amount = new SumAmountcq($number);
		$Amount->ResultAmount();
	}
	if (mb_substr($number, -2) == 23)
	{
		//金額還原
		RestoreMoney($ConfigModel['g_restore_money_lock']);
		insertNumbers('09:50:00', $ConfigModel['g_insert_number_day'], 10, 24, 143, $ConfigModel['g_close_time']);
	}
	echo 1;
}


function loadp($number){
	//還原賠率
	initializeOddscq();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($number, -2) != 23)
	{	
		alert($number);
		$AutomaticOddscq = new AutomaticOddscq($ConfigModel['g_up_odds_mix_cq'], $ConfigModel['g_odds_num_cq'], $ConfigModel['g_odds_str_cq']);
		$AutomaticOddscq->UpExecution();
	}
	if (mb_substr($number, -2) == 23)
	{
		//金額還原
		RestoreMoney($ConfigModel['g_restore_money_lock']);
		insertNumbers('09:50:00', $ConfigModel['g_insert_number_day'], 10, 24, 143, $ConfigModel['g_close_time']);
	}

}

/**
 * 讀取官方開獎號碼
 * Enter description here ...
 * @return object
 */
function getFile ()
{
	$List = array();
	$url = "http://888.qq.com/channel/kuaipincai/get_recent_kjhm.php?loty_name=ssc&t=".time();
	$xml = new DOMDocument();
	@$xml->load($url);
	$List['openTerm'] =@$xml->getElementsByTagName('current')->item(0)->attributes->item(6)->nodeValue;
	$Number = @$xml->getElementsByTagName('current')->item(0)->attributes->item(7)->nodeValue;
	$List['openResult'] = explode(',', $Number);
	return $List;
}
function getFile2 ()
{
	$List = array();
	$url = "http://www.cailele.com/static/termInfo/150.txt?x=".time();
	$fileString = urldecode(@file_get_contents($url));
	$fileString = json_decode($fileString);
	$List['openTerm'] = $fileString->openTerm;
	$List['openResult'] = explode(',', $fileString->openResult);
	return $List;
}

function getFile3()
{
	$List = array();
	$url = "http://trade.500wan.com/static/public/ssc/xml/newlyopenlist.xml?".time();
	$doc = new DomDocument;
	$doc->Load($url);
	$lastNum =$doc->getElementsByTagName( "row" );
	$qihao=$lastNum->item(0)->getAttribute('expect');  
    $List['openTerm']="20".$qihao;
    $code=$lastNum->item(0)->getAttribute('opencode');
	$List['openResult']=explode(',', $code);
    return $List;
}

?>