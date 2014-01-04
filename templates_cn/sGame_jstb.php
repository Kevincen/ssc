<?php
error_reporting(E_ALL ^ E_NOTICE);
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'templates/offGamejsk3.php';
$ConfigModel = configModel("`g_jsk3_game_lock`, `g_mix_money`");
//if ($ConfigModel['g_jsk3_game_lock'] != 1) exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" ' . $onclick;
$_SESSION['cq'] = false;
$_SESSION['jsk3'] = true;
$_SESSION['pk'] = false;
$_SESSION['gd'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);


$g = $_GET['g'];
$abc = $_GET['abc'];
if ($abc == null) {
    $abc = $result[0]['g_panlu'];
} else {
    $sql = "update g_user set g_panlu='$abc' where g_name='$name'";
    $result1 = $db->query($sql, 2);
}
$gametype = "江苏骰宝（快3）";
$sub_type = "大小骰宝";
$number_type = "k3"

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/sGame.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="./js/sc.js"></script>
    <script type="text/javascript" src="./js/sGame_jsk3.js"></script>
    <title></title>
    <script type="text/javascript">
        var s = window.parent.frames.leftFrame.location.href.split('/');
        s = s[s.length - 1];
        if (s !== "left.php")
            window.parent.frames.leftFrame.location.href = "/templates_cn/left.php";

        function soundset(sod) {
            if (sod.value == "on") {
                sod.src = "images/soundoff.png";
                sod.value = "off";
            }
            else {
                sod.src = "images/soundon.png";
                sod.value = "on";
            }
            SetCookie("soundbut", sod.value);
        }
        $(document).ready(function () {
            $('#kuijie').bind('click', function () {
                kuijie();
            })
            $('#yiban').bind('click', function () {
                yiban();
            })
            kuijie();
            common_action_set(submitforms);
        });
    </script>
    <style type="text/css">
        div#row1 {
            float: left;
        }

        div#row2 {
        }
    </style>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
<input type="hidden" name="actions" value="fn3"/>
<input type="hidden" name="gtypes" value="1"/>
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money'] ?>"/>
<input type="hidden" id="hiden" value="<?php echo $g ?>"/>

<div id="rightLoader" dom="right" style="">
<div id="bothSides_ks" class="bothSides ks">
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" name="actions" value="fn3"/>
<input type="hidden" name="gtypes" value="1"/>
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money'] ?>"/>

<div class="actiionn"></div>
<div class="betAreaBox">
<?php include_once './game_header.php' ?>

<div class="common" id="common_div" style="display: block;">
<div id="bothBall" class="pktouzhuArea">
    <table class="w100 t1 touzhuArea wqs" id="sanjun" frame="box" cellpadding="1">
        <colgroup>
            <col class="col_single w5">
            <col class="w8">
            <col class="w9">
            <col class="col_single w5">
            <col class="w8">
            <col class="w9">
            <col class="col_single w5">
            <col class="w8">
            <col class="w9">
            <col class="col_single w5">
            <col class="w8">
            <col class="w9">
        </colgroup>
        <tbody>
        <tr>
            <th colspan="12">三军【赔率说明：一同骰=（赔率-1)X 1、二同骰=（赔率-1)X 2、三同骰=（赔率-1)X 3】、大小</th>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td class="fontBlue huiseBg caption_1"><span class="number num1"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah1"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah1"></td>
            <td class="fontBlue huiseBg caption_1"><span class="number num2"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah2"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah2"></td>
            <td class="fontBlue huiseBg caption_1"><span class="number num3"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah3"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah3"></td>
            <td class="fontBlue huiseBg caption_1">大</td>
            <td playtype="001" number="01" class="huiseBg o" id="ah7"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah7"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1"><span class="number num4"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah4"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah4"></td>
            <td class="fontBlue huiseBg caption_1"><span class="number num5"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah5"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah5"></td>
            <td class="fontBlue huiseBg caption_1"><span class="number num5"></span></td>
            <td playtype="001" number="01" class="huiseBg o" id="ah6"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah6"></td>
            <td class="fontBlue huiseBg caption_1">小</td>
            <td playtype="001" number="01" class="huiseBg o" id="ah8"></td>
            <td class="amount huiseBg loads" id="Ball_1Nah8"></td>
        </tr>
        </tbody>
    </table>
