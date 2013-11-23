<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
 

$ConfigModel = configModel("
`g_out_time`,
`g_automatic_open_number_lock`,
`g_automatic_open_result_lock`,
`g_up_odds_mix`,
`g_odds_execution_lock`,
`g_odds_num`,
`g_odds_str`,
`g_up_odds_mix_cq`,
`g_odds_num_cq`,
`g_odds_str_cq`,
`g_odds_num_gx`,
`g_odds_str_gx`,
`g_automatic_money_lock`,
`g_insert_number_day`,
`g_close_time`,
`g_up_odds_mix_pk`,
`g_odds_num_pk`,
`g_odds_str_pk`,
`g_up_odds_mix_nc`,
`g_odds_num_nc`,
`g_odds_str_nc`,
`g_up_odds_mix_xj`,
`g_odds_num_xj`,
`g_odds_str_xj`,
`g_restore_money_lock`");  
isUserSession(); 
 
 
switch($_REQUEST['bclass_wd']){ 
	case "xinyunnongchang":
		{ 
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']);
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan5` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu Asc LIMIT 1 ", 1);  
			if ($result && $result[0]['g_qishu'] <= $List['openTerm'])
			{
				 
				$number = $List['openTerm'];
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan5 where g_qishu='".$number."' limit 0,1");
				}
				$lastNum = mb_substr($number, -2); 
				if ($lastNum !=13)
				{
					if($lastNum==97){
						$day = substr($number,0,strlen($number)-3);
						$nextNumber = date("Ymd",strtotime($day)+60*60*24)."001";
					}else{
						$nextNumber = $number+1;
					}
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					if ($db->query("DELETE FROM `g_kaipan5` WHERE g_qishu <= '{$number}'  ", 2))
						$db->query("UPDATE `g_kaipan5` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2);
				}
				else
				{
					insertNumbernc('09:53:00', $ConfigModel['g_insert_number_day'], 10, 14, 110, $ConfigModel['g_close_time']);
				}
				
				if (!$db->query("SELECT `g_id` FROM `g_history5` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 5 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history5` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 5) ", 2);  
					$date = date('Y-m-d H:i');
					$list = $List['openResult']; 
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}', `g_ball_6` = '{$list[5]}', `g_ball_7` = '{$list[6]}', `g_ball_8` = '{$list[7]}' ";
					$db->query("UPDATE `g_history5` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2); 
				}
				getNumberByBall_nc($List['openTerm']);
			}
			auto_kaipan(1);
		}
		break;
	case "gdkl10f":
		{ 
			 
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']);
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu Asc LIMIT 1 ", 1);  
			if ($result && $result[0]['g_qishu'] <= $List['openTerm'])
			{
				 
				$number = $List['openTerm'];
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan where g_qishu='".$number."' limit 0,1");
				}
				$lastNum = mb_substr($number, -2);
				if ($lastNum < 84)
				{
					$nextNumber = $number+1;
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					if ($db->query("DELETE FROM `g_kaipan` WHERE g_qishu <= '{$number}'  ", 2))
						$db->query("UPDATE `g_kaipan` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2);
				}
				else if ($lastNum == 84)
				{
					InsertNumber (1,$ConfigModel['g_close_time']);  
				}
				
				if (!$db->query("SELECT `g_id` FROM `g_history` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 1 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 1) ", 2);  
					$date = date('Y-m-d H:i');
					$list = $List['openResult']; 
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}', `g_ball_6` = '{$list[5]}', `g_ball_7` = '{$list[6]}', `g_ball_8` = '{$list[7]}' ";
					$db->query("UPDATE `g_history` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2); 
				}
				getNumberByBall_gd($List['openTerm']);
			}
			auto_kaipan(1);
		}
		break;
	case "cqssc":
		{
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan2` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1);
			 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm'];
				$lastNum = mb_substr($number, -2);
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan2 where g_qishu='".$number."' limit 0,1");
				}
				
				if ($lastNum != 23)
				{
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					$db->query("DELETE FROM `g_kaipan2` WHERE g_qishu <= '{$number}'  ", 2);
					//開啟下一期期數
					$nextNumber = mb_substr($number, -3) == 120 ? date( "Ymd", mktime(0, 0, 0, date('m'), date('d'), date('Y'))).'001' : $number+1;
					$db->query("UPDATE `g_kaipan2` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2); 
				}
				else
				{
					insertNumbers('09:50:00', 1, 10, 24, 143, $ConfigModel['g_close_time']); 
				} 
				
				if (!$db->query("SELECT `g_id` FROM `g_history2` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 2 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history2` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 2) ", 2);  
					$date = date('Y-m-d H:i');
					$list = $List['openResult'];
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}' ";
					$db->query("UPDATE `g_history2` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_cq($number);
			}
			auto_kaipan(2);
			
		}
		break;
	case "xjssc":
		{
			 
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan8` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1); 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm'];
				$lastNum = mb_substr($number, -2);
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan8 where g_qishu='".$number."' limit 0,1");
				} 
				if ($lastNum != 96)
				{
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					$db->query("DELETE FROM `g_kaipan8` WHERE g_qishu <= '{$number}'  ", 2);
					//開啟下一期期數
					$nextNumber = $number+1;
					$db->query("UPDATE `g_kaipan8` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2); 
				}
				else
				{
					insertNumberxj (0); 
				}  
				if (!$db->query("SELECT `g_id` FROM `g_history8` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 8 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history8` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 8) ", 2);  
					$date = date('Y-m-d H:i');
					$list = $List['openResult'];
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}' ";
					$db->query("UPDATE `g_history8` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_xj($number);
			}
			auto_kaipan(8);
		}	 
		break;
	case "pk10":
	case "klsc":
		{
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan6` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1); 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm'];
				$dt = $result[0]["g_open_date"];
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan6 where g_qishu='".$number."' limit 0,1");
				}
				
				$tt=false;
				if(strtotime($dt)!=strtotime(date("Y-m-d",strtotime($dt))." 23:57:30")) 
				{
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					$db->query("DELETE FROM `g_kaipan6` WHERE g_qishu <= '{$number}'  ", 2); 
					//開啟下一期期數
					$nextNumber = $number+1;
					$db->query("UPDATE `g_kaipan6` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2); 
					 
				}
				else
				{
					$tt=true;
					insertNumber_pk10 (1,$ConfigModel['g_close_time']); 
				} 
				
				//將開獎時間已經結束的期數添加到歷史記錄
				if (!$db->query("SELECT `g_id` FROM `g_history6` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 6 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history6` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 6) ", 2); 
					$date = date('Y-m-d H:i');
					$list = $List['openResult'];
					$set = "`g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}',`g_ball_6` = '{$list[5]}', `g_ball_7` = '{$list[6]}', `g_ball_8` = '{$list[7]}', `g_ball_9` = '{$list[8]}', `g_ball_10` = '{$list[9]}' ";
					$db->query("UPDATE `g_history6` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_pk10($List['openTerm'],$tt);
			}
			
			auto_kaipan(4);
		}
		break; 
	case "gxkl10f":
		{
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan3` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1);
			 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm'];
				$lastNum = mb_substr($number, -2);
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan3 where g_qishu='".$number."' limit 0,1");
				}
				
				if ($lastNum != 50)
				{
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					$db->query("DELETE FROM `g_kaipan3` WHERE g_qishu <= '{$number}'  ", 2);
					//開啟下一期期數
					$nextNumber = $number+1;
					$db->query("UPDATE `g_kaipan3` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2); 
				}
				else
				{
					InsertNumbergx (1,$ConfigModel['g_close_time']); 
				} 
				
				if (!$db->query("SELECT `g_id` FROM `g_history3` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 3 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history3` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 3) ", 2);   
					$list = $List['openResult'];
					$date = date('Y-m-d H:i');
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}' ";
					$db->query("UPDATE `g_history3` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_gx10f($number);
			}
			auto_kaipan(3);
			
		}
		break;
	case "lhc":
		{
			break;
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : date("Y-m-d H:i:s");
			$nextNumber=$_REQUEST['nextexpect'];
			$nextDT=$_REQUEST['nextdt'];
			$number = $List['openTerm']; 
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan_lhc` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1); 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm']; 
				 
				
				if (!$db->query("SELECT `g_id` FROM `g_history_lhc` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 7 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history_lhc` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 7) ", 2);   
					$list = $List['openResult'];
					$date = date('Y-m-d H:i');
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}', `g_ball_6` = '{$list[5]}', `g_ball_7` = '{$list[5]}'  ";
					$db->query("UPDATE `g_history_lhc` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_lhc($number);
			}else{
				 
				$date = date('Y-m-d H:i');
				if (!$db->query("SELECT `g_id` FROM `g_history_lhc` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 7 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history_lhc` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 7) ", 2);   
					$list = $List['openResult']; 
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}', `g_ball_4` = '{$list[3]}', `g_ball_5` = '{$list[4]}', `g_ball_6` = '{$list[5]}', `g_ball_7` = '{$list[5]}'  ";
					$db->query("UPDATE `g_history_lhc` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
			}
		}
		break;
		case "jsk3":
		{
			$List['openTerm']=$_REQUEST['expect'];
			$List['openResult']=explode(",",$_REQUEST['opencode']); 
			$List['enddt']= isset($_REQUEST['enddt']) ? $_REQUEST['enddt'] : "";
			$result = $db->query("SELECT `g_qishu`,  `g_open_date` FROM `g_kaipan9` WHERE `g_lock` = 2 or `g_lock` = 3 ORDER BY g_qishu ASC LIMIT 1 ", 1);
			 
			if (($result && $result[0]['g_qishu'] <= $List['openTerm']))
			{
				$error = 1;
				$number = $List['openTerm'];
				$lastNum = mb_substr($number, -2);
				if($List['enddt']!=""){
					$date = $List['enddt'];
				}else{
					$date = $db->selectField("select g_open_date from g_kaipan9 where g_qishu='".$number."' limit 0,1");
				}
				
				if ($lastNum != 82)
				{
					//刪除開獎時間已經結束的期數、最後一期不執行刪除
					$db->query("DELETE FROM `g_kaipan9` WHERE g_qishu <= '{$number}'  ", 2);
					//開啟下一期期數
					$nextNumber = $number+1;
					$db->query("UPDATE `g_kaipan9` SET `g_lock` = 2 WHERE `g_qishu` = '{$nextNumber}' LIMIT 1 ", 2); 
				}
				else
				{
					insertNumberjsk3 (1,$ConfigModel['g_close_time']); 
				} 
				
				if (!$db->query("SELECT `g_id` FROM `g_history9` WHERE `g_qishu` = '{$number}' AND `g_game_id` = 9 LIMIT 1", 0)){
					$db->query("INSERT INTO `g_history9` (`g_qishu`, `g_date`, `g_game_id`) VALUES ('{$number}', '{$date}', 9) ", 2);   
					$list = $List['openResult'];
					$date = date('Y-m-d H:i');
					$set = " `g_ball_1` = '{$list[0]}', `g_ball_2` = '{$list[1]}', `g_ball_3` = '{$list[2]}' ";
					$db->query("UPDATE `g_history9` SET {$set} WHERE g_qishu = '{$number}' LIMIT 1 ", 2);
				}
				getNumberByBall_jsk3($number);
			}
			auto_kaipan(9); 
		}
		break;
}
 
  
/**
 * 讀取即將開獎號碼
 * @param int
 * Enter description here ...
 */
 function getNumberByBall_lhc ($_number)
{
	global $List;
	//已獲取到號碼
	$db = new DB();
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];  
	//降賠率
	initializeOddslhc();
	global $ConfigModel; 
	//結算 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountlhc($_number);
		$Amount->ResultAmount();
		echo "结算";
	}
	echo "未结算";
	 
}

