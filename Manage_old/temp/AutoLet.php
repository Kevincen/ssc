<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users, $stratGamecq, $endGamecq;
$ConfigModel = configModel("`g_automatic_bu_huo_lock`, `g_mix_money`, `g_mix_money`");
if ($ConfigModel['g_automatic_bu_huo_lock'] != 1) exit(back('自動補倉功能維護中...'));
if ($Users[0]['g_Immediate_lock'] != 1) exit(back('您的權限不足！'));
$db = new DB();
$sql = "SELECT `g_id`, `g_nid`, `g_name`, `g_type`, `g_choose`, `g_money`,`g_lock`, `g_game_id` FROM g_autolet WHERE g_name = '{$Users[0]['g_name']}' ORDER BY g_id DESC";
$result = $db->query($sql, 1);
if (!$result) exit(back('您的帳號異常，無法讀取補倉盤，請與上級聯繫。'));
$a = date('Y-m-d ') . '01:55:00';
$myTime = date('Y-m-d H:i:s');
$bool = false;
if (($myTime < $stratGamecq && $myTime > $a) || $myTime > $endGamecq) {
    $bool = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $List = array();
    for ($i = 0; $i < 76; $i++) {
        $n = $i + 1;
        $List[$i]['g_id'] = $_POST['type' . $n];
        $List[$i]['g_money'] = empty($_POST['money' . $n]) ? 0 : $_POST['money' . $n];
        $List[$i]['g_lock'] = empty($_POST['lock' . $n]) ? 0 : 1;
        if ($List[$i]['g_lock'] == 1) {
            if (!Matchs::isNumber($List[$i]['g_money'])) {
                exit(back('控製額度輸入錯誤！'));
            }
            if ($List[$i]['g_money'] < $ConfigModel['g_mix_money'])
                exit(back('最低“起補額度” ' . $ConfigModel['g_mix_money']));
        }
        if ($bool == false) {
            if ($result[$i]['g_money'] > 0 && $List[$i]['g_lock'] != 1) {
                exit(back('開盤狀態，不可更變狀態！'));
            }
            if ($List[$i]['g_money'] < $result[$i]['g_money']) {
                exit(back('最低可調額度！' . $result[$i]['g_money']));
            }
        }
    }

    for ($i = 0; $i < count($List); $i++) {
        if ($List[$i]['g_money'] != $result[$i]['g_money'] || $List[$i]['g_lock'] != $result[$i]['g_lock']) {
            $valueList = array();
            $name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
            $valueList['g_name'] = $name;
            $valueList['g_f_name'] = $name;
            $valueList['g_initial_value'] = $result[$i]['g_money'];
            $valueList['g_up_value'] = $List[$i]['g_lock'] != 1 ? 0 : $List[$i]['g_money'];
            if ($result[$i]['g_game_id'] == 1) {
                $valueList['g_up_type'] = '廣東快樂十分【' . $result[$i]['g_type'] . '】';
            } else {
                if ($result[$i]['g_game_id'] == 2) {
                    $valueList['g_up_type'] = '重慶時時彩【' . $result[$i]['g_type'] . '】';
                } else if ($result[$i]['g_game_id'] == 6) {
                    $valueList['g_up_type'] = '北京赛车【' . $result[$i]['g_type'] . '】';
                } else {
                    $valueList['g_up_type'] = '廣西快樂十分【' . $result[$i]['g_type'] . '】';
                }
            }
            $valueList['g_s_id'] = 2;
            insertLogValue($valueList);
            $sql = "UPDATE g_autolet SET `g_money` = '{$List[$i]['g_money']}', g_lock='{$List[$i]['g_lock']}' WHERE g_id = '{$List[$i]['g_id']}' LIMIT 1";
            $db->query($sql, 2);
        }
    }
    exit(alert_href('更變成功', 'AutoLet.php'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
        <!--
        $(function () {
            $(":checkbox").each(function () {
                var _checkedId = $(this).attr("checked");
                ischeckbox($(this));
            });
        });

        function ischeckbox($this) {
            var _thisId = $this.attr("id");
            var id = _thisId.substr(4);
            var choose = $("#choose" + id);
            var money = $("#money" + id);
            var pid = $("#p" + id);
            if ($this.attr("checked")) {
                pid.css("background", "#FFFFA2");
                choose.attr("disabled", "");
                money.attr("disabled", "");
            } else {
                pid.css("background", "#FFF");
                choose.attr("disabled", "disabled");
                money.attr("disabled", "disabled");
            }
        }
        //-->
    </script>
    <title></title>
</head>
<body id="bodyModule" showlist="ZHGL,SFTJ,BACX,KJGL,XTSD" firstlogin="0" navnum="12" style="">
<div class="header" id="header">
    <div class="logo">
        <img width="120" src="/uploadfile/logo/logo_sscff_20131020203420.png">
    </div>
    <!--用户信息 开关盘-->
    <div class="header-op">
        <div class="top-op" id="select_sys">
            <p class="left"></p>
            <span><a href="javascript:void(0)" class="switch-on switch" id="klc_sys">广东快乐十分<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="ssc_sys">重庆时时彩<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="pk10_sys">北京赛车<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="nc_sys">幸运农场<b></b></a></span>
            <span><a href="javascript:void(0)" class="switch" id="ks_sys">江苏骰宝<b></b></a></span>
            <span class="split gray">|</span>
            <span class="blue bold">在线：<span class="yel2" id="online_num">1</span></span>

            <div class="right gray">
                <span class="user_logo"></span>账号：<span id="member_id">gd11</span>,<span id="role">股东</span>
                <a href="klc/logout" id="logout" class="logout-link">退出</a>
            </div>
        </div>
        <div class="marquee">
            <p class="left"></p>

            <p class="marqueeBox">
                <marquee id="marqueeBox" scrollamount="2">尊敬的用户，
                    2013年10月28日[重庆时时彩]第20131028064期到第20131028068期和[幸运农场]第20131028054期到第20131028058期已经确定为官方停售，以上期数的注单一律取消。如有不便，敬请谅解！
                </marquee>
            </p>
					<span class="kefu_announce">
                    <a href="javascript:void(0)" class="more more_announcement">更多</a>&nbsp;
					|
					<a id="lineSelect" href="javascript:void(0)"><img src="/webssc/images/lineSelect.png" width="77"
                                                                      height="18" border="0" alt="Live Help"></a>&nbsp;
										</span>
            <span id="marqueeRefresh" class="hidden">12</span>
        </div>
    </div>
    <!--用户信息 开关盘 end-->

    <div class="main-nav">
        <ul>
            <li show="ZHGL" style="display: list-item;"><a nav="account_nav" href="javascript:void(0)">账号管理</a></li>
            <li show="XCJD" style="display: none;"><a nav="supervision" href="javascript:void(0)">现场监督</a></li>
            <li show="SFTJ" style="display: list-item;"><a nav="supervision" href="javascript:void(0)">现场监督</a></li>
            <li show="SFTJ" style="display: list-item;"><a nav="tongji" href="javascript:void(0)">收付统计</a></li>
            <li show="CPJL" style="display: none;"><a nav="operationRecord" href="javascript:void(0)">操盘记录</a></li>
            <li show="BACX" style="display: list-item;" class=""><a nav="reportForm" href="javascript:void(0)">报表</a>
            </li>

            <li show="QSGL" style="display: none;"><a nav="timeManage" href="javascript:void(0)">期数管理</a></li>
            <li show="KJGL" style="display: list-item;"><a nav="result" href="javascript:void(0)">开奖结果</a></li>
            <li show="XTSD" style="display: list-item;" class="on"><a nav="seting" href="javascript:void(0)">系统设定</a>
            </li>
            <!--<li   show='ZDGL'> <a nav="statusmanage" href="javascript:void(0)">注单管理</a> </li>-->
            <li style="display: list-item;"><a nav="infop" href="javascript:void(0)">个人资讯</a></li>
            <li style="display: list-item;"><a nav="rule" href="javascript:void(0)" title="">游戏规则</a></li>
            <li style="display: list-item;"><a nav="changePassword" href="javascript:void(0)" title="">密码变更</a></li>
        </ul>
    </div>

</div>

<!--header end-->
<div id="layout" class="container" style="height: 528px;">
    <div dom="left" class="sidebar" style="display: block;">
        <div id="settingsNav">
            <div class="box">
                <h3 class="blue-title"><span>系统设定</span></h3>
                <ul class="left_nav">


                    <li subnav="replenishment" style="display: list-item;" class="on">补货设定</li>


                </ul>
            </div>
        </div>
    </div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
        <div id="replenishment" class="systemSetBH">
            <div class="game-left">
                <table class="clear_table games">
                    <thead>
                    <tr>
                        <th></th>
                        <th>设置</th>
                        <th>说明</th>
                        <th>类型</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>第一球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc00" name="00"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type001"><input type="radio" id="type001" value="1" name="00">自动</label><label
                                for="type000"><input type="radio" id="type000" value="0" name="00" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第二球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc01" name="01"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type011"><input type="radio" id="type011" value="1" name="01">自动</label><label
                                for="type010"><input type="radio" id="type010" value="0" name="01" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第三球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc02" name="02"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type021"><input type="radio" id="type021" value="1" name="02">自动</label><label
                                for="type020"><input type="radio" id="type020" value="0" name="02" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第四球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc03" name="03"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type031"><input type="radio" id="type031" value="1" name="03">自动</label><label
                                for="type030"><input type="radio" id="type030" value="0" name="03" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第五球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc04" name="04"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type041"><input type="radio" id="type041" value="1" name="04">自动</label><label
                                for="type040"><input type="radio" id="type040" value="0" name="04" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第六球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc05" name="05"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type051"><input type="radio" id="type051" value="1" name="05">自动</label><label
                                for="type050"><input type="radio" id="type050" value="0" name="05" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第七球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc06" name="06"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type061"><input type="radio" id="type061" value="1" name="06">自动</label><label
                                for="type060"><input type="radio" id="type060" value="0" name="06" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>第八球</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc07" name="07"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type071"><input type="radio" id="type071" value="1" name="07">自动</label><label
                                for="type070"><input type="radio" id="type070" value="0" name="07" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>正码</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc29" name="29"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type291"><input type="radio" id="type291" value="1" name="29">自动</label><label
                                for="type290"><input type="radio" id="type290" value="0" name="29" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 单双</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc08" name="08"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type081"><input type="radio" id="type081" value="1" name="08">自动</label><label
                                for="type080"><input type="radio" id="type080" value="0" name="08" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 大小</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc09" name="09"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type091"><input type="radio" id="type091" value="1" name="09">自动</label><label
                                for="type090"><input type="radio" id="type090" value="0" name="09" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 尾大尾小</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc10" name="10"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type101"><input type="radio" id="type101" value="1" name="10">自动</label><label
                                for="type100"><input type="radio" id="type100" value="0" name="10" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 合数单双</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc11" name="11"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type111"><input type="radio" id="type111" value="1" name="11">自动</label><label
                                for="type110"><input type="radio" id="type110" value="0" name="11" checked="checked">手动</label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="game-right">
                <table class="clear_table games">
                    <thead>
                    <tr>
                        <th></th>
                        <th>设置</th>
                        <th>说明</th>
                        <th>类型</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>总和 单双</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc12" name="12"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type121"><input type="radio" id="type121" value="1" name="12">自动</label><label
                                for="type120"><input type="radio" id="type120" value="0" name="12" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>总和 大小</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc13" name="13"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type131"><input type="radio" id="type131" value="1" name="13">自动</label><label
                                for="type130"><input type="radio" id="type130" value="0" name="13" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>总和尾大尾小</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc14" name="14"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type141"><input type="radio" id="type141" value="1" name="14">自动</label><label
                                for="type140"><input type="radio" id="type140" value="0" name="14" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 中发白</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc15" name="15"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type151"><input type="radio" id="type151" value="1" name="15">自动</label><label
                                for="type150"><input type="radio" id="type150" value="0" name="15" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~8 方位</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc16" name="16"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type161"><input type="radio" id="type161" value="1" name="16">自动</label><label
                                for="type160"><input type="radio" id="type160" value="0" name="16" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>1~4龙虎</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc17" name="17"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type171"><input type="radio" id="type171" value="1" name="17">自动</label><label
                                for="type170"><input type="radio" id="type170" value="0" name="17" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>任选二</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc18" name="18"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type181"><input type="radio" id="type181" value="1" name="18">自动</label><label
                                for="type180"><input type="radio" id="type180" value="0" name="18" checked="checked">手动</label>
                        </td>
                    </tr>
                    <!--<tr><th>选二连直</th><td class="bet"><input type="text"  maxlength="9" vname="zc19" name="19" vmessage="金额由不大于9位的正整数组成" /></td><td>占成</td><td><label for="type191"><input type="radio"  id="type191"  value="1" name="19" />自动</label><label for="type190"><input type="radio"  id="type190"  value="0" name="19" />手动</label></td></tr>-->
                    <tr>
                        <th>选二连组</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc20" name="20"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type201"><input type="radio" id="type201" value="1" name="20">自动</label><label
                                for="type200"><input type="radio" id="type200" value="0" name="20" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>任选三</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc21" name="21"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type211"><input type="radio" id="type211" value="1" name="21">自动</label><label
                                for="type210"><input type="radio" id="type210" value="0" name="21" checked="checked">手动</label>
                        </td>
                    </tr>
                    <!--<tr><th>选三前直</th><td class="bet"><input type="text"  maxlength="9" vname="zc22" name="22" vmessage="金额由不大于9位的正整数组成" /></td><td>占成</td><td><label for="type221"><input type="radio"  id="type221"  value="1" name="22" />自动</label><label for="type220"><input type="radio"  id="type220"  value="0" name="22" />手动</label></td></tr>-->
                    <tr>
                        <th>选三前组</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc23" name="23"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type231"><input type="radio" id="type231" value="1" name="23">自动</label><label
                                for="type230"><input type="radio" id="type230" value="0" name="23" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>任选四</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc24" name="24"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type241"><input type="radio" id="type241" value="1" name="24">自动</label><label
                                for="type240"><input type="radio" id="type240" value="0" name="24" checked="checked">手动</label>
                        </td>
                    </tr>
                    <tr>
                        <th>任选五</th>
                        <td class="bet"><input type="text" maxlength="9" vname="zc25" name="25"
                                               vmessage="金额由不大于9位的正整数组成" value="5000"><span class="g-vd-status"></span>
                        </td>
                        <td>占成</td>
                        <td><label for="type251"><input type="radio" id="type251" value="1" name="25">自动</label><label
                                for="type250"><input type="radio" id="type250" value="0" name="25" checked="checked">手动</label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>

            <p class="all_sel"><input type="radio" name="typeAll" id="auto"><label for="auto">全自动</label><input
                    type="radio" name="typeAll" id="manul"><label for="manul">全手动</label></p>

            <div class="btn-line"><a type="button" class="yellow-btn" id="submit" href="javascript:void(0)">保存设置</a><a
                    type="button" class="white-btn" id="reset" href="javascript:void(0)">重置</a></div>
        </div>
    </div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1" style="display: none;"></div>
    <!--main content--></div>
<!--线路切换操作专用-->
<iframe id="lineBoxMask"
        style="display:none;position:absolute;top:0;left:0;z-index:999999998;width:100%;height:100%;filter:mask();opacity: 0"></iframe>
<!--[if lte IE 6.5]><![endif]-->
<div class="g-dialog-win elem-dialog normalsize" style="z-index:999999999; position: absolute;right:3px;top:40px;"
     id="lineSelectBox">
    <div class="pop-border">
        <style type="text/css">
            #lineSelectBox ul {
                width: 100%;
            }

            #lineSelectBox ul li {
                text-align: center;
                line-height: 24px;
                margin: 2px 0px;
                clear: both;
            }

            #lineSelectBox ul li span {
                float: left
            }

            #lineSelectBox ul li .timebox {
                border: 1px solid #E9BA84;
                width: 160px;
                text-align: left;
                line-height: 21px;
            }

            #lineSelectBox ul li input {
                height: 24px;
                float: left;
                width: 40px
            }
        </style>
        <div class="pop-bd">
            <div class="pop-container" dom="container" style="width: 260px;">
                <div class="pop_loader" style="display: block;">
                    <div style="height:auto;color: #000;" class="requestData">
                        <ul>
                        </ul>
                        <div style="clear: both;"><font color="red">提示:</font>反应时间越小，网速越快。</div>
                    </div>
                    <div class="btn-line">
                        <div class="inner">
                            <button tabindex="1" id="lineTestSudu" class="yellow-btn btn_m elem_btn">测速</button>
                            <span tabindex="2" id="lineSelClose" class="white-btn btn_m elem_btn">关闭</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pop-ft"></div>
    </div>
