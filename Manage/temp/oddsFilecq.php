<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/temp/offGamecq.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/oddsFilecq.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <title></title>
</head>
<body>
<div style="display:none">
    <script language="javascript" type="text/javascript"
            src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16055567.js"></script>
</div>
<div id="layout" class="container" style="height: 528px;">
<div dom="left" class="sidebar" style="display: none;"></div>
<div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
<!--bet content-->
<div dom="main_nav" class="main-content1" style="display: block;">
    <div id="supervision_nav_sc" class="supervision_nav ssc">
        <p class="today_info">
            <strong>今天输赢：<span id="win" class=" bold">0</span></strong>
            <strong>【<span class="dgreen2  letter_space3 bold" id="number"></span>】
                <span class="ggray" style="color:#888888;">期</span>
                &nbsp;&nbsp;&nbsp;距离封盘：<span
                    class="bluer letter_space2" id="offTime" nc="37">00:37</span>&nbsp;&nbsp;&nbsp;距离开奖：<span
                    class="reder letter_space2" id="EndTime" nc="128">02:08</span></strong>
            <strong class="resultnum-str">【<span class="bluer letter_space3 bold" id="q_number">20131123067</span>】<span
                    class="ggray" style="color:#888888;">期</span>&nbsp;&nbsp;&nbsp;开奖号码：
                <span class="reder letter_space2" id="resultnum">
                    <span id="q_a" class="number num0"></span>
                    <span id="q_b" class="number num9"></span>
                    <span id="q_c" class="number num1"></span>
                    <span id="q_d" class="number num0"></span>
                    <span id="q_e" class="number num6"></span>
                </span></strong>
        </p>
        <ul>
            <li class="active red" id="zenghe">
                <p><b onclick="Actfor_load(\'/Manage/temp/oddsFilecq.php?cid=1\')">整合</b></p>

                <p id="navIntegrate" class="greener" style="font-weight:normal">0</p>
            </li>
            <li class="red" id="lizhangdan" style="line-height:32px;"
                onclick="Actfor_load(\'Reckoning.php?tid=2\')">
                账单
            </li>
        </ul>
    </div>
</div>
<div dom="main" class="main-content1">
<div id="supervision_sc" class="supervision super-ssc ssc">
<div id="sup_control">
        <span class="fl">&nbsp;
        <select id="handicap" class="">
            <option value="A">A盘</option>
            <option value="B">B盘</option>
            <option value="C">C盘</option>
        </select>&nbsp;

        <select id="EstateTime">
            <option value="0">手动</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30" selected="">30</option>
            <option value="60">60</option>
            <option value="90">90</option>
        </select>
        <input class="smallInput" id="RefreshTime" value="10" onkeypress="return false;" onkeyup="return false;"
               onclick="this.blur();">
        <a class="mag-btn1 mag-btn2 reder" id="refresh">刷新</a>

		<select id="buhuoStatus" class="">
            <option value="1">实货</option>
            <option value="0">虚货</option>
        </select>
        </span>

