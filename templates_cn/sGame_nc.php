<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_game_nc_1`, `g_game_nc_2`, `g_game_nc_3`, `g_game_nc_4`, `g_game_nc_5`, `g_game_nc_6`, `g_game_nc_7`, `g_game_nc_8`");
//if ($ConfigModel['g_nc_game_lock'] !=1)
//exit(href('right.php'));
$g = $_GET['g'];
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" ' . $onclick;

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


//$abc = $_GET['abc'];
//if($abc==null) $abc=$pan[0];
//$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
//$result1 = $db->query($sql, 2);

switch ($g) {
    case 'g1':
        if ($ConfigModel['g_game_nc_1'] != 1) exit(href('right.php'));
        $types = '第一球';
        $aHtml = '<a ' . $getResult . '>第1球</a>';
        break;
    case 'g2':
        if ($ConfigModel['g_game_nc_2'] != 1) exit(href('right.php'));
        $types = '第二球';
        $aHtml = '<a ' . $getResult . '>第2球</a>';
        break;
    case 'g3':
        if ($ConfigModel['g_game_nc_3'] != 1) exit(href('right.php'));
        $types = '第三球';
        $aHtml = '<a ' . $getResult . '>第3球</a>';
        break;
    case 'g4':
        if ($ConfigModel['g_game_nc_4'] != 1) exit(href('right.php'));
        $types = '第四球';
        $aHtml = '<a ' . $getResult . '>第4球</a>';
        break;
    case 'g5':
        if ($ConfigModel['g_game_nc_5'] != 1) exit(href('right.php'));
        $types = '第五球';
        $aHtml = '<a ' . $getResult . '>第5球</a>';
        break;
    case 'g6':
        if ($ConfigModel['g_game_nc_6'] != 1) exit(href('right.php'));
        $types = '第六球';
        $aHtml = '<a ' . $getResult . '>第6球</a>';
        break;
    case 'g7':
        if ($ConfigModel['g_game_nc_7'] != 1) exit(href('right.php'));
        $types = '第七球';
        $aHtml = '<a ' . $getResult . '>第7球</a>';
        break;
    case 'g8':
        if ($ConfigModel['g_game_nc_8'] != 1) exit(href('right.php'));
        $types = '第八球';
        $aHtml = '<a ' . $getResult . '>第8球</a>';
        break;
    default:
        exit;
}
$gametype = "幸运农场";
$sub_type = $types;
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
    <script type="text/javascript" src="./js/funcions_nc.js"></script>
    <script type="text/javascript" src="./js/sGame_nc.js"></script>
    <title></title>
    <script type="text/javascript">
        var s = window.parent.frames.leftFrame.location.href.split("/");
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
<form id="dp" action="" method="post" target="leftFrame">
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money'] ?>">

<div id="look" style="display:none"></div>
<input type="hidden" name="actions" value="fn1"/>
<input type="hidden" name="gtypes" value="1" />
<div class="actiionn"></div>
<div id="tys" style="display: none"><?php echo $types ?></div>
<div id="rightLoader" dom="right" style="">
<div id="ballNO_nc" area="ball1">
<div class="betAreaBox nc">
<?php include_once './game_header.php' ?>
<div class="common">
    <div class="klctouzhuArea">
        <table class="struct_table ballno-tab touzhuArea w100 t1 wqs">
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
            <thead>
            <tr>
                <th>号码</th>
                <th>赔率</th>
                <th class="tt">金额</th>
                <th>号码</th>
                <th>赔率</th>
                <th class="tt">金额</th>
                <th>号码</th>
                <th>赔率</th>
                <th class="tt">金额</th>
                <th>号码</th>
                <th>赔率</th>
                <th class="tt">金额</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="caption_1"><span class="number num1"></span></td>
                <td playtype="000" number="01" class="o" id="h1">19.87</td>
                <td class="amount tt" id="t1"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num6"></span></td>
                <td playtype="000" number="06" class="o" id="h6">19.87</td>
                <td class="amount tt" id="t6"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num11"></span></td>
                <td playtype="000" number="11" class="o" id="h11">19.87</td>
                <td class="amount tt" id="t11"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num16"></span></td>
                <td playtype="000" number="16" class="o" id="h16">19.87</td>
                <td class="amount tt" id="t16"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="caption_1"><span class="number num2"></span></td>
                <td playtype="000" number="02" class="o" id="h2">19.87</td>
                <td class="amount tt" id="t2"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num7"></span></td>
                <td playtype="000" number="07" class="o" id="h7">19.87</td>
                <td class="amount tt" id="t7"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num12"></span></td>
                <td playtype="000" number="12" class="o" id="h12">19.87</td>
                <td class="amount tt" id="t12"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num17"></span></td>
                <td playtype="000" number="17" class="o" id="h17">19.87</td>
                <td class="amount tt" id="t17"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="caption_1"><span class="number num3"></span></td>
                <td playtype="000" number="03" class="o" id="h3">19.87</td>
                <td class="amount tt" id="t3"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num8"></span></td>
                <td playtype="000" number="08" class="o" id="h8">19.87</td>
                <td class="amount tt" id="t8"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num13"></span></td>
                <td class="o" id="h13">19.87</td>
                <td class="amount tt" id="t13"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num18"></span></td>
                <td class="o" id="h18">19.87</td>
                <td class="amount tt" id="t18"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="caption_1"><span class="number num4"></span></td>
                <td class="o" id="h4">19.87</td>
                <td class="amount tt" id="t4"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num9"></span></td>
                <td class="o" id="h9">19.87</td>
                <td class="amount tt" id="t9"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num14"></span></td>
                <td class="o" id="h14">19.87</td>
                <td class="amount tt" id="t14"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num19"></span></td>
                <td class="o" id="h19">19.87</td>
                <td class="amount tt" id="t19"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="caption_1"><span class="number num5"></span></td>
                <td class="o" id="h5">19.87</td>
                <td class="amount tt" id="t5"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num10"></span></td>
                <td class="o" id="h10">19.87</td>
                <td class="amount tt" id="t15"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num15"></span></td>
                <td class="o" id="h15">19.87</td>
                <td class="amount tt" id="t15"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="caption_1"><span class="number num20"></span></td>
                <td class="o" id="h20">19.87</td>
                <td class="amount tt" id="t20"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="klctouzhuArea klctouzhuArea_fix">
        <table class="struct_table ballno-tab touzhuArea w100 t1 wqs" frame="box" cellpadding="1">
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
                <td class="fontBlue  ballno-t-t caption_1">大</td>
                <td class="o" id="h21">1.987</td>
                <td class="amount tt" id="t21"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">单</td>
                <td class="o" id="h23">1.987</td>
                <td class="amount tt" id="t23"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">尾大</td>
                <td class="o" id="h25">1.987</td>
                <td class="amount tt" id="t25"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">合数单</td>
                <td class="o" id="h27">1.987</td>
                <td class="amount tt" id="t27"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="fontBlue  ballno-t-t caption_1">小</td>
                <td class="o" id="h22">1.987</td>
                <td class="amount tt" id="t22"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">双</td>
                <td class="o" id="h24">1.987</td>
                <td class="amount tt" id="t24"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">尾小</td>
                <td class="o" id="h26">1.987</td>
                <td class="amount tt" id="t26"><input class="amount-input" maxlength="9" type="text"></td>
                <td class="fontBlue  ballno-t-t caption_1">合数双</td>
                <td class="o" id="h28">1.987</td>
                <td class="amount tt" id="t28"><input class="amount-input" maxlength="9" type="text"></td>
            </tr>
            <tr>
                <td class="fontBlue  ballno-t-t caption_1">东</td>
                <td class="o" id="h29">3.89</td>
                <td class="amount tt" id="t29"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">南</td>
                <td class="o" id="h30">3.89</td>
                <td class="amount tt" id="t30"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">西</td>
                <td class="o" id="h31">3.89</td>
                <td class="amount tt" id="t31"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">北</td>
                <td class="o" id="h32">3.89</td>
                <td class="amount tt" id="t32"><input type="text" class="amount-input" maxlength="9"></td>
            </tr>
            <tr>
                <td class="fontBlue  ballno-t-t caption_1">中</td>
                <td class="o" id="h33">2.8</td>
                <td class="amount tt" id="t33"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">发</td>
                <td class="o" id="h34">2.8</td>
                <td class="amount tt" id="t34"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">白</td>
                <td class="o" id="h35">3</td>
                <td class="amount tt" id="t35"><input type="text" class="amount-input" maxlength="9"></td>
                <td class=""></td>
                <td class=""></td>
                <td class="tt"></td>
            </tr>
            <?php if ($g == 'g1' || $g=='g2'||$g=='g3' ||$g=='g4') { ?>
            <tr id="1-4longhu" style="">
                <td class="fontBlue  ballno-t-t caption_1">龙</td>
                <td playtype="059" number="42" class="o" id="h36">1.986</td>
                <td class="amount tt" id="t36"><input type="text" class="amount-input" maxlength="9"></td>
                <td class="fontBlue  ballno-t-t caption_1">虎</td>
                <td playtype="059" number="43" class="o" id="h37">1.987</td>
                <td class="amount tt" id="t37"><input type="text" class="amount-input" maxlength="9"></td>
                <td class=""></td>
                <td class=""></td>
                <td class="tt"></td>
                <td class=""></td>
                <td class=""></td>
                <td class="tt"></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
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
            <div id="td_input_money1" style="display: none;">
                <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
            </div>
            <a class="btn_m elem_btn" id="submit_bottom" onclick="submitforms()">确 定</a>
            <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
        </td>
        <td width="30%" class="align-r">
            <div class="elem_multiple" style="visibility: hidden;"><input name="" id="beishu"
                                                                          type="checkbox"><label
                    class="label t" for="beishu">&nbsp;倍数</label><input disabled="disabled"
                                                                        value="100" name="beishu"
                                                                        id="beishu100"
                                                                        checked="checked"
                                                                        class="beisx"
                                                                        type="radio"><label
                    class="label" for="beishu100">百倍</label><input disabled="disabled" value="1000"
                                                                   name="beishu" id="beishu1000"
                                                                   class="beisx" type="radio"><label
                    class="label" for="beishu1000">千倍</label><input disabled="disabled"
                                                                    value="10000" name="beishu"
                                                                    id="beishu10000" class="beisx"
                                                                    type="radio"><label
                    class="label" for="beishu10000">万倍</label></div>
        </td>
    </tr>
    </tbody>
</table>
<table class="struct_table ballno-tab t-td-w4 t1 dataArea align-c w100" id="rate"
       style="line-height:20px;">
    <tbody>
    <tr>
        <th><span>类型</span></th>
        <th>西瓜</th>
        <th>椰子</th>
        <th>榴莲</th>
        <th>柚子</th>
        <th>菠萝</th>
        <th>葡萄</th>
        <th>荔枝</th>
        <th>樱桃</th>
        <th>草莓</th>
        <th>番茄</th>
        <th>梨子</th>
        <th>苹果</th>
        <th>桃子</th>
        <th>柑橘</th>
        <th>冬瓜</th>
        <th>萝卜</th>
        <th>南瓜</th>
        <th>茄子</th>
        <th><span>家犬</span></th>
        <th><span>奶牛</span></th>
    </tr>
    <tr>
        <th><span>号码</span></th>
        <th>01</th>
        <th>02</th>
        <th>03</th>
        <th>04</th>
        <th>05</th>
        <th>06</th>
        <th>07</th>
        <th>08</th>
        <th>09</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>13</th>
        <th>14</th>
        <th>15</th>
        <th>16</th>
        <th>17</th>
        <th>18</th>
        <th><span>19</span></th>
        <th><span>20</span></th>
    </tr>
    <tr id="su">
        <td><span class="orange">冷热</span></td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>2</td>
        <td>0</td>
        <td>3</td>
        <td>2</td>
        <td>1</td>
        <td>2</td>
        <td>1</td>
        <td>3</td>
        <td>1</td>
        <td>3</td>
        <td>2</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>0</td>
        <td>2</td>
    </tr>
    <tr id="se">
        <td><span class="orange">遗漏</span></td>
        <td>0</td>
        <td>2</td>
        <td>1</td>
        <td>0</td>
        <td><span class="red fontweight">10</span></td>
        <td>2</td>
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>1</td>
        <td>0</td>
        <td>0</td>
        <td><span class="red fontweight">5</span></td>
        <td>1</td>
        <td>0</td>
        <td>3</td>
        <td>0</td>
        <td>0</td>
        <td>1</td>
        <td><span class="red fontweight">4</span></td>
    </tr>
    </tbody>
</table>
<div class="ballqueue-module paihang">
    <table class="w100 t1 dataArea">
        <tbody>
        <tr>
            <th class="bq-title kon" id="firstball" cat="00" play="ball_nc_1"><?php echo $aHtml?></th>
            <th class="bq-title" <?php echo $onclick?> cat="09">大小</th>
            <th class="bq-title" <?php echo $onclick?> cat="08">单双</th>
            <th class="bq-title" <?php echo $onclick?> cat="10">尾数大小</th>
            <th class="bq-title" <?php echo $onclick?> cat="11">合数单双</th>
            <th class="bq-title" <?php echo $onclick?> cat="16">东南西北</th>
            <th class="bq-title" <?php echo $onclick?> cat="15">中发白</th>
            <th class="bq-title" <?php echo $onclick?> cat="13">总和大小</th>
            <th class="bq-title" <?php echo $onclick?> cat="12">总和单双</th>
            <th class="bq-title" <?php echo $onclick?> cat="14">总和尾数大小</th>
            <th class="bq-title" <?php echo $onclick?> cat="17" id="longhu_ball">龙虎</th>
        </tr>
        </tbody>
    </table>
    <table class="w100 t1 t-td-w4 align-c">
        <tbody>
        <tr class="ballqueue_result" id="z_cl">
            <td class="line-gradient"><p>13</p></td>
            <td class=""><p>18</p></td>
            <td class="line-gradient"><p>10</p></td>
            <td class=""><p>20</p></td>
            <td class="line-gradient"><p>01</p></td>
            <td class=""><p>06</p></td>
            <td class="line-gradient"><p>15</p></td>
            <td class=""><p>13</p></td>
            <td class="line-gradient"><p>09</p></td>
            <td class=""><p>07</p>

                <p>07</p></td>
            <td class="line-gradient"><p>17</p></td>
            <td class=""><p>09</p></td>
            <td class="line-gradient"><p>03</p></td>
            <td class=""><p>06</p></td>
            <td class="line-gradient"><p>13</p></td>
            <td class=""><p>08</p></td>
            <td class="line-gradient"><p>11</p></td>
            <td class=""><p>04</p></td>
            <td class="line-gradient"><p>02</p></td>
            <td class=""><p>11</p></td>
            <td class="line-gradient"><p>20</p></td>
            <td class=""><p>12</p></td>
            <td class="line-gradient"><p>11</p></td>
            <td class=""><p>14</p></td>
            <td class="line-gradient"><p>04</p></td>
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
<div id="player" style="display: none">
</div>
</form>
<?php include './popup.html' ?>
</div>
</body>
</html>