function getNumberByBall_xj ($number)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult']; 
	//還原賠率
	initializeOddsxj(); 
	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) != 84)
	{
		$AutomaticOddscq = new AutomaticOddsxj($ConfigModel['g_up_odds_mix_xj'], $ConfigModel['g_odds_num_xj'], $ConfigModel['g_odds_str_xj']);
		$AutomaticOddscq->UpExecution();
	} 
	 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amountcq = new SumAmountxj($number);
		$Amountcq->ResultAmount();
		echo "结算";
	}
	 
}

 function getNumberByBall_gd ($_number)
{
	global $List;
	//已獲取到號碼
	$db = new DB();
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	
	 
	//還原賠率
	initializeOdds(); 
	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) < 84)
	{
		$AutomaticOdds = new AutomaticOdds($ConfigModel['g_up_odds_mix'], $ConfigModel['g_odds_num'], $ConfigModel['g_odds_str']);
		$AutomaticOdds->UpExecution();
	}
	//結算 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmount($_number);
		$Amount->ResultAmount();
		echo "结算";
	}
	echo "未结算";
	 
	if (mb_substr($_number, -2) == 84)
	{ 
		//加載期數
		InsertNumber($ConfigModel['g_insert_number_day'], $ConfigModel['g_close_time']); 
	}
}

 function getNumberByBall_nc ($_number)
{
	global $List;
	//已獲取到號碼
	$db = new DB();
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	
	 
	//還原賠率
	initializeOddsnc(); 
	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) != 13)
	{
		$AutomaticOdds = new AutomaticOddsnc($ConfigModel['g_up_odds_mix_nc'], $ConfigModel['g_odds_num_nc'], $ConfigModel['g_odds_str_nc']);
		$AutomaticOdds->UpExecution();
	}
	//結算 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountnc($_number);
		$Amount->ResultAmount();
		echo "结算";
	}
	echo "未结算";
	 
	if (mb_substr($_number, -2) == 13)
	{ 
		//加載期數
		insertNumbernc('09:53:00', $ConfigModel['g_insert_number_day'], 10, 14, 110, $ConfigModel['g_close_time']);
	}
}

