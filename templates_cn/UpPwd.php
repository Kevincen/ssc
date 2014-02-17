<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
if ($user[0]['g_look'] == 2) exit(back($UserOut));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aPwd = sha1($_POST['VIP_PWD_old']);
    $bPwd = sha1($_POST['VIP_PWD']);
    $cPwd = $_POST['VIP_PWD1'];
    $db = new DB();
    $sql = "SELECT `g_name` FROM `g_user` WHERE `g_password` = '{$aPwd}' and `g_name` = '{$user[0]['g_name']}' LIMIT 1 ";
    if (!$db->query($sql, 0)) exit(alert_href("原密碼错误!!!", "uppwd.php"));
    $sql = "UPDATE `g_user` SET `g_password` = '{$bPwd}' , g_pwd=0  WHERE `g_name` = '{$user[0]['g_name']}' ";
    if ($db->query($sql, 2)) {
        alert_href("密碼更變成功，請從新登陸!!!", "quit.php");
        exit;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src=".js/sc.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="./js/Pwd_Safety.js"></script>
    <title></title>
    <script type="text/javascript">
        function SubChk() {
            if (document.all.VIP_PWD_old.value.length == "") {
                alert("請輸入原密碼！");
                document.all.VIP_PWD_old.focus();
                return false;
            }
            if (document.all.VIP_PWD.value.length < 8 || document.all.VIP_PWD.value.length > 20) {
                alert("新密碼 請填寫 8 位或以上（最長20位）！");
                document.all.VIP_PWD.focus();
                return false;
            }
            if (document.all.VIP_PWD.value != document.all.VIP_PWD1.value) {
                alert("新密碼 和 新密碼確認 不一樣！(確認大小寫是否相同)");
                document.all.VIP_PWD.focus();
                return false;
            }
            if (document.all.VIP_PWD.value == document.all.VIP_PWD_old.value) {
                alert("新密碼 不能使用 原密碼 請脩改");
                document.all.VIP_PWD.focus();
                return false;
            }
            if (Pwd_Safety(document.all.VIP_PWD.value) != true) return false;
        }
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<form action="" method="post" onsubmit="return SubChk()">
<div id="rightLoader" dom="right" style="">
    <div id="change_password" class="dataArea"
         validate="{ 'rules':{'voldpassword':   { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/ },'vnewpassword':   { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/, 'notEqualTo': 'voldpassword' },'vrenewpassword': { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/, 'equalTo': 'vnewpassword'}},'onblur': false,'errorMessages':{'voldpassword':  {'required':'请输入原始密码！','regExp':'密码必须为6~16位的数字或字母组成！'},'vnewpassword':  {'required':'请输入新密码！',  'regExp':'密码必须为6~16位的数字或字母组成！','notEqualTo':'新密码不能和原始密码相同！'},'vrenewpassword':{'required':'请输入确认新密码！','regExp':'密码必须为6~16位的数字或字母组成','equalTo':'新密码与确认密码须一致！'}}}">
        <table class="t1" width="100%">
            <colgroup>
                <col class="col_single">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th colspan="2"> 修改密码</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="30%" height="28">
                    <div class="t blueness">旧密码</div>
                </td>
                <td>
                    <div class="form"><input class="input_t" type="password" id="oldpassword" value=""
                                             vname="voldpassword" maxlength="16" name="VIP_PWD_old">
                        <span class="g-vd-status"></span></div>
                </td>
            </tr>
            <tr>
                <td height="28">
                    <div class="t blueness">新密码</div>
                </td>
                <td>
                    <div class="form"><input class="input_t" type="password" id="newpassword" value=""
                                             vname="vnewpassword" maxlength="16" name="VIP_PWD">
                        <span class="g-vd-status"></span></div>
                </td>
            </tr>
            <tr>
                <td height="28">
                    <div class="t blueness">确认密码</div>
                </td>
                <td>
                    <div class="form"><input class="input_t" type="password" id="renewpassword" value=""
                                             vname="vrenewpassword" maxlength="16" name="VIP_PWD1">
                        <span class="g-vd-status"></span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <span class="blank"></span>

        <div class="align-c" style="padding:15px 0 0">
            <input type="submit" class="btn_m elem_btn" id="submit"  value="确 定"/>
             <input class="btn_m elem_btn" value="重置" type="reset" id="reset">
        </div>
    </div>
</div>
</form>
</body>
</html>