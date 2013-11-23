<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
if ($Users[0]['g_login_id'] != 89)
	if ($Users[0]['g_lock'] == 2)exit(back($UserOut)); //帳號已被凍結
	
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
}else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['actions']) && isset($_GET['cid']))
{
	//新增帳號
	if ($_GET['actions'] == 'add')
	{
		if (!Matchs::isString($_POST['s_Name'], 4, 9))exit(back('您輸入的帳號錯誤！'));
		if (!Matchs::isStringChi($_POST['s_F_Name'], 2, 8))exit(back('您輸入的名稱錯誤！'));
		if (!Matchs::isString($_POST['s_Pwd'], 8, 20))exit(back('您輸入的密碼錯誤！'));
		if ($_GET['cid']==1 && $LoginId==89) //新增公司帳號
		{
			$userList['id'] = 1;
			$userList['g_nid'] = $Users[0]['g_nid'].md5(uniqid(time(),true));;
			$userList['g_login_id'] = 56;
			$userList['g_name'] = $_POST['s_Name'];
			$userList['g_password'] = sha1($_POST['s_Pwd']);
			$userList['g_f_name'] = $_POST['s_F_Name'];
			$userList['g_money'] = $_POST['s_money'];
			$userList['g_distribution'] = $_POST['s_next_KY'];
			$userList['g_distribution_limit'] = $_POST['s_next_KY'];
			$userList['g_Immediate_lock'] = 1;
			$userList['g_lock'] = $_POST['lock'];
			$userList['g_ip'] = UserModel::GetIP();
			$userList['g_date'] = date("Y-m-d H:i:s");
			$userList['g_uid'] = md5(uniqid(time(),true));
			$userList['g_zcgs'] = $_POST['zcgs'];
			if ($userModel->ExistUnion($userList['g_name']))
			{
				alert_href('此用戶已存在', 'Actfor.php?cid='.$_GET['cid']);
				exit;
			}
			$userList = $userModel->AddUser($userList);
			alert_href('新增成功', 'Actfor.php?cid='.$_GET['cid']);
			exit;
		}
		else if ($_GET['cid']==2 && ($LoginId==89 || $LoginId==56)) //新增股東帳號
		{
			$g_nid = $userModel->GetUserModel(null, $_POST['s']);
			if (!$g_nid) exit(back('上級帳號不存在！'));
			if (!Matchs::isNumber($_POST['s_money']))exit(back('信用額錯誤！'));
			if (!Matchs::isNumber($_POST['s_next_KY']))exit(back('占成率錯誤！'));
			if ($_POST['s_next_KY'] > ($g_nid[0]['g_distribution']-1))exit(back('上级分公司最低需占1%'));
			if ($_POST['s_next_KY'] > $g_nid[0]['g_distribution'])exit(back('上级分公司最高占成率'.$g_nid[0]['g_distribution'].'%'));
			
			
			$nid = $g_nid[0]['g_nid'].UserModel::Like();
			$validMoney = $g_nid[0]['g_money'] - $userModel->SumMoney($nid);
			
			
			if ($_POST['s_money'] > $validMoney)exit(back('可用餘額：'.$validMoney));
			
			$userList['id'] = 2;
			$userList['L_name'] = $g_nid[0]['g_name'];
			$userList['g_nid'] = $g_nid[0]['g_nid'].md5(uniqid(time(),true));
			$userList['g_login_id'] = 22;
			$userList['g_distribution_limit'] = $g_nid[0]['g_distribution']-$_POST['s_next_KY'];	
			$userList['g_name'] = $_POST['s_Name'];
			$userList['g_password'] = sha1($_POST['s_Pwd']);
			$userList['g_f_name'] = $_POST['s_F_Name'];
			$userList['g_money'] = $_POST['s_money'];
			$userList['g_distribution'] = $_POST['s_next_KY'];
			$userList['g_Immediate_lock'] = $_POST['Immediate_lock']; //補倉是否開啟
			$userList['g_lock'] = $_POST['lock'];
			$userList['g_ip'] = UserModel::GetIP();
			$userList['g_date'] = date("Y-m-d H:i:s");
			$userList['g_uid'] = md5(uniqid(time(),true));
			$userList['g_zcgs'] = $g_nid[0]['g_zcgs'];
			if ($userModel->ExistUnion($userList['g_name']))
			{
				alert_href('此用戶已存在', 'Actfor.php?cid='.$_GET['cid']);
				exit;
			}
			$userList = $userModel->AddUser($userList);
			alert_href('新增成功', 'Actfor.php?cid='.$_GET['cid']);
			exit;
		}
		else if (($_GET['cid']==3 || $_GET['cid']==4) && ($LoginId==89 || $LoginId==56 || $LoginId==22 || $LoginId==78)) //新增總代理帳號
		{
			
			$g_nid = $userModel->GetUserModel(null, $_POST['s']);
			if (!$g_nid) exit(back('上級帳號不存在！'));
			if (!Matchs::isNumber($_POST['s_money'])) exit(back('信用額錯誤！'));
			if($_POST['zy']==1){
			$s_Size = (int)$_POST['s_size_ky']; //上級占成
			$s_next_ky = $g_nid[0]['g_distribution']-$s_Size; //下級占成
			}else{
			$s_Size = (int)$_POST['s_size_ky']; //上級占成
			$s_next_ky = $_POST['s_next_KY']; //下級占成
			}
			if (!Matchs::isNumber($s_next_ky) || !Matchs::isNumber($s_Size)) exit(back('占成錯誤！'));
			if ($s_Size+$s_next_ky > $g_nid[0]['g_distribution']) exit(back('上級最高占成率：'.$g_nid[0]['g_distribution'].'%'));
			
			/*
			 * 得到當前用戶可用額
			 * 計算還是錯誤，待修改
			 */
			$nid = $g_nid[0]['g_nid'].UserModel::Like();
			$validMoney = $g_nid[0]['g_money'] - $userModel->SumMoney($nid);
			
			
			if ($_POST['s_money'] > $validMoney)exit(back('可用餘額：'.$validMoney));
			$userList['g_login_id'] = $_GET['cid']==3 ? 78 : 48;
			$userList['id'] = 2;
			$userList['L_name'] = $g_nid[0]['g_name'];
			$userList['g_nid'] = $g_nid[0]['g_nid'].md5(uniqid(time(),true));
			$userList['g_name'] = $_POST['s_Name'];
			$userList['g_password'] = sha1($_POST['s_Pwd']);
			$userList['g_f_name'] = $_POST['s_F_Name'];
			$userList['g_money'] = $_POST['s_money'];
			$userList['g_distribution'] = $s_next_ky;
			$userList['g_distribution_limit'] = $s_Size; //上級成數
			$Immediate_lock = $_POST['Immediate_lock'];
			/*if ($userList['g_login_id'] == 48){
				$Immediate_lock.= $_POST['Immediate_lock_z'];
			}*/
			$userList['g_Immediate_lock'] = $Immediate_lock;
			$userList['g_lock'] = $_POST['lock'];
			$userList['g_ip'] = UserModel::GetIP();
			$userList['g_date'] = date("Y-m-d H:i:s");
			$userList['g_uid'] = md5(uniqid(time(),true));
			$userList['g_zcgs'] = $g_nid[0]['g_zcgs'];
			if ($userModel->ExistUnion($userList['g_name']))
			{
				alert_href('此帳號已被使用', 'Actfor.php?cid='.$_GET['cid']);
				exit;
			}
			$userList = $userModel->AddUser($userList);
			alert_href('新增成功', 'Actfor.php?cid='.$_GET['cid']);
			exit;
		}
		else 
		{
			exit(href('quit.php'));
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET['cid']) || !isset($_GET['aid'])) exit(href('quit.php'));
$aid = $_GET['aid'];
$cid = $_GET['cid']; //根據cid判斷當前用戶需要新增什麽級別的帳號

if ($aid == 'add') //新增面板顯示
{
	$select = null;
	$Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
	$input = '確認新增';
	$Title = $Users[0]['g_Lnid'][0];
	
	if ($cid != 1){
		$select = getSelect ($Rank, $userModel);
	} else {
		$nid = $Users[0]['g_nid'];
		//if($userModel->GetUserName_Like($nid)) alert_href('系統檢測到已有公司帳號！', 'Actfor.php?cid='.$_GET['cid']);
	}
}
else 
{
	exit(href('quit.php'));
}

function getSelect ($Rank, $userModel)
{
	$select = null;
	if($Rank[0]=="总公司")
	$Rank[0]="分公司";
	$option1 = '<tr><td class="bj">上級'.$Rank[0].'</td><td class="left_p5"><select name="s" id="s" onchange="FirstRankMoney()">';
	$option2 = '</select>&nbsp;&nbsp;<span id="FirstRankMoney"></span></td></tr>';
	$result = $userModel->GetUserName_Like($Rank[2]);
	if ($result == null){
		$select = '<option value="0">暫無帳號</option>';
	}
	else{
		for ($i=0; $i<count($result); $i++){$select .= '<option value="'.$result[$i]['g_name'].'">'.$result[$i]['g_name'].'</option>';}
	}
	return $option1.$select.$option2;
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
function ChkSName(p_name){
	var p = [];
	p.push({name:"op",value:"chksname"});
	p.push({name:"pname",value:p_name});
	$.post("/Manage/temp/Account_Edit.php", p, function (data){
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
<form method="post" action="?actions=<?php echo$aid?>&cid=<?php echo$cid?>" onsubmit="return isPost()" >
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
                                    <td width="99%">&nbsp;<?php echo$Title?></td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                        <?php if ($aid=='add'){?>
                        	<table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                            		<th colspan="6">新增<?php echo$Rank[1]=="总公司"? "分公司":$Rank[1];?></th>
                            	</tr>
                            	<?php if ($cid != 1) echo $select?>
                            	
                                <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[1]=="总公司"? "分公司":$Rank[1];?>帳號</td>
                                    <td class="left_p5"><input name="s_Name" id="s_Name" type="text" class="text" onblur="ChkSName(this.value);" />&nbsp;&nbsp; 
                                    	【<input name="lock" type="radio" value="1"checked="checked" />啟用&nbsp;
                                    	<input name="lock" type="radio" value="2" />凍結&nbsp;
                                        <input name="lock" type="radio" value="3" />停用&nbsp;】<span id="chksfresult" style=""></span>
                                    </td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[1]=="总公司"? "分公司":$Rank[1];?>名稱</td>
                                    <td class="left_p5"><input class="text" type="text" name="s_F_Name"  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">新密碼</td>
                                    <td class="left_p5"><input class="text" type="password" name="s_Pwd" id="s_Pwd"  maxlength="20" /></td>
                                </tr>
                                <?php if ($cid != 1){?>
                                <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input class="text" type="text" name="s_money" value="0"  maxlength="20" /></td>
                                </tr>
                                <?php if ($cid != 2){?>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[0]?>占成</td>
                                    <td class="left_p5"><input class="texta" type="text" name="s_size_ky" value="0"  maxlength="3" />%&nbsp; 
                                    <font id="Size_KY"></font></td>
                                </tr>
                                <?php }?> 
								<?php if ($cid == 2){?>
                                <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[1]?>占成</td>
                                    <td class="left_p5"> <input class="texta"  type="text" name="s_next_KY" value="0"  maxlength="3" />&nbsp;%
									
							         <font id="Size_KY"></font>
									
									 </td>
									   <?php } else {?>
									    <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[1]?>占成</td>
                                    <td class="left_p5"><input type="radio" value="1" checked="checked" name="zy" id="zy"/>&nbsp;占余成数下线任占&nbsp;&nbsp; <input type="radio" value="0" name="zy" id="zy" />&nbsp;限制下线可占成数&nbsp;<input class="texta"  type="text" name="s_next_KY" value="0"  maxlength="3" />&nbsp;%								
									 </td>
									   <?php }?>
                                </tr>
                                <?php if ($cid != 2 && $cid != 3){?>
                                <tr style="height:28px">
                                	<td class="bj">即時註單</td>
                                    <td class="left_p5">
                                    <input type="radio" value="1" name="Immediate_lock_z"  checked="checked" />啓用&nbsp;
                                    <input type="radio" name="Immediate_lock_z" value="2" />禁用</td>
                                </tr>
                                <?php }?>
                                <tr style="height:28px">
                                	<td class="bj">補貨功能</td>
                                    <td class="left_p5">
                                    <input type="radio" value="1" name="Immediate_lock"  checked="checked" />啓用&nbsp;
                                    <input type="radio" name="Immediate_lock" value="2" />禁用</td>
                                </tr>
                                 <?php }
								 if($cid==1){
								 ?>
								 <tr style="height:28px">
                                	<td class="bj">信用額度</td>
                                    <td class="left_p5"><input class="text" type="text" name="s_money" value="0"  maxlength="20" /></td>
                                </tr>
								  <tr style="height:28px">
                                	<td class="bj"><?php echo$Rank[1]=="总公司"? "分公司":$Rank[1];?>占成</td>
                                    <td class="left_p5"> <input class="texta"  type="text" name="s_next_KY" value="0"  maxlength="3" />&nbsp;%
							        </td>
                                </tr>
								<tr style="height:28px">
                                	<td class="bj">占余成数归</td>
                                    <td class="left_p5"><input type="radio" value="1" id="zcgs" name="zcgs" checked="checked" />总公司
									<input type="radio" value="0" id="zcgs" name="zcgs" />分公司
							        </td>
                                </tr>
								 <?php
								 }
								 ?>
                            </table>
                        <?php }?>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="<?php echo$input?>" /></td>
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