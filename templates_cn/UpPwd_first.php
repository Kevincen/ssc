<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(back($UserOut));
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['VIP_PWD_old']))
{
	$aPwd = sha1($_POST['VIP_PWD_old']);
	$bPwd = sha1($_POST['VIP_PWD']);
	$cPwd = $_POST['VIP_PWD1'];
	$db = new DB();
	$sql = "SELECT `g_name` FROM `g_user` WHERE `g_password` = '{$aPwd}' LIMIT 1 ";
	if (!$db->query($sql, 0)) exit(alert_href("原密码输入错误!!!", "uppwd_first.php"));
	$sql = "UPDATE `g_user` SET `g_password` = '{$bPwd}' , g_pwd=0  WHERE `g_name` = '{$user[0]['g_name']}' ";
	if ($db->query($sql, 2))
	{
        //TODO:这里不应该退出，应该直接进入
		alert_href("密碼更變成功，請從新登陸!!!", "quit.php");
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src=".js/sc.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="./js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
function SubChk(){
    if(document.all.VIP_PWD_old.value.length == ""){
	    alert("請輸入原密碼！");
	    document.all.VIP_PWD_old.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value.length < 8 || document.all.VIP_PWD.value.length > 20){
	    alert("新密碼 請填寫 8 位或以上（最長20位）！");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value != document.all.VIP_PWD1.value){
	    alert("新密碼 和 新密碼確認 不一樣！(確認大小寫是否相同)");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(document.all.VIP_PWD.value == document.all.VIP_PWD_old.value){
	    alert("新密碼 不能使用 原密碼 請脩改");
	    document.all.VIP_PWD.focus();
	    return false;
    }
    if(Pwd_Safety(document.all.VIP_PWD.value)!=true) return false;
}
</script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<center>
<form action="" method="post" onsubmit="return SubChk()">
<input type="hidden" name="sid" value="yes" />
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="700">
        <tr>
            <td class="t_list_caption" colspan="2">變更密碼</td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="295">原密碼：</td>
            <td class="t_td_text" width="402" align="left"><input  style=" margin-left:3px;border:1px #0099CC solid; background:#F3F3F3; height:16px" type="password" name="VIP_PWD_old" /></td>
        </tr>
        <tr style="height:28px">
            <td style="text-align:right" class="t_td_caption_1" width="295">新密碼：</td>
            <td class="t_td_text" align="left"><input type="password" style=" margin-left:3px;border:1px #0099CC solid; background:#F3F3F3; height:16px" name="VIP_PWD" /></td>
        </tr>
        <tr style="height:28px">
            <td  style="text-align:right" class="t_td_caption_1" width="295">確認密碼：</td>
            <td class="t_td_text" align="left"><input type="password" style=" margin-left:3px;border:1px #0099CC solid; background:#F3F3F3; height:16px" name="VIP_PWD1" /></td>
        </tr>
        <tr>
        	<td colspan="2" align="center" class="textcc"><input type="submit" class="inputs" value="確認修改" /></td>
        </tr>
</table>
</form>
</center>
</body>
</html>