</div>
<div id="twoGall_Num" class="super-box">
<div class="super-box-child">
    <table class="bet-table two-digit width1" id="000|005">
        <caption>
            <div> 第一球 <b class="sup-th" id="0">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
            for ($i=1;$i <= 4;$i++) { //大小单双
        ?>
            <tr number="2" playtype="005" cat="01" pnum="0052" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                        switch ($i) {
                            case 1:
                                echo "大";
                                break;
                            case 2:
                                echo "小";
                                break;
                            case 3:
                                echo "单";
                                break;
                            case 4:
                                echo "双";
                                break;
                            default:
                                echo "impossible";
                        }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="ah1<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                    </a>
                </td>
                <?php //ps:这里的odds a 类是作为选择器使用的，详见oddsFiles.php ?>
                <td class="width-per-2 odds a"><a class="line2 sup-line aah1<?php echo $i?>" title="占成">0</a></td>
                <td class="width-per-2 odds a"><a class="line3 sup-line bah1<?php echo $i?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
            }
        ?>
        <?php
        for ($i=1;$i <= 4;$i++) { //0~9球
        ?>
            <tr number="0" playtype="000" cat="00" pnum="0000" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-blue">0</td>
                <td><a class="line1 sup-line" title="赔率"  id="ah<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                        9.91</a></td>
                <td class="odds a"><a class="line2 sup-line aah<?php echo $i ?>" title="占成">0</a></td>
                <td class="odds a"><a class="line3 sup-line bah<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table class="bet-table width1" id="003|008">
        <caption>
            <div>第四球 <b class="sup-th" id="3">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 4;$i++) { //大小单双
            ?>
            <tr number="2" playtype="005" cat="01" pnum="0052" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch ($i) {
                        case 1:
                            echo "大";
                            break;
                        case 2:
                            echo "小";
                            break;
                        case 3:
                            echo "单";
                            break;
                        case 4:
                            echo "双";
                            break;
                        default:
                            echo "impossible";
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="dh1<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                    </a>
                </td>
                <?php //ps:这里的odds a 类是作为选择器使用的，详见oddsFiles.php ?>
                <td class="width-per-2 odds d"><a class="line2 sup-line aah1<?php echo $i?>" title="占成">0</a></td>
                <td class="width-per-2 odds d"><a class="line3 sup-line bah1<?php echo $i?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        <?php
        for ($i=1;$i <= 4;$i++) { //0~9球
            ?>
            <tr number="0" playtype="000" cat="00" pnum="0000" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-blue">0</td>
                <td><a class="line1 sup-line" title="赔率"  id="dh<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                        9.91</a></td>
                <td class="odds d"><a class="line2 sup-line aah<?php echo $i ?>" title="占成">0</a></td>
                <td class="odds d"><a class="line3 sup-line bah<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div class="super-box-child">
    <table class="bet-table width1" id="001|006">
        <caption>
            <div> 第二球 <b class="sup-th" id="1">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 4;$i++) { //大小单双
            ?>
            <tr number="2" playtype="005" cat="01" pnum="0052" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch ($i) {
                        case 1:
                            echo "大";
                            break;
                        case 2:
                            echo "小";
                            break;
                        case 3:
                            echo "单";
                            break;
                        case 4:
                            echo "双";
                            break;
                        default:
                            echo "impossible";
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="bh1<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                    </a>
                </td>
                <?php //ps:这里的odds a 类是作为选择器使用的，详见oddsFiles.php ?>
                <td class="width-per-2 odds b"><a class="line2 sup-line aah1<?php echo $i?>" title="占成">0</a></td>
                <td class="width-per-2 odds b"><a class="line3 sup-line bah1<?php echo $i?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        <?php
        for ($i=1;$i <= 4;$i++) { //0~9球
            ?>
            <tr number="0" playtype="000" cat="00" pnum="0000" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-blue">0</td>
                <td><a class="line1 sup-line" title="赔率"  id="bh<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                        9.91</a></td>
                <td class="odds b"><a class="line2 sup-line aah<?php echo $i ?>" title="占成">0</a></td>
                <td class="odds b"><a class="line3 sup-line bah<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table class="bet-table width1" id="004|009">
        <caption>
            <div>第五球 <b class="sup-th" id="4">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 4;$i++) { //大小单双
            ?>
            <tr number="2" playtype="005" cat="01" pnum="0052" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch ($i) {
                        case 1:
                            echo "大";
                            break;
                        case 2:
                            echo "小";
                            break;
                        case 3:
                            echo "单";
                            break;
                        case 4:
                            echo "双";
                            break;
                        default:
                            echo "impossible";
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="eh1<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                    </a>
                </td>
                <?php //ps:这里的odds a 类是作为选择器使用的，详见oddsFiles.php ?>
                <td class="width-per-2 odds e"><a class="line2 sup-line aah1<?php echo $i?>" title="占成">0</a></td>
                <td class="width-per-2 odds e"><a class="line3 sup-line bah1<?php echo $i?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        <?php
        for ($i=1;$i <= 4;$i++) { //0~9球
            ?>
            <tr number="0" playtype="000" cat="00" pnum="0000" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-blue">0</td>
                <td><a class="line1 sup-line" title="赔率"  id="eh<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                        9.91</a></td>
                <td class="odds e"><a class="line2 sup-line aah<?php echo $i ?>" title="占成">0</a></td>
                <td class="odds e"><a class="line3 sup-line bah<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
</div>

<div class="super-box-child">
    <table class="bet-table width1" id="002|007">
        <caption>
            <div> 第三球 <b class="sup-th" id="2">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 4;$i++) { //大小单双
            ?>
            <tr number="2" playtype="005" cat="01" pnum="0052" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch ($i) {
                        case 1:
                            echo "大";
                            break;
                        case 2:
                            echo "小";
                            break;
                        case 3:
                            echo "单";
                            break;
                        case 4:
                            echo "双";
                            break;
                        default:
                            echo "impossible";
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="ch1<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                    </a>
                </td>
                <?php //ps:这里的odds a 类是作为选择器使用的，详见oddsFiles.php ?>
                <td class="width-per-2 odds c"><a class="line2 sup-line aah1<?php echo $i?>" title="占成">0</a></td>
                <td class="width-per-2 odds c"><a class="line3 sup-line bah1<?php echo $i?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        <?php
        for ($i=1;$i <= 4;$i++) { //0~9球
            ?>
            <tr number="0" playtype="000" cat="00" pnum="0000" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-blue">0</td>
                <td><a class="line1 sup-line" title="赔率"  id="ch<?php echo $i ?>" style="color: rgb(0, 17, 136);">
                        9.91</a></td>
                <td class="odds c"><a class="line2 sup-line aah<?php echo $i ?>" title="占成">0</a></td>
                <td class="odds c"><a class="line3 sup-line bah<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <div class="buhuoset" style="margin-top:15px;text-align:left;"><span
            style="color:#063863;font-weight: bold;">补货设定：</span>
        <input vmessage="金额为不大于9位的正整数" vname="buhuoset1" maxlength="9" value="2" style="width:56px;" bh="5000"><span
            class="g-vd-status"></span>
        <input type="button" value="提交" class="short-yellow-btn">
        <span class="reder"><br>*当补货金额小于10时，只能手动补货，不能自动补货。</span>
        <!--a class="yellow-btn buhuo-yellow-btn" href="javascript:void(0)" id="sbmit">提交</a-->
    </div>
</div>

<div class="super-box-child">
    <table class="bet-table width2" id="010|011|012|013">
        <caption>
            <div>总和-龙虎和 <b class="sup-th" id="5">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 7;$i++) { //大小单双
        ?>
        <tr number="2" playtype="010" cat="01" pnum="0102" status="1"
            style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
            <td class="bold-black width-per-1">
                <?php
                switch($i) {
                    case 1:
                        echo "总大";
                        break;
                    case 2:
                        echo "总小";
                        break;
                    case 3:
                        echo "总单";
                        break;
                    case 4:
                        echo "总双";
                        break;
                    case 5:
                        echo "龙";
                        break;
                    case 6:
                        echo "虎";
                        break;
                    case 7:
                        echo "和";
                        break;
                }
                ?>
            </td>
            <td class="width-per-3">
                <a class="line1 sup-line" title="赔率" id="hh<?php echo $i ?>" style="color: rgb(0, 17, 136);">1.985</a>
            </td>
            <td class="width-per-2 odds w"><a class="line2 sup-line abh<?php echo $i ?>" title="占成">0</a></td>
            <td class="width-per-2 odds w"><a class="line3 sup-line bbh<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table class="bet-table bt-width width2" id="014|017|020|023|026">
        <caption>
            <div> 前三 <b class="sup-th" id="6">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 5;$i++) { //豹子顺子等等
            ?>
            <tr number="2" playtype="010" cat="01" pnum="0102" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch($i) {
                        case 1:
                            echo "豹子";
                            break;
                        case 2:
                            echo "顺子";
                            break;
                        case 3:
                            echo "对子";
                            break;
                        case 4:
                            echo "半顺";
                            break;
                        case 5:
                            echo "杂六";
                            break;
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="ih<?php echo $i ?>" style="color: rgb(0, 17, 136);">1.985</a>
                </td>
                <td class="width-per-2 odds i"><a class="line2 sup-line ach<?php echo $i ?>" title="占成">0</a></td>
                <td class="width-per-2 odds i"><a class="line3 sup-line bch<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table class="bet-table bt-width width2" id="015|018|021|024|027">
        <caption>
            <div>中三 <b class="sup-th" id="7">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 5;$i++) { //豹子顺子等等
            ?>
            <tr number="2" playtype="010" cat="01" pnum="0102" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch($i) {
                        case 1:
                            echo "豹子";
                            break;
                        case 2:
                            echo "顺子";
                            break;
                        case 3:
                            echo "对子";
                            break;
                        case 4:
                            echo "半顺";
                            break;
                        case 5:
                            echo "杂六";
                            break;
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="sh<?php echo $i ?>" style="color: rgb(0, 17, 136);">1.985</a>
                </td>
                <td class="width-per-2 odds s"><a class="line2 sup-line ach<?php echo $i ?>" title="占成">0</a></td>
                <td class="width-per-2 odds s"><a class="line3 sup-line bch<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <table class="bet-table bt-width width2" id="016|019|022|025|028">
        <caption>
            <div> 后三 <b class="sup-th" id="8">0</b></div>
        </caption>
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <tbody>
        <?php
        for ($i=1;$i <= 5;$i++) { //豹子顺子等等
            ?>
            <tr number="2" playtype="010" cat="01" pnum="0102" status="1"
                style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
                <td class="bold-black width-per-1">
                    <?php
                    switch($i) {
                        case 1:
                            echo "豹子";
                            break;
                        case 2:
                            echo "顺子";
                            break;
                        case 3:
                            echo "对子";
                            break;
                        case 4:
                            echo "半顺";
                            break;
                        case 5:
                            echo "杂六";
                            break;
                    }
                    ?>
                </td>
                <td class="width-per-3">
                    <a class="line1 sup-line" title="赔率" id="xh<?php echo $i ?>" style="color: rgb(0, 17, 136);">1.985</a>
                </td>
                <td class="width-per-2 odds x"><a class="line2 sup-line ach<?php echo $i ?>" title="占成">0</a></td>
                <td class="width-per-2 odds x"><a class="line3 sup-line bch<?php echo $i ?>" title="补货" buhuo_sum="0" style="color: black;">0</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div class="super-box-child changlong-box">
    <table class="bet-table bt-width width3 bold" id="016|019|022|025|028">
        <caption>
            <div class="changlong">两面长龙排行</div>
        </caption>
        <tbody id="cl" class="ssc">
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第3球</td>
            <td class="grey blue" style="border-left:none;width:32%;">单</td>
            <td class="bg-pink bg-pink2" style="width:30%;">5期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">总和</td>
            <td class="grey blue" style="border-left:none;width:32%;">小</td>
            <td class="bg-pink bg-pink2" style="width:30%;">4期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第4球</td>
            <td class="grey blue" style="border-left:none;width:32%;">小</td>
            <td class="bg-pink bg-pink2" style="width:30%;">4期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第4球</td>
            <td class="grey blue" style="border-left:none;width:32%;">双</td>
            <td class="bg-pink bg-pink2" style="width:30%;">4期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">虎</td>
            <td class="grey blue" style="border-left:none;width:32%;"></td>
            <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第1球</td>
            <td class="grey blue" style="border-left:none;width:32%;">小</td>
            <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第1球</td>
            <td class="grey blue" style="border-left:none;width:32%;">双</td>
            <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第2球</td>
            <td class="grey blue" style="border-left:none;width:32%;">大</td>
            <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">总和</td>
            <td class="grey blue" style="border-left:none;width:32%;">双</td>
            <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
        </tr>
        <tr>
            <td class="grey blue" style="border-right:none;width:38%;">第5球</td>
            <td class="grey blue" style="border-left:none;width:32%;">大</td>
            <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
        </tr>
        </tbody>
    </table>
</div>
<textarea id="zdmx" style="display:none">        &lt;ul id='zdetail' class='pager de-pager'&gt;&lt;li id='first'
    class='first' title='首页'&gt;&lt;/li&gt;&lt;li id='previous' class='previous' title='上一页'&gt; &lt;/li&gt; &lt;li
    class='other'&gt;第&lt;input type='text' id='current_page' value='1' vname='pager'&gt;页&lt;/li&gt;&lt;li class='other
    t-pager'&gt;共&lt;span id='total_page'&gt;1&lt;/span&gt;页&lt;/li&gt;&lt;li id='next' class='next' title='下一页'&gt;&lt;/li&gt;&lt;li
    id='last' class='last' title='最后一页'&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div class='data-contain'&gt;&lt;/div&gt;
</textarea>
<textarea id="zdmx2" style="display:none">        &lt;table id='supervision_alert_3' class="clear-table"&gt;
    &lt;thead&gt;
    &lt;tr class='like-th'&gt;&lt;td&gt;注单号&lt;/td&gt;&lt;td&gt;盘口&lt;/td&gt;&lt;td&gt;玩法&lt;/td&gt;&lt;td&gt;会员&lt;/td&gt;&lt;td&gt;代理&lt;/td&gt;&lt;td&gt;总代理&lt;/td&gt;
    &lt;td&gt;股东&lt;/td&gt; &lt;td&gt;分公司&lt;/td&gt; &lt;td&gt;时间&lt;/td&gt;&lt;td&gt;下注金额&lt;/td&gt;&lt;td&gt;赔率&lt;/td&gt;
    &lt;td&gt;退水(%)&lt;/td&gt; &lt;td&gt;占成收入&lt;/td&gt; &lt;td&gt;补货&lt;/td&gt; &lt;td&gt;注单状态&lt;/td&gt; &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;$body$&lt;/tbody&gt;
    &lt;tfoot&gt;
    &lt;tr &gt;&lt;th colspan='5'&gt;小计&lt;/th&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;$pager_total1&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;$pager_total2&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;/tr&gt;
    &lt;tr &gt;&lt;th colspan='5'&gt;总计&lt;/th&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;$total1&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;$total2&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;
    &lt;/tfoot&gt;
</textarea>
<textarea id="gsxz" style="display:none">        &lt;h3&gt;&lt;span class='reder'&gt;[&lt;/span&gt;$title$&lt;span
    class='reder'&gt;]&lt;/span&gt;&nbsp;&nbsp;后台补货&lt;/h3&gt;&lt;table id='supervision_alert_2'&gt;&lt;tr
    class='like-th'&gt;&lt;td&gt;可补货后台&lt;/td&gt;&lt;td&gt;补货投注账户&lt;/td&gt;&lt;td&gt;盘口&lt;/td&gt;&lt;td&gt;退水(%)&lt;/td&gt;&lt;td&gt;赔率&lt;/td&gt;&lt;td&gt;操作&lt;/td&gt;&lt;td&gt;金额&lt;/td&gt;&lt;/tr&gt;
    &lt;tbody id='waidaoCor'&gt; &lt;!--&lt;tr&gt;&lt;td&gt;外调补货&lt;/td&gt;
    &lt;td&gt;&nbsp;&lt;/td&gt;
    &lt;td id='pankou'&gt;&nbsp;&lt;/td&gt;
    &lt;td&gt;&lt;input value='' id='alert_2_water' vmessage='请输入数字' vname='water'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input
    value='' id='alert_2_odds' vmessage='请输入数字' vname='odds'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input type='radio'
    checked='true'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input value='' id='alert_2_money' vmessage='请输入数字' vname='money'
    maxLength='9' style='width:60px'/&gt;&lt;/td&gt; --&gt;
    &lt;tr&gt;&lt;td colspan='7'&gt;&lt;img src='/webssc/images/ajax-loader.gif'/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
</textarea>
<textarea id="gsxz_zjs" style="display:none">        &lt;h3&gt;&lt;span class='reder'&gt;[&lt;/span&gt;$title$&lt;span
    class='reder'&gt;]&lt;/span&gt;&nbsp;&nbsp;下级给上级补货&lt;/h3&gt;
    &lt;table id='supervision_alert_2'&gt;
    &lt;tr class='like-th'&gt;
    &lt;td&gt;金额&lt;/td&gt;
    &lt;td&gt;盘口&lt;/td&gt;
    &lt;td&gt;退水(%)&lt;/td&gt;
    &lt;td&gt;赔率&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
    &lt;td&gt;&lt;input value='0' id='alert_2_money' vmessage='请输入数字' vname='money' maxLength='9' style='width:60px'/&gt;&lt;/td&gt;
    &lt;td&gt;&lt;select id='pankou'&gt;&lt;option id='A'&gt;A&lt;/option&gt;&lt;option id='B'&gt;B&lt;/option&gt;&lt;option
    id='C'&gt;C&lt;/option&gt;&lt;/select&gt;&lt;/td&gt;
    &lt;td id='alert_2_water'&gt;&lt;/td&gt;
    &lt;td id='alert_2_odds'&gt;&lt;/td&gt;
    &lt;/tr&gt;
    &lt;/table&gt;
</textarea>
<textarea id="peilv" style="display:none">        &lt;table id='supervision_odds_alert'&gt;&lt;tr class='like-th'&gt;&lt;td
    width='80px'&gt;类别&lt;/td&gt;&lt;td&gt;$table_title&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;球号&lt;/td&gt;&lt;td&gt;$wanfa&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;$handicap盘赔率&lt;/td&gt;&lt;td&gt;&lt;input
    value='' maxlength='9' vmessage='请输入数字' vname='wanwei' id='wanwei' style='width:50px'/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;封/收单&lt;/td&gt;&lt;td
    class='rad-c'&gt;&lt;input type='radio' value='0' name='1'/&gt;封单&nbsp;&nbsp;&nbsp;&nbsp;&lt;input type='radio'
    value='1' name='1'/&gt;收单&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;
</textarea>
</div>
<div id="zhangdan" style="display:none; ">

    <div class="zhangdan_zjs">
        <table class="bet-table z3-table" style="table-layout:auto">
            <thead>
            <tr>
                <th>序号</th>
                <th>项目</th>
                <th>操作说明</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td><font color="blue">广东快乐十分 第1～8球、正码、总和、龙虎投注汇总表</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/klc/BillStatis/index/?t=ball','userball'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><font color="blue">广东快乐十分 连码（注单明细）</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/klc/BillStatis/index/?t=lm','userlianma'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><font color="blue">重庆时时彩 所有投注汇总表</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/ssc/BillStatis/index/?t=all','sscusergame'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><font color="blue">北京赛车 所有投注汇总表</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/pk/BillStatis/index/?t=all','pkusergame'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td><font color="blue">幸运农场 第1～8球、正码、总和、龙虎投注汇总表</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/nc/BillStatis/index/?t=ball','ncuserball'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td><font color="blue">幸运农场 连码（注单明细）</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/nc/BillStatis/index/?t=lm','ncuserlianma'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td><font color="blue">江苏骰宝 所有投注汇总表</font></td>
                <td>封盘后（摇奖前）备份</td>
                <td><a href="javascript:void(0);"
                       onclick="window.open('/'+location.pathname.split('/')[1]+'/ks/BillStatis/index/?t=ball','ksusergame'+location.pathname.split('/')[1]);">打开</a>
                </td>
            </tr>
            </tbody>
        </table>
        <div><font color="red">*账单校对公式：（总投注额-会员赢项目总投注额）-总退水-和局无交收水钱-输赢金额=实际输赢金额</font></div>
    </div>
</div>
</div>
</div>
<!--main content--></div>
</body>
</html>