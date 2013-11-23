<?php
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') || Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
include_once ROOT_PATH.'Manage/config/config.php';


if ($_SERVER["REQUEST_METHOD"] == 'POST')
{
	//重置提示语言
	if($_POST['version'] == 'cn')
	{
		$Title = $Title_cn;
		$CodeError = $CodeError_cn;
		$UserError =  $UserError_cn;
		$UserLook = $UserLook_cn;
		$UserOut = $UserOut_cn;
		
		//简繁转换
		if($ConfigModel['g_web_lock'] != 1)
		{
			$lang = new utf8_lang;
			$ConfigModel['g_web_text'] = $lang->hk_cn($ConfigModel['g_web_text']);
		}
	}	
	
	
	//驗證碼匹配
	if ($_POST['ValidateCode'] == $_SESSION['code'])
	{
		if($ConfigModel['g_web_lock'] != 1)
		{
			exit(back($ConfigModel['g_web_text']));
		}
		
		//瀏覽器檢測、只支持IE核心
		if (!GetMsie())
		{
			exit(back($UserError));
		}
		
		//驗證用戶和密碼是否存在
		$loginName = $_POST['loginName'];
		$loginPwd = sha1($_POST['loginPwd']);
		$db = new DB();
		$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' LIMIT 1 ";
		 
		$result = $db->query($sql, 1);
		if ($result)
		{
			//判斷帳號是否已被停用
			if ($result[0]['g_look'] == 3) exit(back($UserLook));
			$uniqid = md5(uniqid());
			$loginIp = GetIP();
			$loginDate = date("Y-m-d H:i:s");
			$sql = "UPDATE `g_user` SET `g_uid` = '{$uniqid}', `g_ip` = '{$loginIp}', `g_date` = '{$loginDate}', `g_out` =1, `g_count_time`=now(),`g_state` =1 WHERE `g_name` = '{$loginName}' AND `g_password` = '{$loginPwd}' ";
			$db->query($sql, 2);
			$qqWryInfo = ROOT_PATH.'tools/IpLocationApi/QQWry.Dat';
			$ip_s = ipLocation($loginIp, $qqWryInfo);
			$sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
			$db->query($sql, 2);
			$_SESSION['g_S_name'] = $result[0]['g_name'];
			
			//设置风格
			if(!empty($result[0]['g_skin'])  && in_array($result[0]['g_skin'],array('skin_brown','skin_red','skin_blue')))
			{
				$g_skin = $result[0]['g_skin'];
			}
			else
			{
				$g_skin = 'skin_brown';
			}
			
			setcookie("g_skin", $g_skin, 0, "/");
			
			setcookie("g_user", base64_encode($loginName), 0, "/");
			setcookie("g_uid", base64_encode($uniqid), 0, "/");
			
            if ($_POST['version'] == 'hk')
			{
               include_once ROOT_PATH.'validate.php';
            } 
			else 
			{
                include_once ROOT_PATH.'validate_cn.php';
            }
			exit;
		}
		else 
		{
			back($UserError);
			exit;
		}
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
	$_SESSION['code'] = $num;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>合顺</title>
<style type="text/css">
body, div, form, input, img, p {
margin: 0;
padding: 0;
}
body {
font: 14px/1.231 Verdana, Arial, Helvetica, sans-serif;
color: #333333
}
a {
color: #DD2405;
text-decoration: underline
}
.pager {
width: 1003px;
height: 600px;
margin: 0 auto;
position: relative
}
.bg {
font-size: 0;
line-height: 0;
position: absolute;
top: 0
}
.bg img {
width: 1003px;
border: 0;
}
.lo {
position: absolute;
top: 198px;
left: 320px;
}
.login {
z-index: 2;
height: 190px;
width: 290px;
background: #FFF9D7;
border: 5px solid #E9AC08;
padding: 0 22px;
margin: 10px
}
.opacity {
background: white;
filter: alpha(opacity=50);
z-index: 1;
opacity: 0.5;
width: 364px;
height: 218px;
}
table {
width: 100%;
border-collapse: collapse;
border-spacing: 0;
vertical-align: middle;
margin-top: 8px;
}
caption {
height: 39px;
font-size: 16px;
color: #C40C00;
font-weight: bold;
}
caption p {
position: relative;
bottom: 2px;
border-top: 1px solid #FFC84E;
font-size: 0;
line-height: 0;
height: 0
}
caption span {
padding: 0 10px;
position: relative;
z-index: 2;
background: #FFF9D7;
top: 10px
}
th, td {
padding: 7px 0
}
th {
width: 21%;
text-align: right;
padding-left: 4px
}
input {
height: 20px;
line-height: 20px;
border: 1px solid #9B9B9B;
width: 151px
}
.sbt {
width: 58px;
height: 55px;
border: 1px solid #DD6005;
background: #FFAA6C;
padding: 1px
}
.sbt input {
width: 58px;
height: 55px;
color: white;
background: #FF740F;
font-size: 18px;
font-weight: bold;
border: 0;
cursor: pointer
}
.vcode input {
width: 80px
}
.vcode img {
vertical-align: top;
height: 22px
}
.vbanben{font-size:13px;line-height:20px;}
.vbanben input,.vbanben label{float:left;}
#shenjiban{width:15px;border:none}
#chuantongban{width:15px;border:none}
#code{
width:66px;
height:22px;
line-height:22px;
text-align:center;
float:left;
overflow:hidden;
display:inline;
margin-left:5px;
letter-spacing:3px;
background:url(pagef/vcode.png) no-repeat;
color:#0a5743;
font-family:Verdana;}
</style>
<SCRIPT type="text/javascript" src="/js/jquery.js"></SCRIPT>
</head>
<body>
<div class="pager">
    <div class="bg" id='bg'>
        <img src="pagef/login_bg.jpg" />
    </div>
    <form  class="lo login" method="post" name="myform" onSubmit="return CheckForm()">
        <table>
            <caption>
                <span>会员登录</span>
                <p></p>
            </caption>
            <tr>
                <th>账&nbsp;&nbsp;&nbsp;号：</th>
                <td>
                <input type="text" maxlength="12" name="loginName" valid="loginName" value="" tabIndex="1" />
                </td>
                <td rowspan="2">
                <div class="sbt">
                    <input type="submit" value="登录" name="submit"  tabIndex="4"/>
                </div></td>
            </tr>
            <tr>
                <th>密&nbsp;&nbsp;&nbsp;码：</th>
                <td>
                <input type="password" maxlength="16" name="loginPwd" valid="loginPwd" value="" tabIndex="2"/>
                </td>
            </tr>
            <tr class="vcode">
                <th>验证码：</th>
                <td >
                <input type="text" autocomplete="off" maxlength="12" name="ValidateCode" value="" tabIndex="3" style="float:left;" />
                &nbsp;<span id="code"><?php echo $_SESSION['code']?></span>
                </td>
                <td><a href="javascript:void(0)">看不清？</a></td>
            </tr>
            <tr class="vbanben">
                <th></th>
                <td>
                <input type="radio" checked="checked" id="shenjiban" name="version" value="cn">
                <label for="shenjiban" class="label">新版&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="radio" id="chuantongban" name="version" value="hk">
                <label for="chuantongban" class="label">旧版</label>
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <div class="lo opacity"></div>
    <script language = "JavaScript"> 
	function CheckForm()
	{
		var name = document.myform.loginName.value;
		var password = document.myform.loginPwd.value;
		var vcode = document.myform.ValidateCode.value;
		if (!(/^[a-z0-9A-Z][a-z0-9A-Z_]{0,11}$/.test(name))) {
			alert('账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线');
			document.myform.loginName.focus();
			return false;
		}
		if (!(/^[0-9a-zA-Z]{5,16}$/.test(password))) {
			alert('密码由6-16位英文字母、数字字符组成');
			document.myform.loginPwd.focus();
			return false;
		}
		if (vcode.length != 4) {
			alert('验证码由4位数字组成');
			document.myform.ValidateCode.focus();
			return false;
		}
		if (!(/^\d{4}$/.test(vcode))) {
			alert('验证码由4位数字组成');
			document.myform.ValidateCode.focus();
			return false;
		}
		return true;
	}
	</script>
</div>
</body>
</html>