function getNumberByBall_cq ($number)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	 
	//還原賠率
	initializeOddscq();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) != 23)
	{
		$AutomaticOddscq = new AutomaticOddscq($ConfigModel['g_up_odds_mix_cq'], $ConfigModel['g_odds_num_cq'], $ConfigModel['g_odds_str_cq']);
		$AutomaticOddscq->UpExecution();
	} 
	 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amountcq = new SumAmountcq($number);
		$Amountcq->ResultAmount();
		echo "结算";
	}
	echo "未结算";
	if (mb_substr($number, -2) == 23)
	{
		//金額還原
		RestoreMoney($ConfigModel['g_restore_money_lock']);
		insertNumbers('09:50:00', $ConfigModel['g_insert_number_day'], 10, 24, 143, $ConfigModel['g_close_time']);
	}
	 
}
 
 
function getNumberByBall_gx10f ($number)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	 
	//還原賠率
	initializeOddsgx();

	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1 && mb_substr($_number, -2) < 50)
	{
		$AutomaticOddscq = new AutomaticOddsgx($ConfigModel['g_up_odds_mix'], $ConfigModel['g_odds_num_gx'], $ConfigModel['g_odds_str_gx']);
		$AutomaticOddscq->UpExecution();
	} 
	 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amountcq = new SumAmountgx($number);
		$Amountcq->ResultAmount();
		echo "结算";
	}
	 
}

