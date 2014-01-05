<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'templates/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] != 1) exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
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
$sub_type = "冠亚军组合";


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
    <script type="text/javascript" src="./js/odds_zh_pk.js"></script>
    <title></title>
    <script type="text/javascript">
        var s = window.parent.frames.leftFrame.location.href.split('/');
        s = s[s.length - 1];
        if (s !== "left.php")
            window.parent.frames.leftFrame.location.href = "/templates_cn/left.php?type=北京赛车PK10";
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
<div id="rightLoader" dom="right" style="">
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div class="actiionn">

</div>
    <div id="sumDT_pk10">
        <div class="betAreaBox">
        <?php include_once './game_header.php' ?>
            <div class="common">
                <table class="w100 t1 touzhuArea wqs">
                    <colgroup>
                        <col class="col_single w4">
                        <col class="w9">
                        <col class="w9">
                        <col class="col_single w4">
                        <col class="w9">
                        <col class="w9">
                        <col class="col_single w4">
                        <col class="w9">
                        <col class="w9">
                        <col class="col_single w4">
                        <col class="w9">
                        <col class="w9">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="12">冠、亚军和(冠军车号 + 亚军车号 = 和)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">3</td>
                        <td class="o" id="lh1"></td>
                        <td class="amount tt" id="t11_h1"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">4</td>
                        <td class="o" id="lh2"></td>
                        <?php //todo:所有的球号都要加caption_1 ?>
                        <td class="amount tt" id="t11_h2"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1" >5</td>
                        <td class="o" id="lh3"></td>
                        <td class="amount tt" id="t11_h3"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">6</td>
                        <td class="o" id="lh4"></td>
                        <td class="amount tt" id="t11_h4"><input type="text" class="amount-input" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">7</td>
                        <td class="o" id="lh5"></td>
                        <td class="amount tt" id="t11_h5"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">8</td>
                        <td class="o" id="lh6"></td>
                        <td class="amount tt" id="t11_h6"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">9</td>
                        <td class="o" id="lh7"></td>
                        <td class="amount tt" id="t11_h7"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">10</td>
                        <td class="o" id="lh8"></td>
                        <td class="amount tt" id="t11_h8"><input type="text" class="amount-input" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">11</td>
                        <td class="o" id="lh9"></td>
                        <td class="amount tt" id="t11_h9"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">12</td>
                        <td class="o" id="lh10"></td>
                        <td class="amount tt" id="t11_h10"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">13</td>
                        <td class="o" id="lh11"></td>
                        <td class="amount tt" id="t11_h11"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">14</td>
                        <td class="o" id="lh12"></td>
                        <td class="amount tt" id="t11_h12"><input type="text" class="amount-input" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">15</td>
                        <td class="o" id="lh13"></td>
                        <td class="amount tt" id="t11_h13"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">16</td>
                        <td class="o" id="lh14"></td>
                        <td class="amount tt" id="t11_h14"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">17</td>
                        <td class="o" id="lh15"></td>
                        <td class="amount tt" id="t11_h15"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">18</td>
                        <td class="o" id="lh16"></td>
                        <td class="amount tt" id="t11_h16"><input type="text" class="amount-input" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">19</td>
                        <td class="o" id="lh17"></td>
                        <td class="amount tt" id="t11_h17"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t"></td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class="fontBlue  ballno-t-t"></td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class="fontBlue  ballno-t-t"></td>
                        <td class=""></td>
                        <td class=""></td>
                    </tr>
                    <tr>
                        <td class="fontBlue  ballno-t-t caption_1">冠亚大</td>
                        <td class="o" id="kh1"></td>
                        <td class="amount tt" id="t12_h1"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">冠亚小</td>
                        <td class="o" id="kh2"></td>
                        <td class="amount tt" id="t12_h2"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">冠亚单</td>
                        <td class="o" id="kh3"></td>
                        <td class="amount tt" id="t12_h4"><input type="text" class="amount-input" maxlength="9"></td>
                        <td class="fontBlue  ballno-t-t caption_1">冠亚双</td>
                        <td class="o" id="kh5"></td>
                        <td class="amount tt" id="t12_h5"><input type="text" class="amount-input" maxlength="9"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
                <tbody>
                <tr>
                    <td width="25%">
                        <div class="elem_selected bulk-amount-times hide" style="display: none;">已经选中<span
                                id="selectedAmount" class="amount">5</span>注
                        </div>
                    </td>
                    <td width="45%" class="align-c">
                        <div class="elem_amount">
                            <div id="td_input_money1" style="display: none">
                                <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney1" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
                            </div>
                            <a class="btn_m elem_btn" id="submit_top" onclick="submitforms()">确 定</a>
                            <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
                    </td>
                    <td width="30%" class="align-r">
                        <div class="elem_multiple" style="visibility: hidden;"><input name="" id="beishu"
                                                                                      type="checkbox"><label
                                class="label t" for="beishu">&nbsp;倍数</label><input disabled="disabled" value="100"
                                                                                    name="beishu" id="beishu100"
                                                                                    checked="checked" class="beisx"
                                                                                    type="radio"><label class="label"
                                                                                                        for="beishu100">百倍</label><input
                                disabled="disabled" value="1000" name="beishu" id="beishu1000" class="beisx"
                                type="radio"><label class="label" for="beishu1000">千倍</label><input disabled="disabled"
                                                                                                    value="10000"
                                                                                                    name="beishu"
                                                                                                    id="beishu10000"
                                                                                                    class="beisx"
                                                                                                    type="radio"><label
                                class="label" for="beishu10000">万倍</label></div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="ballqueue-module paihang">
                <table class="w100 t1 dataArea longhu-tb" id="firstball" cat="" play="sumDT_pk10">
                    <tbody>
                    <tr>
                        <th class="bq-title kon nv" cat="15" <?php echo $onclick?>>冠、亚军和</th>
                        <th class="bq-title nv" cat="13" <?php echo $onclick?>>冠、亚军和 大小</th>
                        <th class="bq-title nv" cat="14" <?php echo $onclick?>>冠、亚军和 单双</th>
                    </tr>
                    </tbody>
                </table>
                <table class="w100 t1 t-td-w4 align-c" >
                    <tbody>
                    <tr class="ballqueue_result" id="z_cl">
                        <td class="line-gradient"><p>11</p></td>
                        <td class=""><p>13</p></td>
                        <td class="line-gradient"><p>16</p></td>
                        <td class=""><p>14</p></td>
                        <td class="line-gradient"><p>13</p></td>
                        <td class=""><p>10</p></td>
                        <td class="line-gradient"><p>8</p></td>
                        <td class=""><p>17</p></td>
                        <td class="line-gradient"><p>9</p></td>
                        <td class=""><p>10</p></td>
                        <td class="line-gradient"><p>14</p></td>
                        <td class=""><p>5</p></td>
                        <td class="line-gradient"><p>17</p></td>
                        <td class=""><p>11</p></td>
                        <td class="line-gradient"><p>13</p></td>
                        <td class=""><p>7</p></td>
                        <td class="line-gradient"><p>11</p></td>
                        <td class=""><p>13</p></td>
                        <td class="line-gradient"><p>11</p></td>
                        <td class=""><p>19</p></td>
                        <td class="line-gradient"><p>5</p></td>
                        <td class=""><p>8</p></td>
                        <td class="line-gradient"><p>11</p></td>
                        <td class=""><p>3</p></td>
                        <td class="line-gradient"><p>14</p></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="changlongbox">
            <?php include_once 'inc/cl_file.php';?>
        </div>
    </div>
<?php include './popup.html' ?>
</form>
</div>
</body>
</html>