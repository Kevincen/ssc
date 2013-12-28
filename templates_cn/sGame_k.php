<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_10`");
if ($ConfigModel['g_kg_game_lock'] != 1 || $ConfigModel['g_game_10'] != 1)
    exit(href('right.php'));
$types = '连码';

//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);

$gurl = 'sGame_k';

$g = $_GET['g'];
$gametype = "广东快乐十分";
$sub_type = '连码';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link href="css/sGame.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="./js/sc.js"></script>
    <script type="text/javascript" src="./js/funcions.js"></script>
    <script type="text/javascript" src="./js/lianma.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var unset_lm = function() {
                unset_clickable('.ballno-t-t', '#selectedlist', '#selectedAmount');
            }
            var set_lm = function() {
                set_clickable('.ballno-t-t', '#selectedlist', '#selectedAmount');
            }
            $('input[name=gg]').click(function () {
                my_reset();
                $('td.kon').removeClass('kon');
                $(this).parent().addClass('kon');
                $("input[type=checkbox]").show();
            });
            action(set_lm, unset_lm);//设置赔率，开奖
        });
    </script>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
    <div class="mains_corll">
        <div id="rightLoader" dom="right">
            <div id="evenCode" class="evenCode">
                <div class="betAreaBox">
                    <table cellpadding="0" cellspacing="0" width="100%" id="winbox">
                        <tbody>
                        <tr height="23">
                            <td><strong class="c_blue"><?php echo $gametype?> </strong> <b class="blue_h"><?php echo $sub_type ?></b></td>
                            <td><strong class="red">今日输赢：<span id="sy" class="red">0</span></strong></td>
                            <td colspan="3" id="resultnum" class="pk10" align="right"><strong class="c_blue"><b
                                        id="number">398261</b>期开奖</strong>
                                <span id="a" class="number num6"></span>
                                <span id="b" class="number num1"></span>
                                <span id="c" class="number num5"></span>
                                <span id="d" class="number num9"></span>
                                <span id="e" class="number num7"></span>
                                <span id="f" class="number num3"></span>
                                <span id="g" class="number num2"></span>
                                <span id="h" class="number num10"></span>
                            </td>
                        </tr>
                        <tr height="29">
                            <td width="20%" height="29"><strong class="green" id="o"></strong><span
                                    >期</span></td>
                            <td width="28%"> 距离封盘：<span style="color:#511E02" id="endTime" nc="0">00:00</span></td>
                            <td class="pk10_nav_td"> 距离开奖：<span class="red" id="endTimes" nc="0">00:00</span></td>
                            <td align="right" style="color:#511E02"><span id="endTimea" class="endTimea">6</span>秒
                                <span id="resultwheel" class="hide"></span></td>
                        </tr>
                        </tbody>
                    </table>
                    <form id="lm" action="fn1.php?v=2013121601" method="post" target="leftFrame" >
                        <div class="ballqueue-module  ec-m lianma">
                            <table class="lianma-t w100 t1 align-c">
                                <tbody>
                                <tr>
                                    <td class="kon bq-title lianmatab" name="2"><input type="radio" id="1" name="gg"
                                                                                       value="t1" checked="true"
                                                                                       ><label for="1"
                                                                                                                class="label">任选二</label><span
                                            class="o" id="h1"></span></td>
                                    <td class="b-top-none">&nbsp;</td>
                                    <td class="bq-title lianmatab" name="2"><input type="radio" id="3" name="gg"
                                                                                   value="t3"><label for="3"
                                                                                                         class="label">选二连组</label><span
                                            class="o" id="h3"></span></td>
                                    <td class="b-top-none">&nbsp;</td>
                                    <td class="bq-title lianmatab" name="3"><input type="radio" id="4" name="gg"
                                                                                   value="t4"><label for="4"
                                                                                                         class="label">任选三</label><span
                                            class="o" id="h4"></span></td>
                                    <td class="b-top-none">&nbsp;</td>
                                    <td class="bq-title lianmatab" name="3"><input type="radio" id="6" name="gg"
                                                                                   value="t6"><label for="6"
                                                                                                         class="label">选三前组</label><span
                                            class="o" id="h6"></span></td>
                                    <td class="b-top-none">&nbsp;</td>
                                    <td class="bq-title lianmatab" name="4"><input type="radio" id="7" name="gg"
                                                                                   value="t7"><label for="7"
                                                                                                         class="label">任选四</label><span
                                            class="o" id="h7"></span></td>
                                    <td class="b-top-none">&nbsp;</td>
                                    <td class="bq-title lianmatab" name="5"><input type="radio" id="8" name="gg"
                                                                                   value="t8"><label for="8"
                                                                                                         class="label">任选五</label><span
                                            class="o" id="h8"></span></td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="struct_table  ec-table touzhuArea w100 t1 betArea" id="evencode_table">
                                <colgroup>
                                    <col class="col_single">
                                    <col class="">
                                    <col class="col_single">
                                    <col class="">
                                    <col class="col_single">
                                    <col class="">
                                    <col class="col_single">
                                    <col class="">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>号码</th>
                                    <th>勾选</th>
                                    <th>号码</th>
                                    <th>勾选</th>
                                    <th>号码</th>
                                    <th>勾选</th>
                                    <th>号码</th>
                                    <th class="td-last">勾选</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num1"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="01" name="t[]" id="t1" value="1" style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num6"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="06" name="t[]" id="t6" value="6"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num11"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="11" name="t[]" id="t11" value="11"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num16"></span></td>
                                    <td class="td-last huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="16" name="t[]" id="t16" value="16"
                                                                                                style="display:none"></td>
                                </tr>
                                <tr>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num2"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="02" name="t[]" id="t2" value="2"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num7"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="07" name="t[]" id="t7" value="7"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num12"></span></td>
                                    <td class="huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="12" name="t[]" id="t12" value="12"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num17"></span></td>
                                    <td class="td-last huiseBg" style="cursor: default;">
                                        <input type="checkbox" number="17" name="t[]" id="t17" value="17"
                                                                                                style="display:none"></td>
                                </tr>
                                <tr>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num3"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="03" name="t[]" id="t3" value="3"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num8"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="08" name="t[]" id="t8" value="8"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num13"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="13" name="t[]" id="t13" value="13"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num18"></span></td>
                                    <td class="td-last huiseBg" style="cursor: default;"><input type="checkbox" number="18" name="t[]" id="t18" value="18"
                                                                                                style="display:none"></td>
                                </tr>
                                <tr>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num4"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="04" name="t[]" id="t4" value="4"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num9"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="09" name="t[]" id="t9" value="9"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num14"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="14" name="t[]" id="t14" value="14"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num19"></span></td>
                                    <td class="td-last huiseBg" style="cursor: default;"><input type="checkbox" number="19" name="t[]" id="t19" value="19"
                                                                                                style="display:none"></td>
                                </tr>
                                <tr class="lasttr">
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num5"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="05" name="t[]" id="t5" value="5"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num10"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="10" name="t[]" id="t10" value="10"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num15"></span></td>
                                    <td class="huiseBg" style="cursor: default;"><input type="checkbox" number="15" name="t[]" id="t15" value="15"
                                                                                        style="display:none"></td>
                                    <td class="ballno-t-t huiseBg" style="cursor: default;"><span
                                            class="number num20"></span></td>
                                    <td class="td-last huiseBg" style="cursor: default;"><input type="checkbox" number="20" name="t[]" id="t20" value="20"
                                                                                                style="display:none"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
                            <tbody>
                            <tr>
                                <td colspan="3"><b class="red">*</b>最多可选择&nbsp;<span class="red">10</span> 个号码 <span
                                        class="elem_selected bulk-amount-times hide" style="display: none;"> 已经选中<span
                                            id="selectedlist" class="red"></span> 共<span id="selectedAmount" class="amount">5</span>注 </span>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"></td>
                                <td width="45%" class="align-c">
                                    <div class="elem_amount"><strong class="t kuaijie">金额</strong><span
                                            id="bulk-amount-input" class="kuaijie">
                                            <input type="text" class="elem_amount_input" name="money" maxlength="9" id=""
                                                                                          style="background-color: rgb(238, 238, 238); background-position: initial initial; background-repeat: initial initial;"></span>
                                        <a onclick="set_action('fn1.php')" class="btn_m elem_btn" id="submit" >确 定</a>
                                        <a href="javascript:void(0)" onclick="my_reset()" class="btn_m elem_btn" id="reset">重 置</a></div>
                                </td>
                                <td width="30%" class="align-r">
                                    <div class="elem_multiple" style="visibility: hidden;"><input name="" id="beishu"
                                                                                                  type="checkbox"><label
                                            class="label t" for="beishu">&nbsp;倍数</label><input style="display:none"
                                                                                                value="100" name="beishu"
                                                                                                id="beishu100"
                                                                                                checked="checked"
                                                                                                class="beisx"
                                                                                                type="radio"><label
                                            class="label" for="beishu100">百倍</label><input style="display:none" value="1000"
                                                                                           name="beishu" id="beishu1000"
                                                                                           class="beisx" type="radio"><label
                                            class="label" for="beishu1000">千倍</label><input style="display:none"
                                                                                            value="10000" name="beishu"
                                                                                            id="beishu10000" class="beisx"
                                                                                            type="radio"><label
                                            class="label" for="beishu10000">万倍</label></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="empty-d"></div>
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
                            <td class="cl_1 inner_text">第1球<span class="part">-</span>双</td>
                            <td class="align-c red" style="width:33%;">6期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第7球<span class="part">-</span>合数单</td>
                            <td class="align-c red" style="width:33%;">6期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>尾小</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第4球<span class="part">-</span>合数单</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第6球<span class="part">-</span>尾大</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第6球<span class="part">-</span>合数双</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>合数双</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第1球<span class="part">-</span>龙</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第1球<span class="part">-</span>大</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第2球<span class="part">-</span>双</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>单</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">总和<span class="part">-</span>尾小</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第5球<span class="part">-</span>合数双</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第7球<span class="part">-</span>小</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第7球<span class="part">-</span>单</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>大</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>单</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include './popup.html'?>

</div>
</body>
</html>
