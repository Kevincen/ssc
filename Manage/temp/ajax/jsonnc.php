<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-28
*/
define('Copyright', '作者QQ:1834219632');
//if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
	include_once ROOT_PATH.'Manage/ExistUser.php';
	global $Users;
	$db = new DB();
	$typeID = $_REQUEST['typeid'];
	if ($typeID == 1)
	{
		$userModel = new UserModel();
		$result = $userModel->GetUserModel(null, $_POST['name']);
		$validMoney = null;
		if ($result[0]['g_login_id'] != 89)
		{
			//得到當前用戶可用額
			if ($result[0]['g_login_id'] == 48){
				$validMoney = $result[0]['g_money'] - $userModel->SumMoney($result[0]['g_nid'], true); //取到會員總額度
			} else {
				$validMoney = $result[0]['g_money'] - $userModel->SumMoney($result[0]['g_nid'].UserModel::Like());
			}
		}
		$Size_KY = $result[0]['g_distribution'];
		if ($result[0]['g_login_id'] != 89)
		{
		echo <<<JSON
				{
					"money" : $validMoney,
					"Size_KY" : $Size_KY
				}
JSON;
}else{
echo <<<JSON
				{
					"Size_KY" : $Size_KY
				}
JSON;
}
	}
	else if ($typeID == 2)
	{
		$userModel = new UserModel();
		//$result = $userModel->GetUserModel($_SESSION['loginId'], $_SESSION['sName']);
		$result = $userModel->GetUserModel($Users[0]['g_login_id'], $Users[0]['g_name']);
		$id = $_POST['id'];
		if ($result[0]['g_login_id'] == 89 || $result[0]['g_login_id'] == 56) {
			if ($id == 1) {
				$name = '股東';
				$u = $result[0]['g_nid'].UserModel::Like();
			} else if($id==2) {
				$name = '總代理';
				$u = $result[0]['g_nid'].UserModel::Like().UserModel::Like();
			}else{
				$name = '分公司';
				$u = $result[0]['g_nid'];
			}
			if($result[0]['g_login_id'] == 89) $u=$u.UserModel::Like();
		} else if ($result[0]['g_login_id'] == 22){
			if ($id == 1) {
				$name = '股東';
				$u = $result[0]['g_nid'];
			} else {
				$name = '總代理';
				$u = $result[0]['g_nid'].UserModel::Like();
			}
		}else if ($result[0]['g_login_id'] == 78) {
			$name = '總代理';
			$u = $result[0]['g_nid'];
		}
		$user =$userModel->GetUserName_Like($u);
		$u = array();
		for ($i=0; $i<count($user); $i++){
			$u[$i]= $user[$i]['g_name'];
		}
					
		$u = json_encode($u);
		echo <<<JSON
				{
					"name" : "$name",
					"user" : $u
				}
		
JSON;
	}
	else if ($typeID == 3)
	{
		//雙面長龍
		global $BallString, $BallString_nc;
		$result = history_resultnc(0);
		$num_arr = sum_ball_count_1_nc ($BallString, $BallString_nc, $result, 2);
		arsort($num_arr);
		$num_arr = json_encode($num_arr);
			echo <<<JSON
				{
					"num" : $num_arr
				}
JSON;
	}
	else if ($typeID == 4) 
	{
		$cid = $_POST['cid'];
		$Mean = $_POST['meanid'];
		$_SESSION['Mean'.$cid] = $Mean;
		echo $_SESSION['Mean'.$cid];
	}
	else if ($typeID == 5)
	{
		$cid = $_POST['cid'];
		$userReportInfo = new UserReportInfonc($Users, $cid);
		$Info = $userReportInfo->ResultInfo();
		$Info = json_encode($Info);
		//当前用户今天输赢
		$winMoney = json_encode($userReportInfo->SumResult($Users));
		echo <<<JSON
				{
					"infoList" : $Info,
					"dayWin" : $winMoney
				}
JSON;
	}
	else if ($typeID == 6)
	{
		$db = new DB();
		$ResultList = '""';
		$error = null;
		$p = $_POST['nid'] == 1 ? "g_kaipan2" : "g_kaipan5";
		$result = $db->query("SELECT g_feng_date FROM {$p} WHERE `g_lock` = 2 AND g_qishu = '{$_POST['s_number']}' LIMIT 1 ", 1);
		if (!$result) {
			$error = '抱歉！第'.$_POST['s_number'].'期已經封盤';
		} else {
			$endTime = strtotime($result[0]['g_feng_date']) - time();
			if ($endTime < 0){
				$error = '抱歉！第'.$_POST['s_number'].'期已經封盤';
			} else {
				if ($Users[0]['g_login_id'] ==89 || $Users[0]['g_login_id'] ==56){
					$error = '抱歉！公司級帳號暫時無法補單。';
				} else {
					if (isset($Users[0]['g_lock_4']) && $Users[0]['g_lock_4'] !=1)
						$error = '抱歉！您無權限無法補單。';
					$dayMoney = $userModel->SumMoney($Users[0]['g_nid'].UserModel::Like());
					$dayMoney = $Users[0]['g_money']- $dayMoney;
					if ($dayMoney < 0 || $_POST['s_money'] > $dayMoney){
						$error = '抱歉！您剩餘可用金額：'.$dayMoney;
					} else {
						if ($Users[0]['g_login_id']==48){
							if ($Users[0]['g_Immediate2_lock'] != 1) 
								$error = '抱歉！您無權限無法補單。';
						}
						$arr = array();
						$arr['s_id'] =0;
						$arr['s_number'] = $_POST['s_number'];
						$arr['s_type'] = $_POST['s_type'];
						$arr['s_num'] = explode(',', $_POST['s_num']);
						$arr['s_money'] = explode(',', $_POST['s_money']);
						if ($_POST['s_odds'] == 'LM')
						{
							$arr['s_id'] = $_POST['s_id'];
							$arr['s_mingxi_1_str'] = $_POST['s_count'];
							$odds = $db->query("SELECT g_odds5 FROM g_zhudan WHERE g_qishu='{$arr['s_number']}' AND  
																		g_mingxi_1='{$arr['s_type']}' AND 
																		g_mingxi_1_str ='{$arr['s_mingxi_1_str']}' AND 
																		g_mingxi_2='{$arr['s_num'][0]}' LIMIT 1 ", 0);
							if (!$odds){
								$error = '抱歉！'.$arr['s_num'][0].' 號碼組合錯誤！';
							} else {
								$arr['s_odds'] = $odds[0][0];
							}
						} 
						else 
						{
							$arr['s_odds'] = $_POST['s_odds'];
							$arr['s_mingxi_1_str'] = null;
						}
						if ($error == null){
							$arr['g_typeid'] = isset($_POST['cid']) ? '重慶時時彩' : '幸运农场';
							$userReportInfo = new UserReportInfo($Users, 0);
							$ResultList = $userReportInfo->PostCrystls($arr);
							$ResultList = json_encode($ResultList);
						}
					}
				}
			}
		}
		echo <<<JSON
				{
					"error" : "$error",
					"ResultList" : $ResultList
				}
JSON;
	}
	else if ($typeID == 7)
	{
		$opNumber = $db->query("SELECT `g_qishu` FROM `g_history5` WHERE g_ball_1 is not null ORDER BY g_qishu DESC LIMIT 1 ", 0);
		echo $opNumber[0][0];
	}
	else if ($typeID == 8)
	{
		if ($Users[0]['g_login_id']!=89){
			if ($Users[0]['g_odds_lock'] !=1)exit;
		}
		$Ball = $_POST['tid'];
		$H = $_POST['hid'];
		$odds = $_POST['oid'];
		$sql = "UPDATE g_odds5 SET `{$H}` = '{$odds}' WHERE g_type = '{$Ball}' ";
		$db->query($sql, 2);
		echo 1;
	}
	else if ($typeID == 9)
	{
		initializeOddsnc();
	}
	else if ($typeID == 10)
	{
		$sUid = $_POST['sUid'];
		$lid = $_POST['lid'];
		if ($lid == 1){
			$from = "`g_rank`";
			$name = "`g_name`";
		} else if ($lid == 2){
			$from = "`g_user`";
			$name = "`g_name`";
		}else {
			$from = "`g_relation_user`";
			$name = "`g_s_name`";
		}
		if ($db->query("SELECT {$name} FROM {$from} WHERE {$name} = '{$sUid}' LIMIT 1 ", 0)){
			$db->query("UPDATE {$from} SET `g_out` ='0' WHERE {$name} ='{$sUid}' LIMIT 1 ", 2);
			echo 1;
		}
	}
	else if ($typeID == 'codeid')
	{
		$mid = $_POST['mid'];
		if ($mid == "1389" && $Users[0]['g_login_id'] == 89)
		{
			if (isset($Users[0]['g_lock_1_7'])){
				if ($Users[0]['g_lock_1_7'] !=1) exit;
			}
			$_SESSION['codeid'] = true;
			echo '1';
		}
	}
	else if ($typeID == 'gameCode')
	{
		$_SESSION['GameType'] = $_POST['id'];
		echo $_SESSION['GameType'];
	}
}
?>