</div>
<div id="bothBall" class="pktouzhuArea">
    <table class="w100 t1 touzhuArea wqs" id="weishai" frame="box" cellpadding="1">
        <colgroup>
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
        </colgroup>
        <tbody>
        <tr>
            <th colspan="12">围骰、全骰</th>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num1"></span>
                <span class="number num1"></span>
                <span class="number num1"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh1"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh1"></td>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num2"></span>
                <span class="number num2"></span>
                <span class="number num2"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh2"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh2"></td>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num3"></span>
                <span class="number num3"></span>
                <span class="number num3"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh3"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh3"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num4"></span>
                <span class="number num4"></span>
                <span class="number num4"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh4"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh4"></td>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num5"></span>
                <span class="number num5"></span>
                <span class="number num5"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh5"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh5"></td>
            <td class="fontBlue huiseBg caption_1">
                <span class="number num6"></span>
                <span class="number num6"></span>
                <span class="number num6"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="bh6"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh6"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1">全骰</td>
            <td playtype="002" number="02" class="huiseBg o" id="bh7"></td>
            <td class="amount huiseBg loads" id="Ball_2Nbh7"></td>
            <td class="fontBlue huiseBg"></td>
            <td class="huiseBg"></td>
            <td class="amount huiseBg"></td>
            <td class="fontBlue huiseBg"></td>
            <td class="huiseBg"></td>
            <td class="amount huiseBg"></td>
        </tr>
        </tbody>
    </table>
</div>
<div id="bothBall" class="pktouzhuArea ">
    <table class="w100 t1 touzhuArea wqs" id="dianshu" frame="box" cellpadding="1">
        <colgroup>
            <col class="col_single w8">
            <col class="w8">
            <col class="w8">
            <col class="col_single w8">
            <col class="w8">
            <col class="w8">
            <col class="col_single w8">
            <col class="w8">
            <col class="w8">
            <col class="col_single w8">
            <col class="w8">
            <col class="w8">
        </colgroup>
        <tbody>
        <tr>
            <th colspan="12">点数</th>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td class="fontBlue huiseBg caption_1">4点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch1"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch1"></td>
            <td class="fontBlue huiseBg caption_1">5点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch2"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch2"></td>
            <td class="fontBlue huiseBg caption_1">6点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch3"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch3"></td>
            <td class="fontBlue huiseBg caption_1">7点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch4"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch4"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1">8点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch5"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch5"></td>
            <td class="fontBlue huiseBg caption_1">9点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch6"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch6"></td>
            <td class="fontBlue huiseBg caption_1">10点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch7"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch7"></td>
            <td class="fontBlue huiseBg caption_1">11点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch8"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch8"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1">12点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch9"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch9"></td>
            <td class="fontBlue huiseBg caption_1">13点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch10"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch10"></td>
            <td class="fontBlue huiseBg caption_1">14点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch11"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch11"></td>
            <td class="fontBlue huiseBg caption_1">15点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch12"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch12"></td>
        </tr>
        <tr>
            <td class="fontBlue huiseBg caption_1">16点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch13"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch13"></td>
            <td class="fontBlue huiseBg caption_1">17点</td>
            <td playtype="002" number="02" class="huiseBg o" id="ch14"></td>
            <td class="amount huiseBg loads" id="Ball_3Nch14"></td>
            <td class="fontBlue huiseBg"></td>
            <td class="huiseBg"></td>
            <td class="amount huiseBg"></td>
            <td class="fontBlue huiseBg"></td>
            <td class="huiseBg"></td>
            <td class="amount huiseBg"></td>
        </tr>
        </tbody>
    </table>
