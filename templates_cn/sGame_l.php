<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_9`");

//if ($ConfigModel['g_kg_game_lock'] !=1 || $ConfigModel['g_game_9'] !=1)exit(href('right.php'));
$types = '正码';
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" ' . $onclick;


//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);

$gurl = 'sGame_l';
$g = $_GET['g'];

?>
<?php //include_once 'inc/top.php'; //by kevin 本文件不使用通用头部
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <link href="css/sGame.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="js/sc.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="js/funcions.js"></script>
    <script type="text/javascript" src="/wjl_tmp/front.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#kuijie').click(function () {
                kuijie();
            })
            $('#yiban').click(function () {
                yiban();
            })
            action();
        });
    </script>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr height="24">
        <td class="bolds wanfa">广东快乐十分 <span style="color:#0033FF; font-weight:bold; margin-left:10px;"
                                             id="tys"><?= $types ?></span></td>
        <td align="left" class="bolds" style="color:#FF0000">
            <div id="row1" style="FONT-FAMILY: Arial; color: red;"><span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
        </td>
        <td class="bolds klsfhm" align="right" colspan="2">
            <span id="n" style="line-height:25px;"></span>期开奖
            <div id="a" class="nc1">&nbsp;</div>
            <div id="b">&nbsp;</div>
            <div id="c">&nbsp;</div>
            <div id="d">&nbsp;</div>
            <div id="e">&nbsp;</div>
            <div id="f">&nbsp;</div>
            <div id="g">&nbsp;</div>
            <div id="h">&nbsp;</div>
        </td>
    </tr>
    <tr height="25">
        <td width="25%"><span id="o" style="color:#009900; font-weight:bold;top:1px"></span>期</td>
        <td width="29%">距离封盘：<span style="font-size:104%" id="endTime">00:00</span></td>
        <td width="25%">距离开奖：<span style="color:red;font-size:104%" id="endTimes">00:00</span></td>
        <td width="21%" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>

<form id="dp" action="./inc/DataProcessing.php" method="post" target="leftFrame">
    <table class="ths" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td><span style="float:left">投注类型：</span><a href="#this" class="intype_normal" id="kuijie">快捷</a><a
                    href="#this" class="intype_hover" id="yiban">一般</a></td>
        </tr>
    </table>
    <div id="hidden_inputs">
    </div>
    <input type="hidden" name="type" value="ordinary" id="touzhu_type"/><!--判断是快捷投注还是一般投注-->
    <input type="hidden" name="actions" value="fn1"/>
    <input type="hidden" name="gtypes" value="1"/>
    <input type="hidden" name="s_number" value=""/>

    <table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px;">
        <colgroup>
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
            <col style="width:8.3%">
        </colgroup>

        <tr class="t_list_caption">
            <th colspan="12" style="text-align: center">
                <?php echo $types ?>
            </th>
        </tr>

        <tr class="t_list_caption">
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1"><span class="No_gd1"></span></td>
            <td class="o" id="h1" ball_name="1"></td>
            <td class="tt" id="t1"></td>
            <td class="caption_1"><span class="No_gd6"></span></td>
            <td class="o" id="h6" ball_name="6"></td>
            <td class="tt" id="t2"></td>
            <td class="caption_1"><span class="No_gd11"></span></td>
            <td class="o" id="h11" ball_name="11"></td>
            <td class="tt" id="t5"></td>
            <td class="caption_1"><span class="No_gd16"></span></td>
            <td class="o" id="h16" ball_name="16"></td>
            <td class="tt" id="t5"></td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1"><span class="No_gd2"></td>
            <td class="o" id="h2" ball_name="2"></td>
            <td class="tt" id="t3"></td>
            <td class="caption_1"><span class="No_gd7"></td>
            <td class="o" id="h7" ball_name="7"></td>
            <td class="tt" id="t4"></td>
            <td class="caption_1"><span class="No_gd12"></td>
            <td class="o" id="h12" ball_name="12"></td>
            <td class="tt" id="t7"></td>
            <td class="caption_1"><span class="No_gd17"></td>
            <td class="o" id="h17" ball_name="17"></td>
            <td class="tt" id="t7"></td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1"><span class="No_gd3"></td>
            <td class="o" id="h3" ball_name="3"></td>
            <td class="tt" id="t3"></td>
            <td class="caption_1"><span class="No_gd8"></td>
            <td class="o" id="h8" ball_name="8"></td>
            <td class="tt" id="t4"></td>
            <td class="caption_1"><span class="No_gd13"></td>
            <td class="o" id="h13" ball_name="13"></td>
            <td class="tt" id="t7"></td>
            <td class="caption_1"><span class="No_gd18"></td>
            <td class="o" id="h18" ball_name="18"></td>
            <td class="tt" id="t7"></td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1"><span class="No_gd4"></td>
            <td class="o" id="h4" ball_name="4"></td>
            <td class="tt" id="t3"></td>
            <td class="caption_1"><span class="No_gd9"></td>
            <td class="o" id="h9" ball_name="9"></td>
            <td class="tt" id="t4"></td>
            <td class="caption_1"><span class="No_gd14"></td>
            <td class="o" id="h14" ball_name="14"></td>
            <td class="tt" id="t7"></td>
            <td class="caption_1"><span class="No_gd19"></td>
            <td class="o" id="h19" ball_name="19"></td>
            <td class="tt" id="t7"></td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1"><span class="No_gd5"></td>
            <td class="o" id="h5" ball_name="5"></td>
            <td class="tt" id="t3"></td>
            <td class="caption_1"><span class="No_gd10"></td>
            <td class="o" id="h10" ball_name="10"></td>
            <td class="tt" id="t4"></td>
            <td class="caption_1"><span class="No_gd15"></td>
            <td class="o" id="h15" ball_name="15"></td>
            <td class="tt" id="t7"></td>
            <td class="caption_1"><span class="No_gd20"></td>
            <td class="o" id="h20" ball_name="20"></td>
            <td class="tt" id="t7"></td>
        </tr>
    </table>
    <table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px;">
        <colgroup>
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
            <col style="width:11.1%">
        </colgroup>
        <tr class="t_list_caption">
            <th colspan="9" style="text-align: center">
                总和
            </th>
        </tr>
        <tr class="t_list_caption">
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
            <td>球号</td>
            <td>赔率</td>
            <td class="je">金额</td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1">总和大</span></td>
            <td class="o" id="h21" ball_name="总和大"></td>
            <td class="tt" id="t1"></td>
            <td class="caption_1">总和单</td>
            <td class="o" id="h23" ball_name="总和单"></td>
            <td class="tt" id="t2"></td>
            <td class="caption_1">总和尾大</td>
            <td class="o" id="h25" ball_name="总和尾大"></td>
            <td class="tt" id="t5"></td>
        </tr>
        <tr class="t_td_text">
            <td class="caption_1">总和小</td>
            <td class="o" id="h22" ball_name="总和小"></td>
            <td class="tt" id="t3"></td>
            <td class="caption_1">总和双</td>
            <td class="o" id="h24" ball_name="总和双"></td>
            <td class="tt" id="t4"></td>
            <td class="caption_1">总和尾小</td>
            <td class="o" id="h26" ball_name="总和尾小"></td>
            <td class="tt" id="t7"></td>
        </tr>
    </table>
    <table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
        <tr>
            <td width="65" class="tz_title" valign="top">&nbsp;</td>
            <td width="115">&nbsp;</td>
            <td align="left">
                <table border="0" width="278">
                    <tr height="26">
                        <td align="center">
                            <span id="td_input_money"><font class="tz_title">金额</font>&nbsp;<input type="text"
                                                                                                   id="AllMoney"
                                                                                                   onkeydown="return IsNumeric()"
                                                                                                   class="myAllMoney"
                                                                                                   value=""/></span>
                            <input type="button" id="submits" onclick="submit_odds('<?php echo $types ?>','.o')" class="inputs ti" value="确定"/>
                            <input type="button" onclick="MyReset()" class="inputs ti" value="重置"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<?php include './popup.html'?>

<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tbody>
    <tr class="t_list_caption">

        <td><a class="nv" onclick="getResult(this)" href="javascript:void(0)">总和大小</a></td>
        <td><a class="nv" onclick="getResult(this)" href="javascript:void(0)">总和单双</a></td>
        <td class=""><a class="nv" onclick="getResult(this)" href="javascript:void(0)">总和尾数大小</a></td>
    </tr>
    </tbody>
</table>
<div class="blank10">&nbsp;</div>
<?php include_once 'inc/cl_file.php'; ?>
</body>
</html>