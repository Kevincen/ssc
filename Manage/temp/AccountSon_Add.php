<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
$lock = false;
if ($LoginId == 89){
	$lock=true;
}

$lock_6 = false;
if (isset($Users[0]['g_lock_6'])){
	$lock_6 = true;
	if ($Users[0]['g_lock_6'] != 1)
		exit(back('您的權限不足！'));
}

//zerc20120803
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['op']) && $_POST['op']=='chksname'){
	if ($userModel->ExistUnion($_POST['pname']))
	{
		echo '1';
	}else{
		echo '0';
	}
	exit;
}else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$userModel = new UserModel();
	if ($userModel->ExistUnion($_POST['s_Name'])){
		exit(back($_POST['s_Name'].' 已被註冊！'));
	}
	$sonList = array();
	if (!Matchs::isString($_POST['s_Name'], 3, 20)) exit(back($_POST['s_Name'].' 輸入錯誤！'));
	if (!Matchs::isStringChi($_POST['s_f_Name'], 2, 20)) exit(back($_POST['s_f_Name'].' 輸入錯誤！'));
	$sonList['g_sh_id'] = $lock_6 ? $Users[0]['g_sh_id'] : md5(uniqid(time(), true));
	$sonList['g_s_nid'] = $Users[0]['g_nid'];
	$sonList['g_s_name'] = $_POST['s_Name'];
	$sonList['g_s_f_name'] = $_POST['s_f_Name'];
	$sonList['g_password'] = sha1($_POST['s_pwd']);
	$sonList['g_lock'] = $_POST['lock'];
	$sonList['g_s_login_id'] = $Users[0]['g_login_id'];
	$sonList['g_s_uid'] = md5(uniqid(time(),TRUE));
	$sonList['g_lock_1'] = empty($_POST['lock_1']) ? 0 : $_POST['lock_1'];
	$sonList['g_lock_2'] = empty($_POST['lock_2']) ? 0 : $_POST['lock_2'];
	$sonList['g_lock_3'] = empty($_POST['lock_3']) ? 0 : $_POST['lock_3'];
	$sonList['g_lock_4'] = empty($_POST['lock_4']) ? 0 : $_POST['lock_4'];
	$sonList['g_lock_5'] = empty($_POST['lock_5']) ? 0 : $_POST['lock_5'];
	$sonList['g_lock_6'] = empty($_POST['lock_6']) ? 0 : $_POST['lock_6'];
	$sonList['g_lock_1_1'] = empty($_POST['lock_1_1']) ? 0 : $_POST['lock_1_1'];
	$sonList['g_lock_1_2'] = empty($_POST['lock_1_2']) ? 0 : $_POST['lock_1_2'];
	$sonList['g_lock_1_3'] = empty($_POST['lock_1_3']) ? 0 : $_POST['lock_1_3'];
	$sonList['g_lock_1_4'] = empty($_POST['lock_1_4']) ? 0 : $_POST['lock_1_4'];
	$sonList['g_lock_1_5'] = empty($_POST['lock_1_5']) ? 0 : $_POST['lock_1_5'];
	$sonList['g_lock_1_6'] = empty($_POST['lock_1_6']) ? 0 : $_POST['lock_1_6'];
	$sonList['g_lock_1_7'] = empty($_POST['lock_1_7']) ? 0 : $_POST['lock_1_7'];
	$db=new DB();
	$db->query("INSERT INTO g_relation_user (`g_s_nid`, `g_s_name`, `g_s_f_name`, `g_password`, `g_lock`, `g_lock_1`, `g_lock_2`, `g_lock_3`, `g_lock_4`, `g_lock_5`, `g_lock_6`, `g_lock_1_1`, `g_lock_1_2`, `g_lock_1_3`, `g_lock_1_4`, `g_lock_1_5`, `g_lock_1_6`, `g_lock_1_7`, `g_s_date`,`g_s_uid`, `g_s_login_id`, `g_sh_id`) VALUES (
	'{$sonList['g_s_nid']}',
	'{$sonList['g_s_name']}',
	'{$sonList['g_s_f_name']}',
	'{$sonList['g_password']}',
	'{$sonList['g_lock']}',
	'{$sonList['g_lock_1']}',
	'{$sonList['g_lock_2']}',
	'{$sonList['g_lock_3']}',
	'{$sonList['g_lock_4']}',
	'{$sonList['g_lock_5']}',
	'{$sonList['g_lock_6']}',
	'{$sonList['g_lock_1_1']}',
	'{$sonList['g_lock_1_2']}',
	'{$sonList['g_lock_1_3']}',
	'{$sonList['g_lock_1_4']}',
	'{$sonList['g_lock_1_5']}',
	'{$sonList['g_lock_1_6']}',
	'{$sonList['g_lock_1_7']}',
	now(),
	'{$sonList['g_s_uid']}',
	'{$sonList['g_s_login_id']}',
	'{$sonList['g_sh_id']}' )", 2);
	exit(alert_href('寫入成功。', 'AccountSon_List.php'));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function setManages($this){
		var manages = $("#manages");
	 	if ($this.checked){
	 		manages.css("display", "");
	 	} else {
	 		manages.css("display", "none");
	 	}
	}

	function isForm(){
		var name = $("#s_Name");
		var pwd = $("#s_pwd");
		if (name.val() == ""){
			alert("請輸入帳號");
			return false;
		}
		if (name.val().length < 4 || name.val().length > 20){
			alert("帳號長度須4-20位");
			return false;
		}
		if (pwd.val() == ""){
			alert("請輸入密碼");
			return false;
		}
		if (pwd.val().length < 8 || pwd.val().length > 20){
			alert("密碼長度須8-20位");
			return false;
		}
		if(Pwd_Safety(pwd.val())!=true) {
			return false;
		}
		if (confirm("確定寫入子帳號嗎？")){
			return true;
		}
		return false;
	}
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
<form action="" method="post" onsubmit="return isForm()">
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
	                                    <td width="99%">&nbsp;新增子帳號</td>
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
                                	<th colspan="2">新增子帳號</th>
                                </tr>
                                <tr style="height:28px">
                                    <td class="bj">帳號:</td>
                                    <td class="left_p5"><input class="text" type="text" name="s_Name" id="s_Name"  maxlength="20" /><span id="chksfresult" style=""></span></td>
                                </tr>
                                <tr style="height:28px">
                                    <td class="bj">名稱:</td>
                                    <td class="left_p5"><input class="text" type="text" name="s_f_Name" id="s_f_Name"  maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                    <td class="bj">密碼:</td>
                                    <td class="left_p5"><input class="text" type="password" name="s_pwd" id="s_pwd" maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                    <td class="bj">狀態:</td>
                                    <td class="left_p5">
                                    	<input name="lock" style="position:relative;top:2px" checked="checked" type="radio" value="1" />啟用&nbsp;&nbsp;
                                    	<input name="lock" style="position:relative;top:2px" type="radio" value="2" />凍結&nbsp;&nbsp;
                                    	<input name="lock" style="position:relative;top:2px" type="radio" value="3" />停用
									</td>
                                </tr>
                                <tr style="height:28px">
                                    <td class="bj">功能:</td>
                                    <td class="left_p5">
                                    	<?php if($lock && !$lock_6){?>
                                內部管理 <input name="lock_1" onclick="setManages(this)" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }else if($lock_6 && $Users[0]['g_lock_1']==1){?>
                                		內部管理 <input name="lock_1" onclick="setManages(this)" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if(!$lock_6){?>
                                    	下線管理 <input name="lock_2" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_2']==1){?>
                                		下線管理 <input name="lock_2" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if($LoginId != 89 && $LoginId != 56 && !$lock_6){?>
                                    	自動補倉 <input name="lock_3" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($LoginId != 89 && $LoginId != 56 && $lock_6 && $Users[0]['g_lock_3']==1){?>
                                    	自動補倉 <input name="lock_3" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }?>
                                    	
                                    	<?php if(!$lock_6){?>
                                    	即時注單 <input name="lock_4" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_4']==1){?>
                                		即時注單 <input name="lock_4" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                    	
                                    	<?php if(!$lock_6){?>
                                    	報表查詢 <input name="lock_5" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_5']==1){?>
                                		報表查詢 <input name="lock_5" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                    	
                                    	<?php if(!$lock_6){?>
                                    	子帳管理 <input name="lock_6" style="position:relative;top:3px" type="checkbox" value="1" />
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_6']==1){?>
                                		子帳管理 <input name="lock_6" style="position:relative;top:3px" type="checkbox" value="1" />
                                		<?php }?>
                                    </td>
                                </tr>
                                <?php if($lock){?>
                                <tr style="height:28px;display:none" id="manages">
                                    <td class="bj">內部管理:</td>
                                    <td class="left_p5">
                                    	<?php if(!$lock_6){?>
                                    	系統設置 <input name="lock_1_1" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_1']==1){?>
                                		系統設置 <input name="lock_1_1" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if(!$lock_6){?>
                                    	賠率設置 <input name="lock_1_2" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_2']==1){?>
                                		賠率設置 <input name="lock_1_2" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                    	
                                    	<?php if(!$lock_6){?>
                                    	公告設置 <input name="lock_1_3" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_3']==1){?>
                                		公告設置 <input name="lock_1_3" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if(!$lock_6){?>
                                    	注單設置 <input name="lock_1_4" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_4']==1){?>
                                		注單設置 <input name="lock_1_4" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if(!$lock_6){?>
                                    	開獎設置 <input name="lock_1_5" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_5']==1){?>
                                		開獎設置 <input name="lock_1_5" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                		
                                		<?php if(!$lock_6){?>
                                    	開盤設置 <input name="lock_1_6" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_6']==1){?>
                                		開盤設置 <input name="lock_1_6" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                		<?php }?>
                                    	
                                    	<?php if(!$lock_6){?>
                                    	數據備份 <input name="lock_1_7" style="position:relative;top:3px" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<?php }else if ($lock_6 && $Users[0]['g_lock_1_7']==1){?>
                                		數據備份 <input name="lock_1_7" style="position:relative;top:3px" type="checkbox" value="1" />
                                		<?php }?>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center"><input type="submit" class="inputs" value="確認新增" /></td>
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