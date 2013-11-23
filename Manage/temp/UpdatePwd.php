<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users, $LoginId;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_pwd = sha1($_POST['s_pwd']);
    $new_pwd = $_POST['new_pwd'];
    if (!Matchs::isString($new_pwd, 8, 20)) exit(back('新密碼 請填寫 8 位或以上（最長20位）！'));
    $pwd = $Users[0]['g_login_id'] == 89 ? "`g_manage`" : "`g_rank`";
    $new_pwd = sha1($new_pwd);
    $db = new DB();
    if (isset($Users[0]['g_s_lock'])) {
        $pwd = "g_relation_user";
        $g_name = "g_s_name";
        $sname = $Users[0]['g_s_name'];
    } else {
        $g_name = "g_name";
        $sname = $Users[0]['g_name'];
    }
    if ($db->query("SELECT {$g_name} FROM {$pwd} WHERE {$g_name} = '{$sname}' AND g_password = '{$s_pwd}' LIMIT 1", 0)) {
        if ($pwd == "`g_rank`")
            $sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}' , g_pwd=0 WHERE {$g_name} = '{$sname}' LIMIT 1";
        else
            $sql = "UPDATE {$pwd} SET g_password = '{$new_pwd}'  WHERE {$g_name} = '{$sname}' LIMIT 1";
        if ($db->query($sql, 2)) {
            exit(alert_href('更變成功，請重新登錄。', 'quit.php'));
        } else {
            exit(back('更變失敗！'));
        }
    } else {
        exit(back('原始密碼錯誤！'));
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

    <title></title>
    <script type="text/javascript">
        <!--
        function isPwd() {
            var s_pwd = $("#s_pwd").val();
            var new_pwd = $("#new_pwd").val();
            var f_pwd = $("#f_pwd").val();
            if (s_pwd == "") {
                alert("請輸入原始密碼");
                return false;
            }

            if (new_pwd.length < 8 || new_pwd.length > 20) {
                alert("新密碼 請填寫 8 位或以上（最長20位）！");
                return false;
            }
            if (new_pwd != f_pwd) {
                alert("確認密碼于新密碼不一致！");
                return false;
            }
            if (new_pwd == s_pwd) {
                alert("新密碼于原始密碼相同！");
                return false;
            }
            if (Pwd_Safety(new_pwd) != true) {
                return false;
            }
            return true;
        }
        -->
    </script>
</head>
<body>
<div id="layout" class="container" style="height: 320px;">
    <div dom="left" class="sidebar" style="display: none;"></div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1">
        <form method="post" action="" onsubmit="return isPwd()">

            <div id="change_password" class="bet-content"
                 validate="{ 'rules':{'voldpassword':   { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/ },'vnewpassword':   { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/, 'notEqualTo': 'voldpassword' },'vrenewpassword': { 'required': 1,'regExp': /^[0-9a-zA-Z]{6,16}$/, 'equalTo': 'vnewpassword'}},'onblur': false,'errorMessages':{'voldpassword':  {'required':'请输入原始密码！','regExp':'密码必须为6~16位的数字或字母组成！'},'vnewpassword':  {'required':'请输入新密码！',  'regExp':'密码必须为6~16位的数字或字母组成！','notEqualTo':'新密码不能和原始密码相同！'},'vrenewpassword':{'required':'请输入确认新密码！','regExp':'密码必须为6~16位的数字或字母组成','equalTo':'新密码与确认密码须一致！'}}}"
                 style="width:100%">
                <table class="bet-table psd-table">
                    <caption>
                        <div>修改密码</div>
                    </caption>
                    <tbody>
                    <tr>
                        <th>旧密码</th>
                        <td><input class="amount-input" type="password" id="s_pwd" value="" vname="voldpassword"
                                   name="s_pwd" maxlength="16"/><span class="g-vd-status"></span></td>
                    </tr>
                    <tr>
                        <th>新密码</th>
                        <td><input class="amount-input" type="password" id="new_pwd" value="" vname="vnewpassword"
                                   name="new_pwd" maxlength="16"/><span class="g-vd-status"></span></td>
                    </tr>
                    <tr>
                        <th>确认密码</th>
                        <td><input class="amount-input" type="password" id="f_pwd" value=""
                                   name="f_pwd" vname="vrenewpassword"
                                   maxlength="16"/><span class="g-vd-status"></span></td>
                    </tr>
                    </tbody>
                </table>
                <span class="blank"></span>

                <div class="btn-line"><input type="submit" class="yellow-btn" id="submit" value="确 定" />
                    <input type="reset" class="white-btn" id="reset" value="重置" /></div>
            </div>
        </form>
    </div>
    <!--main content--></div>
</body>
</html>