<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
include_once ROOT_PATH . 'function/cheCookie.php';
//处理切换
if ($_GET['dopost'] == 'ajax') {
    $skin = $_GET['skin'];
    //如果风格不一样则进行更换
    if ($_COOKIE['g_skin'] != $skin) {
        setcookie("g_skin", $skin, 0, "/");
        //修改数据库
        $db = new DB();
        $sql = "update g_user set g_skin='$skin' where g_name='" . $_SESSION['g_S_name'] . "'";
        $result = $db->query($sql, 2);
        if ($result > 0) {
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    echo 0;
    exit;
}
$db = new DB();
$user = $db->query("SELECT `iscash` FROM `g_user` WHERE `g_name` = '" . $_SESSION['g_S_name'] . "' LIMIT 1 ", 0);
$iscash = $user[0][0];

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"<?php echo $oncontextmenu; ?>>
<head>
    <link type="text/css" rel="stylesheet" href="css/TopMenu.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="js/TopMenu.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
</head>
<body id="body_backdrop" class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="header_body">
    <table width="100%" height="84" cellspacing="0" cellpadding="0" border="0" class="header_bg">
        <tbody>
        <tr>
            <td width="250" valign="top">
                <div class="top_logo"><?php echo $Title_cn; ?></div>
            </td>
            <td valign="top">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                    <tr>
                        <td height="44">
                            <table width="716" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                <tr>
                                    <td align="right" valign="bottom">
                                        <div class="main-nav">
                                            <span><a href="report.php" target="mainFrame" title="下注状况">下注状况</a></span> |
                                            <span><a href="repore.php" target="mainFrame" title="账户历史">账户历史</a></span> |
                                            <span><a href="result.php" target="mainFrame" title="开奖结果">开奖结果</a></span> |
                                            <span><a href="topMenu.php" target="mainFrame" title="个人资讯">个人资讯</a></span>
                                            |
                                            <span><a href="/templates_r/rule.php" target="mainFrame" title="游戏规则"
                                                     id="game_rule">游戏规则</a></span> |
                                            <span><a href="upPwd.php" target="mainFrame" title="修改密码">修改密码</a></span> |
                                            <?php
                                            if ($iscash) {
                                                ?>
                                                <span><a href="paywayEX.php?p=4" target="mainFrame" title="充值"
                                                         style="color:#ff0000">充值</a></span> |
                                                <span><a href="paywayEX.php?p=6" target="mainFrame" title="提现"
                                                         style="color:#ff0000">提现</a></span> |
                                            <?php
                                            }
                                            ?>
                                            <div id="skinChange">
                                                <a href="javascript:void(0);" title="更换皮肤" class="skinHandler w4em">更换皮肤▼</a>

                                                <div class="inner" style="display:none;">
                                                    <div class="option"><i class="sBrown"></i><a
                                                            href="javascript:void(0)" skinclass="skin_brown">棕色</a>
                                                    </div>
                                                    <div class="option"><i class="sBlue"></i><a
                                                            href="javascript:void(0)" skinclass="skin_blue">蓝色</a></div>
                                                    <div class="option"><i class="sRed"></i><a href="javascript:void(0)"
                                                                                               skinclass="skin_red">红色</a>
                                                    </div>
                                                </div>
                                            </div>
                                            |
                                            <span><a href="javascript:void(0);" id="linkChange"
                                                     title="线路选择">线路选择</a></span> |
                                            <span><a href="quit.php" class="w2em" id="logout" title="退出"
                                                     target="_">退出</a></span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $configModel = configModel("g_kg_game_lock,g_cq_game_lock,g_gx_game_lock,g_pk_game_lock,g_nc_game_lock,g_lhc_game_lock,g_xj_game_lock,g_jsk3_game_lock");
                            ?>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="top_nav">
                                <tbody>
                                <tr>
                                    <td width="2" height="32" class="top_nav_left">&nbsp;</td>
                                    <td>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_1"
                                           onclick="SelectType(1);"<?php if ($configModel['g_kg_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>广东快乐十分</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_2"
                                           onclick="SelectType(2);"<?php if ($configModel['g_cq_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>重庆时时彩</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_3"
                                           onclick="SelectType(3);"<?php if ($configModel['g_gx_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>广西快乐十分</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_6"
                                           onclick="SelectType(6);"<?php if ($configModel['g_pk_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>北京赛车(PK10)</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_5"
                                           onclick="SelectType(5);"<?php if ($configModel['g_nc_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>幸运农场</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_7"
                                           onclick="SelectType(7);"<?php if ($configModel['g_lhc_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>六合彩</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_8"
                                           onclick="SelectType(8);"<?php if ($configModel['g_xj_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>新疆时时彩</a>
                                        <a href="javascript:void(0);" class="bST_1" id="bST_9"
                                           onclick="SelectType(9);"<?php if ($configModel['g_jsk3_game_lock'] != 1) { ?> style="display:none;"<?php } ?>>江苏骰宝
                                            (快3)</a>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <table width="100%" height="28" cellspacing="0" cellpadding="0" border="0" class="nav_bg">
        <tr>
            <td width="250">&nbsp;</td>
            <td height="28"><span id="Type_List"></span></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    SelectType(1);
    $(document).ready(function() {
        //风格切换
        $("#skinChange").hover(function () {
            $(this).addClass("show_skin");
            $(this).find(".skinHandler").html("更换皮肤▲");
            $(this).find(".inner").show();
        }, function () {
            $(this).removeClass("show_skin");
            $(this).find(".skinHandler").html("更换皮肤▼");
            $(this).find(".inner").hide();
        });
        $(".inner a").click(function () {
            var skin = $(this).attr("skinclass");
            var skin_query = new Object();
            skin_query.dopost = 'ajax';
            skin_query.skin = skin;
            $.ajax({
                type: "GET",
                cache: false,
                url: "top.php",
                data: skin_query,
                success: function (msg) {
                    if (msg == 1) {
                        $("body").removeClass("skin_brown skin_blue skin_red").addClass(skin);
                        window.top.ChangeSkin(skin);
                        window.parent.frames.leftFrame.ChangeSkin(skin);
                        window.parent.frames.DownFrame.ChangeSkin(skin);
                        window.parent.frames.mainFrame.ChangeSkin(skin);
                    }
                }
            });
        });

        //绑定退出按钮
        $("#logout").click(function () {
            window.top.LogOut();
        });
        //绑定测速框
        $("#linkChange").click(function () {
            window.top.ShowLinkBox();
        });

    });

</script>
</body>
</html>