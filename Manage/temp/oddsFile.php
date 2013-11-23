<?php
/*
  * 即时注单--现场监督 //new
  */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/temp/offGame.php';
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'Manage/config/config.php';
if ($ConfigModel['g_nowrecord_lock'] != 1 || $ConfigModel['g_kg_game_lock'] != 1) exit(href('right.php'));
//注额是a*
//盈亏是d*
$oddsLock = false;
if ($Users[0]['g_login_id'] == 48) {
    if ($Users[0]['g_Immediate2_lock'] != 1) exit(back('抱歉！您無權限訪問即時注單。'));
}
if ($Users[0]['g_login_id'] == 89) {
    $oddsLock = true;
} else if (isset($Users[0]['g_odds_lock']) && $Users[0]['g_odds_lock'] == 1) {
    $oddsLock = true;
}
//TODO:默认进入第一类,待正码完成后进行修改
if (!isset($_GET['cid'])) {
    $g = 0;
} else {
    $g = $_GET['cid'];
}

$Mean = -1000000;
switch ($g) {
    case '1':
        $types = '第一球';
        if ($ConfigModel['g_game_1'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean1']))
            $Mean = $_SESSION['Mean1'];
        break;
    case '2':
        $types = '第二球';
        if ($ConfigModel['g_game_2'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean2']))
            $Mean = $_SESSION['Mean2'];
        break;
    case '3':
        $types = '第三球';
        if ($ConfigModel['g_game_3'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean3']))
            $Mean = $_SESSION['Mean3'];
        break;
    case '4':
        $types = '第四球';
        if ($ConfigModel['g_game_4'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean4']))
            $Mean = $_SESSION['Mean4'];
        break;
    case '5':
        $types = '第五球';
        if ($ConfigModel['g_game_5'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean5']))
            $Mean = $_SESSION['Mean5'];
        break;
    case '6':
        $types = '第六球';
        if ($ConfigModel['g_game_6'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean6']))
            $Mean = $_SESSION['Mean6'];
        break;
    case '7':
        $types = '第七球';
        if ($ConfigModel['g_game_7'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean7']))
            $Mean = $_SESSION['Mean7'];
        break;
    case '8':
        $types = '第八球';
        if ($ConfigModel['g_game_8'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean8']))
            $Mean = $_SESSION['Mean8'];
        break;
    default:
//TODO:for test 弄出来正码以后修复,正码暂且按照第一球来
        $g = 0;
        $types = '正码-总和';
        if ($ConfigModel['g_game_1'] != 1) exit(href('right.php'));
        if (isset($_SESSION['Mean1']))
            $Mean = $_SESSION['Mean1'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
        function setMean($this) {
            var patrn = /^[0-9-]{1,9}$/;
            if (patrn.exec($this.value)) {
                $.post("/Manage/temp/ajax/json.php", {typeid: 4, meanid: $this.value, cid: <?php echo $g?>}, function () {
                });
            }
        }
        function GoLocation(sInt) {
            location.href = "/Manage/temp/" + sInt;
        }
        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');

        });
    </script>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/oddsFile.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/setOdds.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height: 558px;">
<!--bet content-->
<div dom="main_nav" class="main-content1" style="display: block;">
    <?php include_once ROOT_PATH . 'Manage/temp/oddsTop.php'; ?>
</div>
<div dom="main" class="main-content1" style="display: block;">
<div id="supervision" class="supervision klc supervision-klc">
<div id="" class="supervision-title"><span class="fl"><select id="handicap" class="">
            <option value="A">A盘</option>
            <option value="B">B盘</option>
            <option value="C">C盘</option>
        </select><select id="EstateTime">
            <option value="0">手动</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30" selected="">30</option>
            <option value="60">60</option>
            <option value="90">90</option>
            <?php //刷新 ?>
        </select><input class="smallInput" id="RefreshTime" value="4" onkeypress="return false;"
                        onkeyup="return false;" onclick="">
        <span class="mag-btn1 mag-btn2 reder" onclick="loadUserInfo(<?php echo $g ?>)">刷新</span>
        <select id="showYk" class="number18 c-area" onchange="sorted_toggle(this.value)"
            <?php if ($g == 0) { ?>
                style="display: none;"
            <?php } else { ?>
                style="display: inline-block; visibility: visible;"
            <?php } ?>
            >
            <option value="1" selected="selected">按球号排行</option>
            <option value="2">按亏损排行</option>
        </select><select id="buhuoStatus" class="">
            <option value="1">实货</option>
            <option value="0">虚货</option>
        </select></span></div>
<div class="s-left">
<!--            1-8球显示这部分,正码显示第二部分-->
<!--此处这个div就是1-8球的布局-->
<div class="number18 c-area" style="<?php echo($g == 0 ? 'display:none' : 'display:table'); ?>">
    <!--此处可以考虑根据一个id来确定是不是排序表单，设置此id为sorted-->
    <table class="bet-table two-digit numbersort nsort" id="not_sorted" style="width: 33.1%;" >
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <caption>
            <div>
                <ul>
                    <li class="s-m-w-1 s-m-w-1-color">号码</li>
                    <li class="s-m-w-2 s-m-w-1-color">赔率</li>
                    <li class="s-m-w-3 s-m-w-1-color zhanch">注额</li>
                    <li class="s-m-w-3 s-m-w-1-color">盈亏</li>
                </ul>
            </div>
        </caption>
        <tbody>
        <?php for ($i = 1; $i <= 20; $i++) { ?>
            <tr number="01" playtype="" cat="01">
                <td class="ball-color s-m-w-1" id="n<?php echo $i?>">
                    <?php if ($i < 10) {
                        echo "0" . $i;
                    } else {
                        echo $i;
                    }
                    ?>
                </td>
                <td class="s-m-w-2"><a class="line1 sup-line" id="h<?php echo $i ?>"></a></td>
                <td class="s-m-w-3"><a class="line2 sup-line" id="a<?php echo $i ?>"> </a></td>
                <td class="s-m-w-3"><a class="line3 sup-line" id="d<?php echo $i ?>"> </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <!--此为排序以后的上表-->
    <table class="bet-table two-digit numbersort nsort" id="sorted" style="display:none" >
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <caption>
            <div>
                <ul>
                    <li class="s-m-w-1 s-m-w-1-color">号码</li>
                    <li class="s-m-w-2 s-m-w-1-color">赔率</li>
                    <li class="s-m-w-3 s-m-w-1-color zhanch">注额</li>
                    <li class="s-m-w-3 s-m-w-1-color">盈亏</li>
                </ul>
            </div>
        </caption>
        <tbody>
        <?php for ($i = 1; $i <= 20; $i++) { ?>
            <tr number="01" playtype="" cat="01">
                <td class="ball-color s-m-w-1" id="nsorted<?php echo $i?>">
                </td>
                <td class="s-m-w-2"><a class="line1 sup-line" id="hsorted<?php echo $i ?>"></a></td>
                <td class="s-m-w-3"><a class="line2 sup-line" id="asorted<?php echo $i ?>"> </a></td>
                <td class="s-m-w-3"><a class="line3 sup-line" id="dsorted<?php echo $i ?>"> </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <table class="bet-table two-digit ycsort" id="sorted_extra"
           style="width: 33.1%; background-color: rgb(252, 247, 191); background-position: initial initial; background-repeat: initial initial;">
        <caption>
            <div><b class="reder">按亏损排行</b></div>
        </caption>
        <colgroup>
            <col class="col1">
        </colgroup>
        <tbody>
        <?php for ($i = 1; $i <= 20; $i++) { ?>
            <tr number="01" playtype="" cat="01">
                <td class="ball-color s-m-w-1" id="nsort_extra<?php echo $i ?>">
                </td>
                <td class="s-m-w-2"><a class="line1 sup-line" id="hsort_extra<?php echo $i ?>"></a></td>
                <td class="s-m-w-3"><a class="line2 sup-line" id="asort_extra<?php echo $i ?>"> </a></td>
                <td class="s-m-w-3"><a class="line3 sup-line" id="dsort_extra<?php echo $i ?>"> </a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <table class="bet-table lmianlhlm" id="zhongfabai" style="width: 33.1%;">
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <caption>
            <div>
                <ul>
                    <li class="s-m-w-1 s-m-w-1-color">号码</li>
                    <li class="s-m-w-2 s-m-w-1-color">赔率</li>
                    <li class="s-m-w-3 s-m-w-1-color zhanch">注额</li>
                    <li class="s-m-w-3 s-m-w-1-color">盈亏</li>
                </ul>
            </div>
        </caption>
        <tbody>
        <tr playtype="016" number="23" cat="09">
            <td class="bold-black s-m-w-1">大</td>
            <td class="s-m-w-2"><a class="line1 sup-line" id="h21"></a></td>
            <td class="s-m-w-3"><a class="line2 sup-line" id="b21"> </a></td>
            <td class="s-m-w-3"><a class="line3 sup-line" id="d21"> </a></td>
        </tr>
        <tr playtype="016" number="24" cat="09">
            <td class="bold-black">小</td>
            <td><a class="line1 sup-line" id="h22"></a></td>
            <td><a class="line2 sup-line" id="b22"> </a></td>
            <td><a class="line3 sup-line" id="d22"> </a></td>
        </tr>
        <tr playtype="008" number="21" cat="08">
            <td class="bold-black">单</td>
            <td><a class="line1 sup-line" id="h23"></a></td>
            <td><a class="line2 sup-line" id="b23"> </a></td>
            <td><a class="line3 sup-line" id="d23"> </a></td>
        </tr>
        <tr playtype="008" number="22" cat="08">
            <td class="bold-black">双</td>
            <td><a class="line1 sup-line" id="h24"></a></td>
            <td><a class="line2 sup-line" id="b24"> </a></td>
            <td><a class="line3 sup-line" id="d24"> </a></td>
        </tr>
        <tr playtype="024" number="25" cat="10">
            <td class="bold-black">尾大</td>
            <td><a class="line1 sup-line" id="h25"></a></td>
            <td><a class="line2 sup-line" id="b25"> </a></td>
            <td><a class="line3 sup-line" id="d25"> </a></td>
        </tr>
        <tr playtype="024" number="26" cat="10">
            <td class="bold-black">尾小</td>
            <td><a class="line1 sup-line" id="h26"></a></td>
            <td><a class="line2 sup-line" id="b26"> </a></td>
            <td><a class="line3 sup-line" id="d26"> </a></td>
        </tr>
        <tr playtype="032" number="27" cat="11">
            <td class="bold-black">合单</td>
            <td><a class="line1 sup-line" id="h27"></a></td>
            <td><a class="line2 sup-line" id="b27"> </a></td>
            <td><a class="line3 sup-line" id="d27"> </a></td>
        </tr>
        <tr playtype="032" number="28" cat="11">
            <td class="bold-black">合双</td>
            <td><a class="line1 sup-line" id="h28"></a></td>
            <td><a class="line2 sup-line" id="b28"> </a></td>
            <td><a class="line3 sup-line" id="d28"> </a></td>
        </tr>
        <tr playtype="039" number="38" cat="16">
            <td class="bold-black">东</td>
            <td><a class="line1 sup-line" id="h29"></a></td>
            <td><a class="line2 sup-line" id="b29"> </a></td>
            <td><a class="line3 sup-line" id="d29"> </a></td>
        </tr>
        <tr playtype="039" number="39" cat="16">
            <td class="bold-black">南</td>
            <td><a class="line1 sup-line" id="h30"></a></td>
            <td><a class="line2 sup-line" id="b30"> </a></td>
            <td><a class="line3 sup-line" id="d30"> </a></td>
        </tr>
        <tr playtype="039" number="40" cat="16">
            <td class="bold-black">西</td>
            <td><a class="line1 sup-line" id="h31"></a></td>
            <td><a class="line2 sup-line" id="b31"> </a></td>
            <td><a class="line3 sup-line" id="d31"> </a></td>
        </tr>
        <tr playtype="039" number="41" cat="16">
            <td class="bold-black">北</td>
            <td><a class="line1 sup-line" id="h32"></a></td>
            <td><a class="line2 sup-line" id="b32"> </a></td>
            <td><a class="line3 sup-line" id="d32"> </a></td>
        </tr>
        <tr playtype="039" number="35" cat="15">
            <td class="bold-black">中</td>
            <td><a class="line1 sup-line" id="h33"></a></td>
            <td><a class="line2 sup-line" id="b33"> </a></td>
            <td><a class="line3 sup-line" id="d33"> </a></td>
        </tr>
        <tr playtype="039" number="36" cat="15">
            <td class="bold-black">发</td>
            <td><a class="line1 sup-line" id="h34"></a></td>
            <td><a class="line2 sup-line" id="b34"> </a></td>
            <td><a class="line3 sup-line" id="d34"> </a></td>
        </tr>
        <tr playtype="039" number="37" cat="15">
            <td class="bold-black">白</td>
            <td><a class="line1 sup-line" id="h35"></a></td>
            <td><a class="line2 sup-line" id="b35"> </a></td>
            <td><a class="line3 sup-line" id="d35"> </a></td>
        </tr>
        <tr playtype="" number="42" cat="17" class="longhu1_4">
            <td class="bold-black">龙</td>
            <td><a class="line1 sup-line" id="h36"></a></td>
            <td><a class="line2 sup-line" id="b36"> </a></td>
            <td><a class="line3 sup-line" id="d36"> </a></td>
        </tr>
        <tr playtype="" number="43" cat="17" class="longhu1_4">
            <td class="bold-black">虎</td>
            <td><a class="line1 sup-line" id="h37"></a></td>
            <td><a class="line2 sup-line" id="b37"> </a></td>
            <td><a class="line3 sup-line" id="d37"> </a></td>
        </tr>
        </tbody>
    </table>
    <div class="total-tongji">
        <div class="buhuoset" style="">补货设定：<input vmessage="金额为不大于9位的正整数" vname="buhuoset1"
                                                   maxlength="9" value="2" style="width:65px;"
                                                   bh="5000"><span class="g-vd-status"></span><input
                type="button" value="提交" class="short-yellow-btn"><span
                class="reder"><br>*当补货金额小于10时，只能手动补货，不能自动补货。</span>
        </div>
        <p>总投注额：<b class="dgreen" id="CountNum">0b></p>

        <p>最高亏损：<b class="reder" id="CountLose">0</b></p>

        <p>最高盈利：<b id="CountWin">0</b></p></div>
</div>
<!--正码总和的布局-->
<div class="longhu_zm c-area" style="<?php echo($g == 0 ? 'display:table' : 'display:none'); ?>">
<table class="bet-table lmianlhlm" style="width:49.5%">
    <colgroup>
        <col class="col1">
        <col class="col2">
    </colgroup>
    <caption>
        <div>
            <ul>
                <li class="s-m-w-1 s-m-w-1-color">号码</li>
                <li class="s-m-w-2 s-m-w-1-color">赔率</li>
                <li class="s-m-w-3 s-m-w-1-color zhanch">注额</li>
                <li class="s-m-w-3 s-m-w-1-color">盈亏</li>
            </ul>
        </div>
    </caption>
    <tbody>
    <?php for ($i = 1; $i <= 20; $i++) { ?>
        <tr number="01" playtype="" cat="01">
            <td class="ball-color s-m-w-1">
                <?php if ($i < 10) {
                    echo "0" . $i;
                } else {
                    echo $i;
                }
                ?>
            </td>
            <td class="s-m-w-2"><a class="line1 sup-line" id="h<?php echo $i ?>"></a></td>
            <td class="s-m-w-3"><a class="line2 sup-line" id="a<?php echo $i ?>"> </a></td>
            <td class="s-m-w-3"><a class="line3 sup-line" id="d<?php echo $i ?>"> </a></td>
        </tr>
    <?php } ?>
    <tr number="01" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color s-m-w-1">
            <?php if ($i < 10) {
                echo "0" . $i;
           } else {
                echo $i;
            }
            ?>
        </td>
        <td class="s-m-w-2"><a class="line1 sup-line" firstlogin="1"
                               style="color: rgb(0, 17, 136);">2.38</a></td>
        <td class="s-m-w-3"><a class="line2 sup-line">0</a></td>
        <td class="s-m-w-3"><a class="line3 sup-line" buhuo_sum="0"
                               style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="02" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color">02</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="03" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color">03</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="04" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color">04</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="05" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color">05</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="06" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="ball-color">06</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="07" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">07</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="08" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">08</td>
        <td class="ball-color">08</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="09" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">09</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="10" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">10</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="11" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">11</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="12" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">12</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="13" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">13</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="14" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">14</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="15" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">15</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="16" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">16</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="17" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">17</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="18" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color">18</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="19" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color ball-bc">19</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr number="20" playtype="075" cat="29" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="ball-color ball-bc">20</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">2.38</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    </tbody>
</table>
<table class="bet-table bt-width lmianlhlm" style="width:49.5%">
    <colgroup>
        <col class="col1">
        <col class="col2">
    </colgroup>
    <caption>
        <div>
            <ul>
                <li class="s-m-w-1 s-m-w-1-color">号码</li>
                <li class="s-m-w-2 s-m-w-1-color">赔率</li>
                <li class="s-m-w-3 s-m-w-1-color zhanch">注额</li>
                <li class="s-m-w-3 s-m-w-1-color">盈亏</li>
            </ul>
        </div>
    </caption>
    <tbody>
    <tr playtype="041" number="31" cat="13" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="bold-black s-m-w-1">总和大</td>
        <td class="s-m-w-2"><a class="line1 sup-line" firstlogin="1"
                               style="color: rgb(0, 17, 136);">1.985</a></td>
        <td class="s-m-w-3"><a class="line2 sup-line">0</a></td>
        <td class="s-m-w-3"><a class="line3 sup-line" buhuo_sum="0"
                               style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr playtype="041" number="32" cat="13" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="bold-black">总和小</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">1.985</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr playtype="040" number="29" cat="12" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="bold-black">总和单</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">1.985</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr playtype="040" number="30" cat="12" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="bold-black">总和双</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">1.985</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr playtype="042" number="33" cat="14" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;"
        class="">
        <td class="bold-black">总和尾大</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">1.985</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    <tr playtype="042" number="34" cat="14" status="1"
        style="background-image: none; background-position: initial initial; background-repeat: initial initial;">
        <td class="bold-black">总和尾小</td>
        <td><a class="line1 sup-line" firstlogin="1" style="color: rgb(0, 17, 136);">1.985</a></td>
        <td><a class="line2 sup-line">0</a></td>
        <td><a class="line3 sup-line" buhuo_sum="0" style="color: rgb(0, 0, 0);">0</a></td>
    </tr>
    </tbody>
</table>
                    <span class="buhuoset" style="">补货设定：<input vmessage="金额为不大于9位的正整数" vname="buhuoset2" maxlength="9"
                                                                value="2" style="width:65px" bh="5000"><span
                            class="g-vd-status"></span><input type="button" value="提交" class="short-yellow-btn"><span
                            class="reder">&nbsp;&nbsp;*当补货金额小于10时，只能手动补货，不能自动补货。</span></span></div>
<!--连码的布局-->
<div class="lianma c-area" style="display: none;">
    <table class="bet-table bt-width">
        <colgroup>
            <col class="col1">
            <col class="col2">
        </colgroup>
        <caption>
            <div>
                <ul>
                    <li style="width:25%;">号码</li>
                    <li style="width:37.1%;">赔率</li>
                    <li style="width:37.1%;" class="zhanch">注额</li>
                </ul>
            </div>
        </caption>
        <tbody>
        <tr playtype="061" cat="18" number="">
            <td class="bold-black s-m-w-1">任选二</td>
            <td class="s-m-w-3"><a class="line1 sup-line"></a></td>
            <td class="s-m-w-3"><a class="line2 sup-line"> </a></td>
        </tr>
        <tr playtype="063" cat="20" number="">
            <td class="bold-black">选二连组</td>
            <td><a class="line1 sup-line"></a></td>
            <td><a class="line2 sup-line"> </a></td>
        </tr>
        <tr playtype="064" cat="21" number="">
            <td class="bold-black">任选三</td>
            <td><a class="line1 sup-line"></a></td>
            <td><a class="line2 sup-line"> </a></td>
        </tr>
        <tr playtype="066" cat="23" number="">
            <td class="bold-black">选三前组</td>
            <td><a class="line1 sup-line"></a></td>
            <td><a class="line2 sup-line"> </a></td>
        </tr>
        <tr playtype="067" cat="24" number="">
            <td class="bold-black">任选四</td>
            <td><a class="line1 sup-line"></a></td>
            <td><a class="line2 sup-line"> </a></td>
        </tr>
        <tr playtype="068" cat="25" number="">
            <td class="bold-black">任选五</td>
            <td><a class="line1 sup-line"></a></td>
            <td><a class="line2 sup-line"> </a></td>
        </tr>
        </tbody>
    </table>
</div>
</div>
<div class="s-right">
    <div class="cell-t cell-left">
        <table class="bet-table cellbg">
            <caption>
                <div class="s-m-w-1-color"><strong>总额</strong><span class="greener bold">0</span></div>
            </caption>
            <tbody>
            <tr href="ball1">
                <td width="60px"><span>第一球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l1">0</span></td>
            </tr>
            <tr href="ball2">
                <td><span>第二球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l2">0</span></td>
            </tr>
            <tr href="ball3">
                <td><span>第三球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l3">0</span></td>
            </tr>
            <tr href="ball4">
                <td><span>第四球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l4">0</span></td>
            </tr>
            <tr href="ball5">
                <td><span>第五球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l5">0</span></td>
            </tr>
            <tr href="ball6">
                <td><span>第六球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l6">0</span></td>
            </tr>
            <tr href="ball7">
                <td><span>第七球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l7">0</span></td>
            </tr>
            <tr href="ball8">
                <td><span>第八球<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l8">0</span></td>
            </tr>
            <tr href="sumDT">
                <td><span>正码<code class="lem">总</code></span>:</td>
                <td><span class="greener bold" id="l9">0</span></td>
            </tr>
            <tr href="sumDT">
                <td><span>总和大小</span>:</td>
                <td><span class="greener bold" id="l10">0</span></td>
            </tr>
            <tr href="sumDT">
                <td><span>总和单双</span>:</td>
                <td><span class="greener bold" id="l11">0</span></td>
            </tr>
            <tr href="sumDT">
                <td><span>总尾大小</span>:</td>
                <td><span class="greener bold" id="l12">0</span></td>
            </tr>
            <!--<tr href='sumDT'><td ><span>龙虎</span>:</td><td><span class='greener bold'></span></td></tr>-->
            <tr href="evenCode">
                <td><span>任选二</span>:</td>
                <td><span class="greener bold" id="l13">0</span></td>
            </tr>
            <tr href="evenCode">
                <td><span>选二连组</span>:</td>
                <td><span class="greener bold" id="l14">0</span></td>
            </tr>
            <tr href="evenCode">
                <td><span>任选三</span>:</td>
                <td><span class="greener bold" id="l15">0</span></td>
            </tr>
            <tr href="evenCode">
                <td><span>选三前组</span>:</td>
                <td><span class="greener bold" id="l16">0</span></td>
            </tr>
            <tr href="evenCode">
                <td><span>任选四</span>:</td>
                <td><span class="greener bold" id="l17">0</span></td>
            </tr>
            <tr href="evenCode">
                <td><span>任选五</span>:</td>
                <td><span class="greener bold" id="l18">0</span></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="cell-t cell-center">
        <table class="bet-table cellbg">
            <colgroup>
                <col class="col1">
            </colgroup>
            <caption>
                <div class="s-m-w-1-color"><strong>遗漏</strong></div>
            </caption>
            <tbody>
            <?php for ($i = 1; $i <= 20; $i++) { ?>
                <tr>
                    <td class="ball-color font14 bold">
                        <?php if ($i < 10) {
                            echo "0" . $i;
                        } else {
                            echo $i;
                        }
                        ?>
                    </td>
                    <td><span class="omission" id="f<?php echo $i ?>"></span></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="cell-t cell-right">
        <table class="chlong bold">
            <caption>
                <div class="changlong">两面长龙排行</div>
            </caption>
            <colgroup>
                <col class="changl-col1">
                <col class="changl-col2">
                <col class="changl-col3">
            </colgroup>
            <tbody id="changlong" class="ssc">
            <td class="align-c">暂无数据</td>
            </tbody>
        </table>
    </div>
</div>
<div id="zhangdan" style="display: none;">
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
<textarea id="gsxz" style="display:none">&lt;h3&gt;&lt;span class='reder'&gt;[&lt;/span&gt;$title$&lt;span
    class='reder'&gt;]&lt;/span&gt;&nbsp;&nbsp;后台补货&lt;/h3&gt;&lt;table id='supervision_alert_2'&gt;&lt;tr
    class='like-th'&gt;&lt;td&gt;可补货后台&lt;/td&gt;&lt;td&gt;补货投注账户&lt;/td&gt;&lt;td&gt;盘口&lt;/td&gt;&lt;td&gt;退水(%)&lt;/td&gt;&lt;td&gt;赔率&lt;/td&gt;&lt;td&gt;操作&lt;/td&gt;&lt;td&gt;金额&lt;/td&gt;&lt;/tr&gt;&lt;tbody
    id='waidaoCor'&gt;&lt;!--&lt;tr&gt;&lt;td&gt;外调补货&lt;/td&gt;&lt;td&gt;&nbsp;&lt;/td&gt;&lt;td
    id='pankou'&gt;&nbsp;&lt;/td&gt;&lt;td&gt;&lt;input value='' id='alert_2_water' vmessage='请输入数字'
    vname='water'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input value='' id='alert_2_odds' vmessage='请输入数字'
    vname='odds'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input type='radio' checked='true'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input
    value='' id='alert_2_money' vmessage='请输入数字' vname='money' maxLength='9' style='width:60px'/&gt;&lt;/td&gt;
    --&gt;&lt;tr&gt;&lt;td colspan='7'&gt;&lt;img src='/webssc/images/ajax-loader.gif'/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;</textarea><textarea
    id="gsxz_zjs" style="display:none">&lt;h3&gt;&lt;span class='reder'&gt;[&lt;/span&gt;$title$&lt;span
    class='reder'&gt;]&lt;/span&gt;&nbsp;&nbsp;下级给上级补货&lt;/h3&gt;&lt;table id='supervision_alert_2'&gt;&lt;tr
    class='like-th'&gt;&lt;td&gt;金额&lt;/td&gt;&lt;td&gt;盘口&lt;/td&gt;&lt;td&gt;退水(%)&lt;/td&gt;&lt;td&gt;赔率&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;&lt;input
    value='' id='alert_2_money' vmessage='请输入数字' vname='money' maxLength='9' style='width:60px'/&gt;&lt;/td&gt;&lt;td&gt;&lt;select
    id='pankou'&gt;&lt;option id='A'&gt;A&lt;/option&gt;&lt;option id='B'&gt;B&lt;/option&gt;&lt;option
    id='C'&gt;C&lt;/option&gt;&lt;/select&gt;&lt;/td&gt;&lt;td id='alert_2_water'&gt;&lt;/td&gt;&lt;td
    id='alert_2_odds'&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;</textarea><textarea id="lianma_opt"
                                                                                  style="display:none">&lt;option
    value='all'&gt;全部&lt;/option&gt;&lt;option value='18'&gt;任选二&lt;/option&gt;&lt;option value='20'&gt;选二连组&lt;/option&gt;&lt;option
    value='21'&gt;任选三&lt;/option&gt;&lt;option value='23'&gt;选三前组&lt;/option&gt;&lt;option value='24'&gt;任选四&lt;/option&gt;&lt;option
    value='25'&gt;任选五&lt;/option&gt;</textarea><textarea id="longhu_opt" style="display:none">&lt;option
    value='all'&gt;全部&lt;/option&gt;&lt;option value='12|13|14'&gt;两面&lt;/option&gt;&lt;option value='29'&gt;正码&lt;/option&gt;</textarea><textarea
    id="zdmx" style="display:none">&lt;ul id='zdetail' class='pager de-pager'&gt;&lt;li id='first'
    class='first' title='首页'&gt;&lt;/li&gt;&lt;li id='previous' class='previous' title='上一页'&gt; &lt;/li&gt;
    &lt;li class='other'&gt;第&lt;input type='text' id='current_page' value='1' vname='pager'&gt;页&lt;/li&gt;&lt;li
    class='other t-pager'&gt;共&lt;span id='total_page'&gt;1&lt;/span&gt;页&lt;/li&gt;&lt;li id='next'
    class='next' title='下一页'&gt;&lt;/li&gt;&lt;li id='last' class='last' title='最后一页'&gt;&lt;/li&gt;&lt;/ul&gt;&lt;div
    class='data-contain'&gt;&lt;/div&gt;</textarea><textarea id="odd_alert" style="display:none">&lt;table
    id='supervision_odds_alert' class='odds-box'&gt;&lt;tr class='like-th'&gt;&lt;td width='80px'&gt;类别&lt;/td&gt;&lt;td&gt;$a$&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;球号&lt;/td&gt;&lt;td&gt;$b$&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;$c$盘赔率&lt;/td&gt;&lt;td&gt;&lt;input
    value='' maxlength='9' vmessage='请输入数字' vname='wanwei' id='wanwei' class='input-text'/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;封/收单&lt;/td&gt;&lt;td
    class='radiobox'&gt;&lt;input type='radio' value='0' name='s1'/&gt;封单&nbsp;&nbsp;&nbsp;&nbsp;&lt;input
    type='radio' value='1' name='s1'/&gt;收单&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;</textarea></div>
</div>
<!--main content--></div>
</body>
</html>