</div>
<div id="bothBall" class="pktouzhuArea ">
    <table class="w100 t1 touzhuArea wqs" id="changpai" frame="box" cellpadding="1">
        <colgroup>
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
        </colgroup>
        <tbody>
        <tr>
            <th colspan="12">长牌</th>
        </tr>
        </tbody>
        <tbody>
        <?php
        $arr = array(12, 13, 14, 15, 16, 23, 24, 25, 26, 34, 35, 36, 45, 46, 56);
        for ($i = 0; $i < count($arr); $i++) {
            if (($i) % 3 == 0 && $i < count($arr) - 1) echo '<tr>';
            ?>
            <td class="fontBlue huiseBg caption_1 ">
                <span class="number num<?= substr($arr[$i], 0, 1) ?>"></span>
                <span class="number num<?= $arr[$i] % 10 ?>"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="dh<?= $i + 1 ?>"></td>
            <td class="amount huiseBg loads" id="Ball_4Ndh<?= $i + 1 ?>"></td>
            <?php
            if (($i + 1) % 3 == 0 && $i < count($arr) - 1) echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<div id="bothBall" class="pktouzhuArea ">
    <table class="w100 t1 touzhuArea wqs" id="duanpai" frame="box" cellpadding="1">
        <colgroup>
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
            <col class="col_single w13">
            <col class="w8">
            <col class="w125">
        </colgroup>
        <tbody>
        <tr>
            <th colspan="12">短牌</th>
        </tr>
        </tbody>
        <tbody>
        <?php
        $arr = array(1, 2, 3, 4, 5, 6);
        for ($i = 0; $i < count($arr); $i++) {
            if (($i) % 3 == 0 && $i < count($arr) - 1) echo '<tr>';
            ?>
            <td class="fontBlue huiseBg caption_1 ">
                <span class="number num<?= $arr[$i] % 10 ?>"></span>
                <span class="number num<?= $arr[$i] % 10 ?>"></span>
            </td>
            <td playtype="002" number="02" class="huiseBg o" id="eh<?= $i + 1 ?>"></td>
            <td class="amount huiseBg loads" id="Ball_5Neh<?= $i + 1 ?>"></td>
            <?php
            if (($i + 1) % 3 == 0 && $i < count($arr) - 1) echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
    <tbody>
    <tr>
        <td width="15%">
            <div class="elem_selected bulk-amount-times hide" style="display: none;">已经选中<span
                    id="selectedAmount" class="amount">5</span>注
            </div>
        </td>
        <td width="45%" class="align-c">
            <div class="elem_amount">
                <div id="td_input_money1">
                    <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney1" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
                </div>
                <a class="btn_m elem_btn" id="submit_bottom" onclick="submitforms()">确 定</a>
                <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
        </td>
        <td width="30%" class="align-r"></td>
    </tr>
    </tbody>
</table>
</div>
</form>
<?php include './popup.html' ?>
<div class="changlongbox recentBox">
    <table style="" class="bet-table  dataArea  t1" id="cl">
        <tbody>
        <tr>
            <th colspan="6">近期开奖结果</th>
        </tr>
        </tbody>
        <tbody id="changlong" class="kstd">
        <tr>
            <td class="align-c  tdqs">82期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="align-c tdnum ">3</td>
            <td class="align-c tdbig greener "></td>
        </tr>
        <tr>
            <td class="align-c  tdqs">81期</td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">15</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">80期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">13</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">79期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="align-c tdnum ">7</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">78期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="align-c tdnum ">10</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">77期</td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">13</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">76期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="align-c tdnum ">6</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">75期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="align-c tdnum ">11</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">74期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">11</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">73期</td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">15</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">72期</td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">17</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">71期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="align-c tdnum ">6</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">70期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="align-c tdnum ">9</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">69期</td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num1"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="align-c tdnum ">5</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">68期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">13</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">67期</td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="align-c tdnum ">11</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">66期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="tdball"><span class="number num4"></span></td>
            <td class="align-c tdnum ">10</td>
            <td class="align-c tdbig   ">小</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">65期</td>
            <td class="tdball"><span class="number num2"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="tdball"><span class="number num6"></span></td>
            <td class="align-c tdnum ">14</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        <tr>
            <td class="align-c  tdqs">64期</td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num3"></span></td>
            <td class="tdball"><span class="number num5"></span></td>
            <td class="align-c tdnum ">11</td>
            <td class="align-c tdbig red ">大</td>
        </tr>
        </tbody>
    </table>
</div>
</div>
</div>

</div>
</body>
</html>