function getNumberByBall_jsk3 ($number)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult'];
	 
	//還原賠率
	initializeOddsjsk3();

	//降賠率
	global $ConfigModel; 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amountcq = new SumAmountjsk3($number);
		$Amountcq->ResultAmount();
		echo "结算";
	}
	 
}
 

/**
 * 讀取即將開獎號碼
 * @param int
 * Enter description here ...
 */
function getNumberByBall_pk10 ($number,$tt=false)
{
	global $List,$db;
	$_number = $number;   
	$date = date('Y-m-d H:i');
	$list = $List['openResult']; 
	//還原賠率
	initializeOddspk(); 
	//降賠率
	global $ConfigModel;
	if ($ConfigModel['g_odds_execution_lock'] == 1  && $tt==false )
	{
		$AutomaticOddscq = new AutomaticOddspk($ConfigModel['g_up_odds_mix_pk'], $ConfigModel['g_odds_num_pk'], $ConfigModel['g_odds_str_pk']);
		$AutomaticOddscq->UpExecution();
	} 
	 
	if ($ConfigModel['g_automatic_money_lock'] == 1)
	{
		//結算
		$Amount = new SumAmountpk($number);
		$Amount->ResultAmount();
		echo "结算";
	}
	echo "没结算";
	 
	 
}

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
?>