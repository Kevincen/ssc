<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'templates_cn/offGamepk.php';
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
$_SESSION['nc'] = false;
$_SESSION['jsk3'] = false;
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
$sub_type = "两面盘";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/sGame.css"/>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="./js/sc.js"></script>
    <script type="text/javascript" src="./js/odds_sm_pk.js"></script>
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
<form id="dp" action="" method="post" target="leftFrame" >
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div class="actiionn">

</div>
    <div class="mains_corll">

    <div id="rightLoader" dom="right" style="">
            <div id="bothSides_pk10" class="bothSides">
                <div class="betAreaBox">
                    <?php include_once './game_header.php' ?>
                    <div class="common"  >
                        <div id="bothBall" class="pktouzhuArea">
                            <table class="w100 t1 touzhuArea wqs">
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
                                    <th colspan="12"> 冠、亚军和</th>
                                </tr>
                                </tbody>
                                <tbody>
                                <tr>
                                    <td class="fontBlue huiseBg caption_1">冠亚大</td>
                                    <td playtype="035" number="0" class="huiseBg o" id="kh1"></td>
                                    <td class="amount huiseBg tt" id="t12_h1"><input type="text" class="amount-input" maxlength="9"
                                                                      disabled="disabled"></td>
                                    <td class="fontBlue huiseBg caption_1">冠亚小</td>
                                    <td playtype="035" number="1" class="huiseBg o" id="kh2"></td>
                                    <td class="amount huiseBg tt" id="t12_h2"><input type="text" class="amount-input" maxlength="9"
                                                                      disabled="disabled"></td>
                                    <td class="fontBlue huiseBg caption_1">冠亚单</td>
                                    <td playtype="036" number="0" class="huiseBg o" id="kh3"></td>
                                    <td class="amount huiseBg tt" id="t12_h3"><input type="text" class="amount-input" maxlength="9"
                                                                      disabled="disabled"></td>
                                    <td class="fontBlue huiseBg caption_1">冠亚双</td>
                                    <td playtype="036" number="1" class="huiseBg o" id="kh4"></td>
                                    <td class="amount huiseBg tt" id="t12_h4"><input type="text" class="amount-input" maxlength="9"
                                                                      disabled="disabled"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pktouzhuArea">
                            <table class="w100">
                                <tbody>
                                <tr>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">冠军</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="ah11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h11">
                                                    <input type="text" class="amount-input"
                                                           maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="ah12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h12">
                                                    <input type="text" class="amount-input"
                                                           maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="ah13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h13">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="ah14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h14">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">龙</td>
                                                <td id="ah15" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h15">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">虎</td>
                                                <td id="ah16" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t1_h16">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">亚军</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="bh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h11">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="bh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h12">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="bh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h13">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="bh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h14">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">龙</td>
                                                <td id="bh15" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h15">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">虎</td>
                                                <td id="bh16" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t2_h16"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第三名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="ch11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h11">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="ch12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h12">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="ch13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h13">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="ch14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h14">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">龙</td>
                                                <td id="ch15" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h15">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">虎</td>
                                                <td id="ch16" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t3_h16">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第四名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="dh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="dh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h12">
                                                    <input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="dh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="dh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">龙</td>
                                                <td id="dh15" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h15"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">虎</td>
                                                <td id="dh16" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t4_h16"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第五名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="eh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="eh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="eh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="eh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">龙</td>
                                                <td id="eh15" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h15"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">虎</td>
                                                <td id="eh16" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t5_h16"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pktouzhuArea">
                            <table class="w100">
                                <tbody>
                                <tr>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第六名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="fh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t6_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="fh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t6_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="fh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t6_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="fh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t6_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第七名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="gh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t7_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="gh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t7_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="gh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t7_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="gh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t7_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第八名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="hh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t8_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="hh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t8_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="hh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t8_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="hh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t8_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第九名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="ih11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t9_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="ih12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t9_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="ih13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t9_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="ih14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t9_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="w20">
                                        <table class="w99 t1 touzhuArea">
                                            <colgroup>
                                                <col class="col_single w25">
                                                <col class="w33">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th colspan="3">第十名</th>
                                            </tr>
                                            </tbody>
                                            <tbody>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">大</td>
                                                <td id="jh11" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t10_h11"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">小</td>
                                                <td id="jh12" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t10_h12"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">单</td>
                                                <td id="jh13" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t10_h13"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fontBlue huiseBg caption_1">双</td>
                                                <td id="jh14" class="huiseBg o"></td>
                                                <td class="amount huiseBg tt" id="t10_h14"><input type="text" class="amount-input"
                                                                                  maxlength="9" disabled="disabled">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
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
                                    <div id="td_input_money1" style="display: none">
                                        <strong class="t kuaijie">金额</strong>
                                        <span id="bulk-amount-input" class="kuaijie">
                                            <input type="text" class="elem_amount_input elem_amount_input_quick"
                                                   name="" maxlength="9" id="AllMoney1">
                                        </span>
                                    </div>
                                    <a class="btn_m elem_btn" id="submit_top" onclick="submitforms()">确 定</a>
                                    <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
                            </td>
                            <td width="30%" class="align-r"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="ballqueue-module paihang">
                        <table class="w100 t1 dataArea" id="firstball" cat="" play="bothSides_pk10">
                            <tbody>
                            <tr>
                                <th class="kon bq-title" cat="15" <?php echo $onclick?>>冠、亚军和</th>
                                <th class="bq-title" cat="13" <?php echo $onclick?>>冠、亚军和 大小</th>
                                <th class="bq-title" cat="14" <?php echo $onclick?>>冠、亚军和 单双</th>
                            </tr>
                            </tbody>
                        </table>
                        <table class="w100 t1 t-td-w4 align-c">
                            <tbody>
                            <tr class="ballqueue_result" id="z_cl">
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                                <td class=""></td>
                                <td class="line-gradient"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="changlongbox">
                    <?php include_once 'inc/cl_file.php';?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include './popup.html'?>
</div>
</body>
</html>