</div>
<div id="speed" style="display: none"></div>
<!--container-->
<script type="text/javascript" src="/webssc/js/backend/all.js?17301_17320_4.1.sp4.1.1.16859.20131031"></script>


<div class="g-dialog-mask g-loading" name="loading" style="display: none;"><!--[if lte IE 6.5]>
    <iframe style="position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;filter:mask();"></iframe>
    <![endif]--></div>
<div class="g-dialog-win elem-dialog g-loading" style="display: none;">
    <div class="pop-border">
        <div dom="head" class="pop-hd"><h4 dom="title">Dialog</h4><a href="javascript:void(0)" dom="headico"
                                                                     class="headico"></a><a href="javascript:void(0)"
                                                                                            dom="close"
                                                                                            class="close"></a><a
                href="javascript:void(0)" dom="toggleSize" class="maxsize" style="display: none;"></a></div>
        <div class="pop-bd">
            <div dom="container" class="pop-container"><span class="loading"></span><span>数据加载中...</span></div>
        </div>
        <div class="pop-ft"></div>
    </div>
</div>
<embed id="xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd"
       type="application/thunder_download_plugin" height="0" width="0">
<div id="htmlcachelayout" style="display:none">
    <div id="pre_htmlcache"></div>
</div>
<dl class="boxDay" style="display: none;">
    <dt><a class="l" href="#">&lt;&lt;</a><a class="r" href="#">&gt;&gt;</a><b><span name="reyear"></span>年<span
                name="remouth"></span>月</b></dt>
    <dd class="hd"><span>日</span><span>一</span><span>二</span><span>三</span><span>四</span><span>五</span><span>六</span>
    </dd>
    <dd name="content" class="bd"></dd>
</dl>
<dl class="boxDay" style="display: none;">
    <dt><a class="l" href="#">&lt;&lt;</a><a class="r" href="#">&gt;&gt;</a><b><span name="reyear"></span>年<span
                name="remouth"></span>月</b></dt>
    <dd class="hd"><span>日</span><span>一</span><span>二</span><span>三</span><span>四</span><span>五</span><span>六</span>
    </dd>
    <dd name="content" class="bd"></dd>
</dl>
<div id="player" style="display:none"><!--[if lte IE 8]>
    <bgsound src="/wav/kaijiang.mp3" autostart=true loop=1></bgsound> <![endif]-->
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
    <audio autoplay="">
        <source src="/wav/kaijiang.mp3">
        <source src="/wav/kaijiang.ogg">
    </audio>
</div>
</body>
>
</html>