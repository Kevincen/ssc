<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $LoginId, $ConfigModel;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}

$userModel = new UserModel();
//zerc20120803
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['op']) && $_POST['op']=='chksname'){
	if ($userModel->ExistUnion($_POST['pname']))
	{
		echo '1';
	}else{
		echo '0';
	}
	exit;
}else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['sid']) && isset($_GET['cid']) && isset($_GET['actions']))
{
	if (!isset($_POST['s_Name']) || !Matchs::isString($_POST['s_Name'], 4,10)) exit(back('您輸入的帳號錯誤！'));
	if (!isset($_POST['s_F_Name']) || !Matchs::isStringChi($_POST['s_F_Name'])) exit(back('您輸入的名稱錯誤！'));
	if (!isset($_POST['s_Pwd']) || !Matchs::isString($_POST['s_Pwd'], 8, 20)) exit(back('請輸入密碼！'));
	if (!isset($_POST['s_money']) || !Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
	if (!isset($_POST['s_size_ky']) || !Matchs::isNumber($_POST['s_size_ky'])) exit(back('占成錯誤！'));
	//if (!isset($_POST['user_lock']) || !Matchs::isNumber($_POST['user_lock'])) exit(back('限額錯誤！'));
	//zerc20120805
	if (!isset($_POST['s']) || !Matchs::isString($_POST['s'])) exit(back('請選擇上級！'));
	$sid = $_GET['sid'];
	$s = $_POST['s'];
	$s_Name = $_POST['s_Name'];
	$s_F_Name = $_POST['s_F_Name'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_money = $_POST['s_money'];
	$s_Size_KY = $_POST['s_size_ky'];
	$s_pan = $_POST['s_pan'];
	$s_select = $_POST['select'];
	
	$p_result = $userModel->GetUserModel(null, $s);
	if ($sid == 2) 
	{
		if ($ConfigModel['g_son_member_lock'] != 1) 
			exit(back('權限不足，無法新增直屬會員！'));
		$s_Nid = $p_result[0]['g_nid'].md5(uniqid(time(),true));
		$Lid = $userModel->GetLoginIdByString($p_result[0]['g_login_id']);
		if ($p_result[0]['g_login_id'] == 22) {
			$loid = 78;
		} else if ($p_result[0]['g_login_id'] == 78) {
			$loid = 48;
		} else if ($p_result[0]['g_login_id'] == 56) {
			$loid = 22;
		} else {
			$loid = 9;
		}
	}
	else 
	{
		$loid = 9;
		$s_Nid = $p_result[0]['g_nid'];
	}
	if ($p_result[0]['g_login_id'] != 56 && ($sid == 2 || $sid == 1))
	{
		//得到當前用戶可用額
		if ($p_result[0]['g_login_id'] == 48)
		{
			$nid = $p_result[0]['g_nid'].'%';
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid, true);
		}
		else 
		{
			$nid = $p_result[0]['g_nid'].UserModel::Like();
			$validMoney = $p_result[0]['g_money'] - $userModel->SumMoney($nid);
		}
		if ($s_money > $validMoney)exit(back('上級可用餘額：'.$validMoney));
		if ($s_Size_KY > $p_result[0]['g_distribution'])exit(back('最高占成率：'.$p_result[0]['g_distribution']));
	}
	$userList = array();
	$userList['s_L_Name'] = $s;
	$userList['g_nid'] = $s_Nid;
	$userList['g_login_id'] = $loid;
	$userList['g_name'] = $s_Name;
	$userList['g_f_name'] = $s_F_Name;
	$userList['g_mumber_type'] = $sid;
	$userList['g_password'] = sha1($s_Pwd);
	$userList['g_money'] = $s_money;
	$userList['g_money_yes'] = $s_money;
	$userList['g_distribution'] = $s_Size_KY;
	$userList['g_tuishui'] = $s_select;
	//为会员分配盘口
	for($i=0;$i<count($s_pan);$i++){
	$s_panlus=$s_panlus.strtoupper($s_pan[$i]).',';
	}
	$s_panl=strtoupper($s_pan[0]);
	$userList['g_panlus'] = strtoupper($s_panlus);
	$userList['g_panlu'] = strtoupper($s_panl);
	
    //单号限额
	//$userList['g_xianer'] = $_POST['user_lock'];
    $userList['g_xianer'] = 1000000;
	$userList['g_out'] = 0;
	$userList['g_look'] = 1;
	$userList['g_ip'] = UserModel::GetIP();
	$userList['g_date'] = date("Y-m-d H:i:s");
	$userList['g_uid'] = md5(uniqid(time(),true));
	if ($userModel->ExistUnion($userList['g_name']))
	{
		alert_href('此用戶已存在', 'Actfor.php?cid='.$_GET['cid']);
		exit;
	}
	$userModel->AddMumberUser($userList);
    $cid = $_GET['cid'];
    update_MR($cid);
	alert_href('新增成功', 'Actfor.php?cid='.$_GET['cid']);
	exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sid']) && isset($_GET['cid']))
{
	$sid = $_GET['sid'];
	$cid = $_GET['cid'];
	if ($sid == 2){
		if ($ConfigModel['g_son_member_lock'] != 1) 
			exit(back('權限不足，無法新增直屬會員！'));
		$Munber = '新增直屬會員';
	} else {
		$Munber = '新增會員';
	}
	$Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
	if ($sid == 1) //新增普通會員
	{
		//查詢當前用戶的代理
		$select = getSelect ($Rank, $userModel);
	}
	else 
	{
		//查詢直屬關係
		$o1 = '<tr><td class="bj" id="bj">上級直屬</td><td class="left_p5" id="pc">';
		$o2 = '&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
		$Rank[0] = '上級';
		if ($Users[0]['g_login_id'] == 89 || $Users[0]['g_login_id'] ==56)
		{
		$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="0">分公司&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="1">股東&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		}
		else if($Users[0]['g_login_id'] == 22) {
			$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="1">股東&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		} else if ($Users[0]['g_login_id'] == 78) {
			$select =$o1.'<input type="radio" onclick="Gos(this);" name="tse" value="2">總代理';
		}

	}
}

function getSelect ($Rank, $userModel, $p=FALSE)
{
	$select = null;
	$option1 = '<tr><td class="bj" id="bj">上級'.$Rank[0].'</td><td class="left_p5"><select name="s" id="s" onchange="FirstRankMoney()">';
	$option2 = '</select>&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
	$result = $userModel->GetUserName_Like($Rank[2]);
	if ($result == null){
		$select = '<option value="0">暫無帳號</option>';
	}  else{
		for ($i=0; $i<count($result); $i++){$select .= '<option value="'.$result[$i]['g_name'].'">'.$result[$i]['g_name'].'</option>';}
	}
	return $option1.$select.$option2;
}

//插入项目退水等信息
function update_MR($cid)
{
    echo "enter update_MR";
    global $_POST;
    $uModel = new UserModel();
    $name = $_POST['s_Name'];
    //var_dump($_POST);

    if ($cid == 5) {
        $usersModel = $uModel->GetMemberModel($name);
    } else {
        $usersModel = $uModel->GetUserModel(null, $name);
    }
    if ($usersModel) {
        $Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid']) - 32);
        echo $Lname;
        $Lname = $uModel->GetUserName_Like($Lname); //返回查询出来的用户信息
        $db = new DB();
        if ($usersModel[0]['g_login_id'] == 56) { //如果被操作用户为分公司，则将类赋给$Lname，否则宣告权限不足
            $Lname = $usersModel;
        } else {
            if ($Lname[0]['g_lock'] != 1) {
                exit(back('更變權限不足！'));
            }
        }
        $sList = array(0 => 0, 1 => 0, 2 => 0);
        $LdetList = $db->query("SELECT `g_id`, `g_name`, `g_type`, `g_a_limit`, g_b_limit, g_c_limit,  `g_d_limit`, `g_e_limit`, `g_game_id`
		FROM `g_send_back` WHERE g_name = '{$Lname[0]['g_name']}' ORDER BY g_id DESC", 0); //获取退水表
        for ($i = 0; $i < count($LdetList); $i++) {
            if (!isset($_POST['a' . ($i)])) {
                continue;
            }
            $aList = 100 - $_POST['a' . ($i)]; //A盘退水
            $bList = 100 - $_POST['b' . ($i)]; //B盘退水
            $cList = 100 - $_POST['c' . ($i)]; //C盘退水
            $dList = $_POST['d' . ($i)]; //单注
            $eList = $_POST['e' . ($i)]; //单期

            if (!Matchs::isFloating($aList) || !Matchs::isFloating($bList) || !Matchs::isFloating($cList) || !Matchs::isFloating($dList) || !Matchs::isFloating($eList))
                exit(back('輸入的數值錯誤！' . $i));
            if ($usersModel[0]['g_login_id'] != 56) {
                if ($aList < $LdetList[$i][3] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][3] . '---' . (100)));
                if ($bList < $LdetList[$i][4] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][4] . '---' . (100)));
                if ($cList < $LdetList[$i][5] || $aList > 100) exit(back(' [ ' . $LdetList[$i][2] . '盤 ] 退水設置：' . $LdetList[$i][5] . '---' . (100)));
                if ($dList > $LdetList[$i][6] || $dList < 0) exit(back($LdetList[$i][2] . ' 最高單註限額設置為：' . $LdetList[$i][6] . '---' . (0)));
                if ($eList > $LdetList[$i][7] || $eList < 0) exit(back($LdetList[$i][2] . ' 最高單期限額設置為：' . $LdetList[$i][7] . '---' . (0)));
            }
            if ($aList > $LdetList[$i][3]) {
                //取A盘
                $LdetList[$i][3] = $aList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'a', $aList);
            }
            if ($bList > $LdetList[$i][4]) {
                //取B盘
                $LdetList[$i][4] = $bList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'b', $bList);
            }
            if ($cList > $LdetList[$i][5]) {
                //取C盘
                $LdetList[$i][5] = $cList;
                updateTuiShui($db, $LdetList[$i], $usersModel, 'c', $cList);
            }

            //修改退水
            $sql = "UPDATE `g_send_back` SET `g_a_limit` = '{$aList}', `g_b_limit` = '{$bList}', `g_c_limit` = '{$cList}', `g_d_limit` = '{$dList}', `g_e_limit` = '{$eList}'
			WHERE `g_name` = '{$usersModel[0]['g_name']}' AND g_type = '{$LdetList[$i][2]}' AND g_game_id = '{$LdetList[$i][8]}' LIMIT 1";
            $db->query($sql, 2);
        }
        //print_r($LdetList);
        //exit;
        //exit(alert_href('更變成功', 'Actfor.php?cid='.$_GET['cid']));
    } else {
        exit(alert_href('用戶不存在', 'Actfor.php?cid=' . $_GET['cid']));
    }
}
?>
