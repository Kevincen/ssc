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
	
	
	//$userList['g_xianer'] = $_POST['user_lock'];
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
    if ($cid == 5) {
        $usersModel = $uModel->GetMemberModel($name);
    } else {
        $usersModel = $uModel->GetUserModel(null, $name);
    }
    if ($usersModel) {
        $Lname = mb_substr($usersModel[0]['g_nid'], 0, mb_strlen($usersModel[0]['g_nid']) - 32);
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/common.js"></script>
<script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function Gos ($this){
		$.post("/Manage/temp/ajax/json.php", {typeid : "2", id : $this.value}, function (data){
			//alert(data);
			var pc = $("#pc");
			var p1 = '<select name="s" id="s" onchange="FirstRankMoney()">';
			var p2 = '</select>&nbsp;&nbsp;<span id="FirstRankMoney"></span>';
			var user = new Array();
			for (var i=0; i<data.user.length; i++){
				user.push('<option value="'+data.user[i]+'">'+data.user[i] + '</option>');
			}
			pc.html(p1 + user.join('') + p2);
			$("#bj").html("上級"+data.name);
			$("#zj").html(data.name+"佔成");
			FirstRankMoney($("#s"));
		}, "json");
	}
	function ChkSName(p_name){
		var p = [];
		p.push({name:"op",value:"chksname"});
		p.push({name:"pname",value:p_name});
		$.post("/Manage/temp/Account_Member.php", p, function (data){
			data = $.trim(data);
			if(data=="1"){
				$("#chksfresult").html("選擇帳號已存在");
				$("#chksfresult").css("color","#FF0000");
			}else{
				$("#chksfresult").html("選擇帳號可用！！！");
				$("#chksfresult").css("color","#444444");
			}
		});
	}
-->
</script>
</head>
<body>
<form method="post" action="?actions=add&cid=<?php echo$cid?>&sid=<?php echo$sid?>" onsubmit="return isPost()" >
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;<?php echo $Munber?></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                             <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                            		<th colspan="2"><?php echo $Munber?></th>
                            	</tr>
                            	<?php echo $select?>
                                <tr style="height:28px">
                                	<td class="bj">會員帳號</td>
                                	<td class="left_p5"><input name="s_Name" id="s_Name"  maxlength="20" type="text" class="text" onblur="ChkSName(this.value);" /><span id="chksfresult" style=""></span></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">會員名稱</td>
                                    <td class="left_p5"><input class="text" name="s_F_Name"  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">登陸密碼</td>
                                    <td class="left_p5"><input class="text" type="password" name="s_Pwd" id="s_Pwd"  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input class="text" name="s_money" id="s_money"  maxlength="7" value="0" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj" id="zj"><?php echo$Rank[0]?>占成</td>
                                    <td class="left_p5"><input class="texta" name="Size_KY"  maxlength="3" value="0" />%&nbsp; <font id="Size_KY"></font> </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">帳號限額</td>
                                    <td class="left_p5"><input class="texta" name="user_lock"  maxlength="9" value="1000000" />&nbsp;<span class="odds">限制會員帳號當天總下注額！</span></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">開放盤口</td>
									<script type="text/javascript"> 
										function check(spanl){
   											var flag=0;
   										for(var i=0;i<document.getElementsByName("s_pan[]").length;i++){
       										if(document.getElementsByName("s_pan[]")[i].checked==true){
       											flag++;
    										}
   										}
  											 if(flag==0){
   												alert("最少必须分配一个盘口");
   												spanl.checked='checked';
   													return false;
   											}
   												return true;
									}
									</script> 
                                    <td class="left_p5">
                                    <input type="radio" value="a" name="s_pan[]"  checked="checked" onclick="check(this)" />A盤&nbsp;
                                    <input type="radio" value="b" name="s_pan[]"  onclick="check(this)" />B盤&nbsp;
                                    <input type="radio" value="c" name="s_pan[]"  onclick="check(this)" />C盤&nbsp;
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">設定退水</td>
                                    <td class="left_p5">
                                    	<select name="select" id="s_TS">
											<option selected="selected" value="0">水全退到底</option>
											<option value="0.3">賺取0.3退水</option>
											<option value="0.5">賺取0.5退水</option>
											<option value="1">賺取1.0退水</option>
											<option value="2">賺取2.0退水</option>
											<option value="100">賺取所有退水</option>
										</select>
                                    </td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確定新增" /></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="6" bgcolor="#1873aa"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
            <td bgcolor="#1873aa"></td>
            <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
 </form>
</body>
</html>