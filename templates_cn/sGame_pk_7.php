<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'templates/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] != 1) exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);
$_SESSION['cq'] = false;
$_SESSION['gx'] = false;
$_SESSION['jx'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = true;


$g = $_GET['g'];
$abc = $_GET['abc'];
if ($abc == null) {
    $abc = $result[0]['g_panlu'];
} else {
    $sql = "update g_user set g_panlu='$abc' where g_name='$name'";
    $result1 = $db->query($sql, 2);
}

$gametype = "北京赛车(PK10)";
$sub_type = "6 ~ 10";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="css/sGame.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="./js/sc.js"></script>
    <script type="text/javascript" src="./js/odds_7_pk.js"></script>
    <title></title>
    <script type="text/javascript">
        var s = window.parent.frames.leftFrame.location.href.split('/');
        s = s[s.length - 1];
        if (s !== "left.php")
            window.parent.frames.leftFrame.location.href = "/templates/left.php";


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
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" name="actions" value="fn3"/>
<input type="hidden" name="gtypes" value="1"/>
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money'] ?>"/>

<div class="actiionn">

</div>
<div class="betAreaBox">
<?php include_once './game_header.php' ?>
<div class="common pk10 ssctouzhuArea">
<table class="w100">
<tbody>
<tr>
<td class="w20">
    <table class="t1 touzhuArea w99 wqs">
        <colgroup>
            <col class="col_single w20">
            <col class="w33">
            <col class="w33">
        </colgroup>
        <thead>
        <tr>
            <th colspan="3"><b>第六名</b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fontBlue caption_1">大</td>
            <td class="o" id="fh11"></td>
            <td class="amount tt" id="t11"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">小</td>
            <td class="o" id="fh12"></td>
            <td class="amount tt" id="t12"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">单</td>
            <td class="o" id="fh13"></td>
            <td class="amount tt" id="t13"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">双</td>
            <td class="o" id="fh14"></td>
            <td class="amount tt" id="t14"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num1"></span></td>
            <td class="o" id="fh1"></td>
            <td class="amount tt" id="t1"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num2"></span></td>
            <td class="o" id="fh2"></td>
            <td class="amount tt" id="t2"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num3"></span></td>
            <td class="o" id="fh3"></td>
            <td class="amount tt" id="t3"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num4"></span></td>
            <td class="o" id="fh4"></td>
            <td class="amount tt" id="t4"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num5"></span></td>
            <td class="o" id="fh5"></td>
            <td class="amount tt" id="t5"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num6"></span></td>
            <td class="o" id="fh6"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num7"></span></td>
            <td class="o" id="fh7"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num8"></span></td>
            <td class="o" id="fh8"></td>
            <td class="amount tt" id="t7"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num9"></span></td>
            <td class="o" id="fh9"></td>
            <td class="amount tt" id="t9"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num10"></span></td>
            <td class="o" id="fh10"></td>
            <td class="amount tt" id="t10"></td>
        </tr>
        </tbody>
    </table>
</td>
<td class="w20">
    <table class="t1 touzhuArea w99 wqs">
        <colgroup>
            <col class="col_single w20">
            <col class="w33">
            <col class="w33">
        </colgroup>
        <thead>
        <tr>
            <th colspan="3"><b>第七名</b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fontBlue caption_1">大</td>
            <td class="o" id="gh11"></td>
            <td class="amount tt" id="t11"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">小</td>
            <td class="o" id="gh12"></td>
            <td class="amount tt" id="t12"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">单</td>
            <td class="o" id="gh13"></td>
            <td class="amount tt" id="t13"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">双</td>
            <td class="o" id="gh14"></td>
            <td class="amount tt" id="t14"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num1"></span></td>
            <td class="o" id="gh1"></td>
            <td class="amount tt" id="t1"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num2"></span></td>
            <td class="o" id="gh2"></td>
            <td class="amount tt" id="t2"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num3"></span></td>
            <td class="o" id="gh3"></td>
            <td class="amount tt" id="t3"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num4"></span></td>
            <td class="o" id="gh4"></td>
            <td class="amount tt" id="t4"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num5"></span></td>
            <td class="o" id="gh5"></td>
            <td class="amount tt" id="t5"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num6"></span></td>
            <td class="o" id="gh6"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num7"></span></td>
            <td class="o" id="gh7"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num8"></span></td>
            <td class="o" id="gh8"></td>
            <td class="amount tt" id="t7"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num9"></span></td>
            <td class="o" id="gh9"></td>
            <td class="amount tt" id="t9"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num10"></span></td>
            <td class="o" id="gh10"></td>
            <td class="amount tt" id="t10"></td>
        </tr>
        </tbody>
    </table>
</td>
<td class="w20">
    <table class="t1 touzhuArea w99 wqs">
        <colgroup>
            <col class="col_single w20">
            <col class="w33">
            <col class="w33">
        </colgroup>
        <thead>
        <tr>
            <th colspan="3"><b>第八名</b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fontBlue caption_1">大</td>
            <td class="o" id="hh11"></td>
            <td class="amount tt" id="t11"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">小</td>
            <td class="o" id="hh12"></td>
            <td class="amount tt" id="t12"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">单</td>
            <td class="o" id="hh13"></td>
            <td class="amount tt" id="t13"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">双</td>
            <td class="o" id="hh14"></td>
            <td class="amount tt" id="t14"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num1"></span></td>
            <td class="o" id="hh1"></td>
            <td class="amount tt" id="t1"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num2"></span></td>
            <td class="o" id="hh2"></td>
            <td class="amount tt" id="t2"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num3"></span></td>
            <td class="o" id="hh3"></td>
            <td class="amount tt" id="t3"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num4"></span></td>
            <td class="o" id="hh4"></td>
            <td class="amount tt" id="t4"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num5"></span></td>
            <td class="o" id="hh5"></td>
            <td class="amount tt" id="t5"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num6"></span></td>
            <td class="o" id="hh6"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num7"></span></td>
            <td class="o" id="hh7"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num8"></span></td>
            <td class="o" id="hh8"></td>
            <td class="amount tt" id="t7"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num9"></span></td>
            <td class="o" id="hh9"></td>
            <td class="amount tt" id="t9"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num10"></span></td>
            <td class="o" id="hh10"></td>
            <td class="amount tt" id="t10"></td>
        </tr>
        </tbody>
    </table>
</td>
<td class="w20">
    <table class="t1 touzhuArea w99 wqs">
        <colgroup>
            <col class="col_single w20">
            <col class="w33">
            <col class="w33">
        </colgroup>
        <thead>
        <tr>
            <th colspan="3"><b>第九名</b></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fontBlue caption_1">大</td>
            <td class="o" id="ih11"></td>
            <td class="amount tt" id="t11"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">小</td>
            <td class="o" id="ih12"></td>
            <td class="amount tt" id="t12"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">单</td>
            <td class="o" id="ih13"></td>
            <td class="amount tt" id="t13"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">双</td>
            <td class="o" id="ih14"></td>
            <td class="amount tt" id="t14"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num1"></span></td>
            <td class="o" id="ih1"></td>
            <td class="amount tt" id="t1"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num2"></span></td>
            <td class="o" id="ih2"></td>
            <td class="amount tt" id="t2"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num3"></span></td>
            <td class="o" id="ih3"></td>
            <td class="amount tt" id="t3"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num4"></span></td>
            <td class="o" id="ih4"></td>
            <td class="amount tt" id="t4"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num5"></span></td>
            <td class="o" id="ih5"></td>
            <td class="amount tt" id="t5"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num6"></span></td>
            <td class="o" id="ih6"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num7"></span></td>
            <td class="o" id="ih7"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num8"></span></td>
            <td class="o" id="ih8"></td>
            <td class="amount tt" id="t7"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num9"></span></td>
            <td class="o" id="ih9"></td>
            <td class="amount tt" id="t9"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num10"></span></td>
            <td class="o" id="ih10"></td>
            <td class="amount tt" id="t10"></td>
        </tr>
        </tbody>
    </table>
</td>
<td class="w20">
    <table class="t1 touzhuArea w99 wqs">
        <colgroup>
            <col class="col_single w20">
            <col class="w33">
            <col class="w33">
        </colgroup>
        <thead>
        <tr>
            <th colspan="3">第十名</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="fontBlue caption_1">大</td>
            <td class="o" id="jh11"></td>
            <td class="amount tt" id="t11"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">小</td>
            <td class="o" id="jh12"></td>
            <td class="amount tt" id="t12"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">单</td>
            <td class="o" id="jh13"></td>
            <td class="amount tt" id="t13"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1">双</td>
            <td class="o" id="jh14"></td>
            <td class="amount tt" id="t14"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num1"></span></td>
            <td class="o" id="jh1"></td>
            <td class="amount tt" id="t1"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num2"></span></td>
            <td class="o" id="jh2"></td>
            <td class="amount tt" id="t2"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num3"></span></td>
            <td class="o" id="jh3"></td>
            <td class="amount tt" id="t3"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num4"></span></td>
            <td class="o" id="jh4"></td>
            <td class="amount tt" id="t4"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num5"></span></td>
            <td class="o" id="jh5"></td>
            <td class="amount tt" id="t5"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num6"></span></td>
            <td class="o" id="jh6"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num7"></span></td>
            <td class="o" id="jh7"></td>
            <td class="amount tt" id="t6"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num8"></span></td>
            <td class="o" id="jh8"></td>
            <td class="amount tt" id="t7"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num9"></span></td>
            <td class="o" id="jh9"></td>
            <td class="amount tt" id="t9"></td>
        </tr>
        <tr>
            <td class="fontBlue caption_1"><span class="number num10"></span></td>
            <td class="o" id="jh10"></td>
            <td class="amount tt" id="t10"></td>
        </tr>
        </tbody>
    </table>
</td>
</tr>
</tbody>
</table>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
    <tbody>
    <tr>
        <td width="25%">
            <div class="elem_selected bulk-amount-times hide" style="display: none;">已经选中<span id="selectedAmount"
                                                                                               class="amount">5</span>注
            </div>
        </td>
        <td width="45%" class="align-c">
            <div id="td_input_money1" style="display:none">
                <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
            </div>
            <a class="btn_m elem_btn" id="submit_top" onclick="submitforms()">确 定</a>
            <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a>
        </td>
        <td width="30%" class="align-r"></td>
    </tr>
    </tbody>
</table>
</div>
</form>
<?php include './popup.html' ?>
</div>
</body>

</html>