<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89) if ($Users[0]['g_lock'] == 2)
exit(back($UserOut)); //帳號已被凍結

//子帳號
if (isset($Users[0]['g_lock_2'])){
	if ( $Users[0]['g_s_lock'] == 2 || $Users[0]['g_lock_2'] != 1)
		exit(back($UserOut)); //帳號已被凍結
}

$userModel = new UserModel();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cid']))
{
	$cid = $_GET['cid'];
	$name = $_POST['name'];
	$s_F_Name = $_POST['s_F_Name'];
	$s_Pwd = $_POST['s_Pwd'];
	$s_money = $_POST['s_money'];
	$Size_ky = isset($_POST['Size_KY']) ? $_POST['Size_KY'] : null;
	$user_lock = $_POST['user_lock'];
	$lock = $_POST['lock'];
	$s_pan = isset($_POST['s_pan']) ? $_POST['s_pan'] : null;
	
	
	//为会员分配盘口
	for($i=0;$i<count($s_pan);$i++){
	$s_panlus=$s_panlus.strtoupper($s_pan[$i]).',';
	}
	$s_panl=strtoupper($s_pan[0]);



	if (!Matchs::isString($name, 3, 10)) exit(back('帳號錯誤！'));
	$memberModel = $userModel->GetMemberModel($name);
	//查詢當前會員注單。如果有則關閉盤口更變
	$detModel = new Detailed();
	$detList = $detModel->GetDetailedsAll($memberModel[0]['g_name']);
	if ($memberModel)
	{
		//if (!Matchs::isStringChi($s_F_Name, 2, 8)) exit(back('名稱輸入錯誤！'));
		if ($s_Pwd != null){
			if (!Matchs::isString($s_Pwd, 8, 20)) exit(back('密碼輸入錯誤！'));
			$s_Pwd = sha1($s_Pwd);
			$g_pwd=' ,g_pwd=1 ';
		}else {
			$s_Pwd = $memberModel[0]['g_password'];
			$g_pwd=' ,g_pwd=g_pwd ';
		}
		if (!Matchs::isNumber($s_money)) exit(back('信用額輸入錯誤！'));
		if ($Size_ky != null)
			if (!Matchs::isNumber($Size_ky)) exit(back('占成輸入錯誤！'));
		if (!Matchs::isNumber($user_lock)) exit(back('帳號限額輸入錯誤！'));
		
		//信用額計算
		$_s_money = $memberModel[0]['g_money'];
		$g_money_yes = $memberModel[0]['g_money_yes'];
		if ($memberModel[0]['g_mumber_type'] == 2){
			$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
		}else {
			$nid = $memberModel[0]['g_nid'];
		}
		$Luser = $userModel->GetUserName_Like($nid);
		$Lnid = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
		if ($s_money != $_s_money){
			if ($s_money > $_s_money){
				//輸入的金額大於原來的、應當判斷上級的可用額是否充足、
				if ($Luser[0]['g_login_id']==48){
					$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'], true);
				} else {
					$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'].UserModel::Like(), false);
				}
				//判斷
				$n = $s_money - $_s_money;
				if ($n > $validMoney){
					exit(back($Lnid[0].' 剩餘可用餘額：'.$validMoney));
				} else {
					$g_money_yes += $n;
				}
			}else if ($detList == true) {
				$n = $_s_money - $s_money ;
				if ($n > $g_money_yes){
					exit(back('當前會員已進行下注，没有足够的回收额。'));
				}else{
					$g_money_yes -= $n;
				}
			} else {
				$g_money_yes = $s_money;
			}
			/*
			else if ($detList == true) {
					$g_money_yes = 0;
					exit(back('當前會員已進行下注，没有足够的限额。'));
				exit(back(' 當前會員已進行下注，無法回收餘額！'));
			} 
			*/
		}
		//非空，上級占成計算
		if ($Size_ky == null){
			$Size_ky = $memberModel[0]['g_distribution'];
		} else {
			if ($Size_ky != $memberModel[0]['g_distribution']){
				if ($Size_ky > $Luser[0]['g_distribution']){
					exit(back($Lnid[0].' 最高占成：'.$Luser[0]['g_distribution'].'%'));
				}
			}
		}
		if (!$s_pan){
			$s_pan = strtoupper($memberModel[0]['g_panlu']);
		}
		if ($Luser[0]['g_lock'] != 1) {
				exit(back('更變權限不足！'));
		}
		$iscash = $_REQUEST['iscash'];
		$db =new DB();
		$sql = "UPDATE `g_user` SET 
		`g_f_name`='{$s_F_Name}',
		`g_password`='{$s_Pwd}',
		`g_money`='{$s_money}',
		`g_money_yes`='{$g_money_yes}',
		`g_distribution`='{$Size_ky}',
		`g_panlus`='{$s_panlus}',
		`iscash`='{$iscash}',
		`g_panlu`='{$s_panl}',
		`g_xianer`='{$user_lock}',
		`g_look`='{$lock}' ".$g_pwd." 
		WHERE g_name = '{$name}' LIMIT 1";
		$db->query($sql, 2);
		
		if ($memberModel[0]['g_xianer'] != $user_lock){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_xianer'];
			$valueList['g_up_value'] = $user_lock;
			$valueList['g_up_type'] = '帳號限額';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($memberModel[0]['g_panlus'] != $s_panlus){
			$valueList = array();
			//$a = strtolower($s_panl);	
			$sql = "SELECT `g_type`";
			$P=$s_panlus;
			if(strstr($P,'A')!=''){$sql.=',g_a_limit ';}
			if(strstr($P,'B')!=''){$sql.=',g_b_limit ';}
			if(strstr($P,'C')!=''){$sql.=',g_c_limit ';}
			//$p = "g_{$a}_limit";
			$sql.=", `g_game_id` FROM g_send_back WHERE g_name = '{$Luser[0]['g_name']}' ";

			$sresult = $db->query($sql, 1);
			for ($i=0; $i<count($sresult); $i++){
			$sql = "UPDATE `g_panbiao` SET g_id=g_id ";
			if(strstr($P,'A')!=''){$sql.=",g_panlu_a='{$sresult[$i]['g_a_limit']}' ";}
			if(strstr($P,'B')!=''){$sql.=",g_panlu_b='{$sresult[$i]['g_b_limit']}' ";}
			if(strstr($P,'C')!=''){$sql.=",g_panlu_c='{$sresult[$i]['g_c_limit']}' ";}
				$sql.= " WHERE g_nid = '{$memberModel[0]['g_name']}' 
				AND g_type = '{$sresult[$i]['g_type']}' AND g_game_id = '{$sresult[$i]['g_game_id']}'";
				$db->query($sql, 2);
			}
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_panlu'].'盤';
			$valueList['g_up_value'] = $s_pan.'盤';
			$valueList['g_up_type'] = '開放盤口';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($memberModel[0]['g_f_name'] != $s_F_Name){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_f_name'];
			$valueList['g_up_value'] = $s_F_Name;
			$valueList['g_up_type'] = '名稱';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($s_money != $memberModel[0]['g_money']){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_money'];
			$valueList['g_up_value'] = $s_money;
			$valueList['g_up_type'] = '信用額';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		if ($Size_ky != $memberModel[0]['g_distribution']){
			$valueList = array();
			$valueList['g_name'] = $memberModel[0]['g_name'];
			$valueList['g_f_name'] = $_SESSION['sName'];
			$valueList['g_initial_value'] = $memberModel[0]['g_distribution'].'%';
			$valueList['g_up_value'] = $Size_ky.'%';
			$valueList['g_up_type'] = '上級占成';
			$valueList['g_s_id'] = 1;
			insertLogValue($valueList);
		}
		
		
		exit(alert_href('更改成功', 'Actfor.php?cid='.$cid));
	}
	exit;
}
else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cid']) && isset($_GET['uid']))
{
	$uid = $_GET['uid'];
	$cid = $_GET['cid'];
	$memberModel = $userModel->GetMemberModel($uid);
	//查詢當前會員注單。如果有則關閉盤口更變
	$detModel = new Detailed();
	$detList = $detModel->GetDetailedsAll($memberModel[0]['g_name']);

	//查詢當前會員上級
	if ($memberModel[0]['g_mumber_type'] == 2){
		$nid = mb_substr($memberModel[0]['g_nid'], 0, mb_strlen($memberModel[0]['g_nid'])-32);
	}else {
		$nid = $memberModel[0]['g_nid'];
	}
	$Luser = $userModel->GetUserName_Like($nid);
	$Lnid = $userModel->GetLoginIdByString($Luser[0]['g_login_id']);
	
	//當可用額大於信用額時，顯示信用額。
	//小於信用額時，顯示可用額
	$validMoneys = $memberModel[0]['g_money_yes'];
	//計算上級代理可用金額
	if ($Luser[0]['g_login_id']==48){
		$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'], true);
	} else {
		$validMoney = validMoney ($userModel, $Luser[0]['g_money'], $Luser[0]['g_nid'].UserModel::Like(), false);
	}
}
function validMoney ($userModel, $countMoney, $nid, $param) {
	$validMoney = $countMoney - $userModel->SumMoney($nid,$param);
	return $validMoney;
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
</head>
<body>
<form method="post" action="?cid=<?php echo$cid?>" onsubmit="return isPostcid()" >
  <input type="hidden" name="name" value="<?php echo$memberModel[0]['g_name']?>" />
  <table width="100%" height="100%" border="0" cellspacing="0" class="a">
    <tr>
      <td width="6" height="99%" bgcolor="#1873aa"></td>
      <td class="c"><table border="0" cellspacing="0" class="main">
          <tr>
            <td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
            <td background="/Manage/temp/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                  <td width="99%">&nbsp;更改會員</td>
                </tr>
              </table></td>
            <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
          </tr>
          <tr>
            <td class="t"></td>
            <td class="c"><!-- strat -->
              <table border="0" cellspacing="0" class="conter">
                <tr class="tr_top">
                  <th colspan="2">會員信息</th>
                </tr>
                <tr style="height:28px">
                  <td class="bj">上級<?php echo$Lnid[0]?></td>
                  <td class="left_p5"><?php echo $Luser[0]['g_name']?>&nbsp;&nbsp;&nbsp;餘額&nbsp;<?php echo$validMoney?></td>
                </tr>
                <tr>
                  <td class="bj">會員帳號</td>
                  <td class="left_p5"><?php echo $memberModel[0]['g_name']?> 【
                    <input name="lock" type="radio" value="1" <?php if($memberModel[0]['g_look']==1){echo 'checked="checked"';}?> />
                    啟用&nbsp;
                    <input name="lock" type="radio" value="2" <?php if($memberModel[0]['g_look']==2){echo 'checked="checked"';}?> />
                    凍結&nbsp;
                    <input name="lock" type="radio" value="3" <?php if($memberModel[0]['g_look']==3){echo 'checked="checked"';}?> />
                    停用&nbsp;】 </td>
                </tr>
                <tr style="height:28px">
                  <td class="bj">會員名稱</td>
                  <td class="left_p5"><input class="text" name="s_F_Name" value="<?php echo $memberModel[0]['g_f_name']?>"  maxlength="20" /></td>
                </tr>
				<tr style="height:28px">
                  <td class="bj">玩法类型</td>
                  <td class="left_p5"><input type="radio"  name="iscash" value="1" <?=$memberModel[0]['iscash']=='1' ? 'checked' : ''?> />现金&nbsp;<input type="radio"  name="iscash" value="0" <?=$memberModel[0]['iscash']!='1' ? 'checked' : ''?> />额度</td>
                </tr>
                <tr>
                  <td class="bj">登陸密碼</td>
                  <td class="left_p5"><input class="text" type="password" name="s_Pwd" id="s_Pwd"  maxlength="20" /></td>
                </tr>
                <tr style="height:28px">
                  <td class="bj">信用額度</td>
                  <td class="left_p5"><input class="textb" name="s_money" id="s_money" value="<?php echo $memberModel[0]['g_money']?>"  maxlength="7" value="0" />
                    『<span class="red">&nbsp;餘額&nbsp;<span id='money_ky'><?php echo $validMoneys;?></span>&nbsp;</span><span class="red;font-family:宋体;">&nbsp;可‘回收’餘額&nbsp;<?php if($memberModel[0]['g_money']>$validMoneys){ echo $validMoneys;}else{ echo $memberModel[0]['g_money']; } ?></span>』 </td>
                </tr>
                <tr style="height:28px">
                  <td class="bj"><?php echo$Lnid[0]?>占成</td>
                  <td class="left_p5"><?php if (!$detList){?>
                    <input class="texta" name="Size_KY"  maxlength="3" value="<?php echo $memberModel[0]['g_distribution']?>" />
                    %
                    <?php }else {?>
                    <span><?php echo $memberModel[0]['g_distribution']?> %</span>
                    <?php }?>
                  </td>
                </tr>
                <tr style="height:28px">
                  <td class="bj">帳號限額</td>
                  <td class="left_p5"><input class="texta" name="user_lock"  maxlength="9" value="<?php echo $memberModel[0]['g_xianer']?>" />
                    &nbsp;<span class="odds">限制會員帳號當天總下注額！</span> </td>
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
                  <td class="left_p5"><?php if (!$detList){?>
                    <?php $P = $memberModel[0]['g_panlus'];?>
                    <input type="radio" value="a" name="s_pan[]"  <?php if(strstr($P,'A')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    A盤&nbsp;
                    <input type="radio" value="b" name="s_pan[]" <?php if(strstr($P,'B')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    B盤&nbsp;
                    <input type="radio" value="c" name="s_pan[]" <?php if(strstr($P,'C')!=''){echo 'checked="checked"';}?> onclick="check(this)" />
                    C盤&nbsp;
                    <?php }else {?>
                    <?php $P = $memberModel[0]['g_panlus'];?>
                    <?php if(strstr($P,'A')!=''){echo '<input type="hidden" value="a" name="s_pan[]" checked="checked"  />A盤&nbsp;';}?>
                    <?php if(strstr($P,'B')!=''){echo '<input type="hidden" value="b" name="s_pan[]" checked="checked"  />B盤&nbsp;';}?>
                    <?php if(strstr($P,'C')!=''){echo '<input type="hidden" value="c" name="s_pan[]" checked="checked" />C盤&nbsp;';}?>
                    <?php }?>
                  </td>
                </tr>
              </table>
              <!-- end -->
            </td>
            <td class="r"></td>
          </tr>
          <tr>
            <td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
            <td class="f" align="center"><input type="submit" class="inputs" value="確定更變" /></td>
            <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
          </tr>
        </table></td>
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
