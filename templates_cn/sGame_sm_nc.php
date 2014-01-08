<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'templates/offGamenc.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_mix_money`");
//if ($ConfigModel['g_nc_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['pk'] = false;
$_SESSION['jsk3'] = false;
$_SESSION['gd'] = false;
$_SESSION['nc'] = true;
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

$gametype = "幸运农场";
$sub_type = "两面盘";
$number_type = "nc"


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
    <script type="text/javascript" src="./js/odds_sm_nc.js"></script>
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
    <div class="mains_corll">
    <form id="dp" action="" method="post" target="leftFrame" >
    <input type="hidden" name="actions" value="fn3" />
    <input type="hidden" name="gtypes" value="1" />
    <input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
    <div class="actiionn"></div>
    <div id="rightLoader" dom="right" style="">
        <div id="bothSides_nc" class="bothSides">
            <div class="betAreaBox nc">
                <?php include_once './game_header.php' ?>
                <div class="common" id="common_div" style="display: block;">
                    <div class="klctouzhuArea">
                        <table class="w100 touzhuArea t1 wqs_top">
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
                            </colgroup>
                            <tbody>
                            <tr>
                                <th colspan="9">总和</th>
                            </tr>
                            </tbody>
                            <tbody>
                            <tr>
                                <td class="fontBlue huiseBg caption_1">总和大</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h1"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h1" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                                <td class="fontBlue huiseBg caption_1">总和单</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h2"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h2" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                                <td class="fontBlue huiseBg caption_1">总和尾大</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h5"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h3" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                            </tr>
                            <tr>
                                <td class="fontBlue huiseBg caption_1">总和小</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h3"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h5" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                                <td class="fontBlue huiseBg caption_1">总和双</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h4"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h6" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                                <td class="fontBlue huiseBg caption_1">总和尾小</td>
                                <td playtype="041" number="31" class="huiseBg o" id="h7"></td>
                                <td class="amount huiseBg loads">
                                    <input name="k1_h7" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="klctouzhuArea">
                        <table class="w100">
                            <tbody>
                            <tr>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第一球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah21"></td>
                                            <td class="amount huiseBg loads">
                                                <input name="t1_h21" class="inp1" onkeyup="digitOnly(this)" onfocus="this.className='inp1m'" onblur="this.className='inp1';" type="text" maxlength="9">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ah28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">龙</td>
                                            <td playtype="059" number="42" class="huiseBg o" id="ah29"></td>
                                            <td class="amount huiseBg loads"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">虎</td>
                                            <td playtype="059" number="43" class="huiseBg o" id="ah30"></td>
                                            <td class="amount huiseBg loads"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第二球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="bh28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">龙</td>
                                            <td playtype="059" number="42" class="huiseBg o" id="bh29"></td>
                                            <td class="amount huiseBg loads"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">虎</td>
                                            <td playtype="059" number="43" class="huiseBg o" id="bh30"></td>
                                            <td class="amount huiseBg loads"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99">
                                        <colgroup>
                                            <col class="col_single w33 wqs">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第三球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="ch28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">龙</td>
                                            <td playtype="059" number="42" class="huiseBg o" id="ch29"></td>
                                            <td class="amount huiseBg loads" id="ch29"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">虎</td>
                                            <td playtype="059" number="43" class="huiseBg o" id="ch30"></td>
                                            <td class="amount huiseBg loads" id="ch30"><input type="text" class="amount-input"
                                                                              maxlength="9" disabled="disabled"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第四球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="dh28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">龙</td>
                                            <td playtype="059" number="42" class="huiseBg o" id="dh29"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">虎</td>
                                            <td playtype="059" number="43" class="huiseBg o" id="dh30"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="klctouzhuArea">
                        <table class="w100">
                            <tbody>
                            <tr>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第五球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="eh28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第六球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="fh28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第七球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="gh28"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="w25">
                                    <table class="t1 touzhuArea w99 wqs">
                                        <colgroup>
                                            <col class="col_single w33">
                                            <col class="w33">
                                            <col class="w33">
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th colspan="3">第八球</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh21"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh22"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh23"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh24"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾大</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh25"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">尾小</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh26"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数单</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh27"></td>
                                            <td class="amount huiseBg loads"></td>
                                        </tr>
                                        <tr>
                                            <td class="fontBlue huiseBg caption_1">合数双</td>
                                            <td playtype="041" number="31" class="huiseBg o" id="hh28"></td>
                                            <td class="amount huiseBg loads"></td>
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
                                <div id="td_input_money1" style="display: inline">
                                    <strong class="t kuaijie" >金额</strong>
                                    <span id="bulk-amount-input " class="kuaijie" >
                                        <input type="text" class="elem_amount_input elem_amount_input_quick" name=""
                                               maxlength="9" id="AllMoney1" >
                                    </span>
                                </div>
                                <a href="javascript:void(0)" onclick="submitforms()" class="btn_m elem_btn" id="submit">确 定</a>
                                <a href="javascript:void(0)" class="btn_m elem_btn" id="reset">重 置</a></div>
                        </td>
                        <td width="30%" class="align-r"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="ballqueue-module paihang">
                    <table class="dataArea t1 w100" id="firstball" cat="" play="bothSides_nc">
                        <tbody>
                        <tr>
                            <th class="bq-title kon" cat="13" <?php echo $onclick?>>总和大小</th>
                            <th class="bq-title" cat="12" <?php echo $onclick?>>总和单双</th>
                            <th class="bq-title" cat="14" <?php echo $onclick?>>总和尾数大小</th>
                            <!-- <th class='bq-title' cat='17'>龙虎</th>     --></tr>
                        </tbody>
                    </table>
                    <table class="t1 w100 t-td-w4 align-c">
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
                            <td class=""><p>小</p></td>
                            <td class="line-gradient"><p>大</p></td>
                            <td class=""><p>小</p></td>
                            <td class="line-gradient"><p>大</p>

                                <p>大</p>

                                <p>大</p></td>
                            <td class=""><p>和</p></td>
                            <td class="line-gradient"><p>小</p></td>
                            <td class=""><p>大</p>

                                <p>大</p></td>
                            <td class="line-gradient"><p>小</p>

                                <p>小</p>

                                <p>小</p></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="changlongbox">
                <table style="" class="bet-table changlong-table dataArea w100 t1" id="cl">
                    <tbody>
                    <tr>
                        <th colspan="2">两面长龙排行</th>
                    </tr>
                    </tbody>
                    <tbody id="changlong">
                    <tr>
                        <td colspan="2">暂无数据</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </form>
    <?php include './popup.html' ?>
</div>
</div>
</body>
</html>
