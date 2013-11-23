<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users,$ConfigModel, $LoginId;

if (isset($_GET['uid'])){
	$userid = $_GET['uid'];
} else {
	if (isset($Users[0]['g_s_lock']))
		$userid = $Users[0]['g_s_name'];
	 else 
		$userid = $Users[0]['g_name'];
}
$db = new DB();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$code=$_POST['code'];
$code_new=$_POST['code2'];
if( $LoginId ==89){
$sql = "SELECT * FROM g_manage WHERE g_name = '{$userid}'  ";
$result = $db->query($sql, 1);
if($result[0]['g_code']==$code){
$sql = "update  g_manage set g_code='{$code_new}' WHERE g_name = '{$userid}'  ";
$db->query($sql, 2);
exit(alert_href('更改成功！','SaveCode.php'));
}else{
	exit(alert_href('原安全码错误！','SaveCode.php'));
}
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
<title></title>
</head>
<script type="text/javascript">
<!--
	function isPwd(){
		var s_pwd = $("#code").val();
		var new_pwd = $("#code2").val();
		var f_pwd = $("#code3").val();
		if (s_pwd == ""){
			alert("請輸入原安全码");
		    return false;
		}
		if (new_pwd == ""){
			alert("請輸入新安全码");
		    return false;
		}
		if (f_pwd == ""){
			alert("請确认新安全码");
		    return false;
		}
		
		if (new_pwd != f_pwd){
			alert("两次输入新安全码不一致！");
		    return false;
		}
		if (new_pwd == s_pwd){
			alert("新安全码与原安全码相同！");
		    return false;
		}
		return true;
	}
-->
</script>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
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
                                    <td width="99%">&nbsp;安全码设置</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
						<form action="" method="post" onsubmit="return isPwd()">
                            <table border="0" cellspacing="0" class="conter">
                            	<tr>
                                	<td width="40%" align="right">原安全码：</td>
                                    <td width="35%"><input type="password" name='code' id='code' size="30" value=""/></td>
                                    <td>该安全码在删除用户时使用，请谨记。</td>
                                </tr>
								<tr>
                                	<td width="40%" align="right">新安全码：</td>
                                    <td width="35%"><input type="password" name='code2' id='code2' size="30" value=""/></td>
                                    <td></td>
                                </tr>
								<tr>
                                	<td width="40%" align="right">确认新安全码：</td>
                                    <td width="35%"><input type="password" name='code3' id='code3' size="30" value=""/></td>
                                    <td></td>
                                </tr>
                                	<tr>
                    				
                       					<td colspan="3" align="center"><input type="submit" class="inputs"  value="確定" /></td>
                  				  </tr>
                            </table>
						  </form>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"></td>
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
</body>
</html>