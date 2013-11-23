<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['s_pwd']))
{
	$s_pwd = sha1($_POST['s_pwd']);
	$new_pwd = $_POST['new_pwd'];
	if (!Matchs::isString($new_pwd, 8, 20)) exit(back('新密碼 請填寫 8 位或以上（最長20位）！'));
	$pwd = "`g_rank`";
	$new_pwd = sha1($new_pwd);
	$db=new DB();
	
	$g_name = "g_name";
	$sname = $Users[0]['g_name'];
	
	if ($db->query("SELECT {$g_name} FROM {$pwd} WHERE {$g_name} = '{$sname}' AND g_password = '{$s_pwd}' LIMIT 1", 0)){

		$sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}' , g_pwd=0 WHERE {$g_name} = '{$sname}' LIMIT 1";
		
		if ($db->query($sql, 2)){
			exit(alert_href('更變成功，請重新登錄。', 'quit.php'));
		} else {
			exit(back('更變失敗！'));
		}
	} else {
		exit(back('原始密碼錯誤！'));
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isPwd(){
		var s_pwd = $("#s_pwd").val();
		var new_pwd = $("#new_pwd").val();
		var f_pwd = $("#f_pwd").val();
		if (s_pwd == ""){
			alert("請輸入原始密碼");
		    return false;
		}
		if (s_pwd.length <8 || s_pwd.length >20){
			alert("原始密碼錯誤！");
		    return false;
		}
		if (new_pwd.length <8 || new_pwd.length >20){
			alert("新密碼 請填寫 8 位或以上（最長20位）！");
		    return false;
		}
		if (new_pwd != f_pwd){
			alert("確認密碼于新密碼不一致！");
		    return false;
		}
		if (new_pwd == s_pwd){
			alert("新密碼于原始密碼相同！");
		    return false;
		}
		if(Pwd_Safety(new_pwd)!=true) {
			return false;
		}
		return true;
	}
-->
</script>
</head>
<body>
<form method="post" action="" onsubmit="return isPwd()" >
<input type="hidden" name="sid" value="yes" />
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif"></td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">更變密碼</th>
                                </tr>
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">原始密碼</td>
                                    <td class="left_p5"><input type="password" id="s_pwd" name="s_pwd" class="text" /></td>
                                </tr>
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">新設密碼</td>
                                    <td class="left_p5"><input type="password" id="new_pwd" name="new_pwd" class="text" /></td>
                                </tr>
                                <tr style="height:30px" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td class="bj">確認密碼</td>
                                    <td class="left_p5"><input type="password" id="f_pwd" name="f_pwd" class="text" /></td>
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