<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users, $ConfigModel, $BakPassWord;
$db=new DB();
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_7'])){
	if ($Users[0]['g_lock_1_7'] !=1) 
		exit(back('您的權限不足！'));
}
$id=$_REQUEST['id'];
if($_REQUEST['act']=="true"){
	if($id==""){
		$sql="INSERT INTO g_paycard set BankName='".$_REQUEST['BankName']."',BankUser='".$_REQUEST['BankUser']."',Account='".$_REQUEST['Account']."',AccountAddr='".$_REQUEST['AccountAddr']."',PayUrl='".$_REQUEST['PayUrl']."'";
	}else{
		$sql="UPDATE g_paycard set BankName='".$_REQUEST['BankName']."',BankUser='".$_REQUEST['BankUser']."',Account='".$_REQUEST['Account']."',AccountAddr='".$_REQUEST['AccountAddr']."',PayUrl='".$_REQUEST['PayUrl']."' where id=$id";
	}
	$db->query($sql,0);
	header("Location:paycard.php");
	exit;
}
if($id!=""){
	$result = $db->query("select * from g_paycard where id=".$_REQUEST['id'], 1);
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/common.js"></script>
<script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
<script type="text/javascript" src="/Manage/temp/js/ToRMB.js"></script>
<script language="javascript">
function doCheck(){
	if($('input[name=BankName]').val()==''){
		$('input[name=BankName]').css('border','solid 1px #ff6600');
		return false;
	}else if($('input[name=BankUser]').val()==''){
		$('input[name=BankUser]').css('border','solid 1px #ff6600');
		return false;
	}else if($('input[name=Account]').val()==''){
		$('input[name=Account]').css('border','solid 1px #ff6600');
		return false;
	}else if($('input[name=AccountAddr]').val()==''){
		$('input[name=AccountAddr]').css('border','solid 1px #ff6600');
		return false;
	}else if($('input[name=PayUrl]').val()==''){
		$('input[name=PayUrl]').css('border','solid 1px #ff6600');
		return false;
	}
	return true;
}
</script>
<title></title> 
</head>
<body>
<form method="post" action="?act=true"  onsubmit="return doCheck()" >
 	<input type="hidden" name="id" value="<?=$id?>" />
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
                                    <td width="99%">&nbsp;<?=$_REQUEST['id']=='' ? "添加银行卡" : '更改银行卡'?></td>
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
                            		<th colspan="2">银行卡信息</th>
                            	</tr>
                            	 
                                <tr>
                                	<td class="bj">银行名称</td>
                                	<td class="left_p5">  <input name="BankName" type="text" value="<?=$result[0]['BankName']?>"  class="text"/>
                                	</td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">姓名</td>
                                    <td class="left_p5"><input class="text" name="BankUser" value="<?=$result[0]['BankUser']?>"  maxlength="20" /></td>
                                </tr>
                                <tr>
                                	<td class="bj">账户</td>
                                    <td class="left_p5"><input class="text" type="text" name="Account" id="Account" value="<?=$result[0]['Account']?>" maxlength="20" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">开户地址</td>
                                    <td class="left_p5"><input class="text" type="text" name="AccountAddr" id="AccountAddr" value="<?=$result[0]['AccountAddr']?>" maxlength="100" /></td>
                                </tr>
                                <tr style="height:28px">
                                	<td class="bj">支付网址</td>
                                    <td class="left_p5"><input class="text"  style="width:250px;" name="PayUrl"  value="<?=$result[0]['PayUrl']?>"  maxlength="150"    /></td>
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