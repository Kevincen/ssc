<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/global.php';
$ConfigModel = configModel("`g_nc_game_lock`, `g_game_nc_10`");
if ($ConfigModel['g_nc_game_lock'] != 1 || $ConfigModel['g_game_nc_10'] != 1)
    exit(href('right.php'));
$types = '連碼';

$_SESSION['cq'] = false;
$_SESSION['gx'] = false;
$_SESSION['jx'] = false;
$_SESSION['gd'] = false;
$_SESSION['nc'] = true;
//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode(',', $result[0]['g_panlus']);

$gurl = 'sGame_k_nc';

$g = $_GET['g'];
$gametype = "幸运农场";
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
    <script type="text/javascript" src="./js/funcions_nc.js"></script>
    <script type="text/javascript" src="./js/lianma.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            if (typeof  common_action_set != undefined) {
                common_action_set(function() {
                    submit_form();
                });
            }
            var unset_lm = function() {
                unset_clickable('.ballno-t-t', '#selectedlist', '#selectedAmount');
            }
            var set_lm = function() {
                set_clickable('.lianma_f .ballno-t-t','#selectedlist','#selectedAmount');
                set_clickable_nc();
            }
            action(set_lm, unset_lm);//设置赔率，开奖
            $('input[name=gg]').click(function(){
                my_reset();
                $('td.kon').removeClass('kon');
                $(this).parent().addClass('kon');
                /*
                    任选2连直显示前卫和中位
                    其他显示前卫
                 */

                if($(this).val()=='t7'){
                    $('.lianma_f').hide();
                    $('.lianma_zh').show();
                    //这里显示前卫和后卫
                    //$('.lianma_q').css('display','table-cell');
                    $('.lianma_h').show();
                } else {

                    $('.lianma_f').show();
                    //$('.lianma_q').hide();

                    //中位以及后位显示
                    $('.lianma_zh').hide();
                    $('.lianma_h').hide();
                }
            });
        });
    </script>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
    <div class="mains_corll">
        <div id="rightLoader" dom="right" style="">
            <div id="evenCode_nc" class="evenCode nc">
                <div class="betAreaBox">
                <table cellpadding="0" cellspacing="0" width="100%" id="winbox">
                    <tbody>
                    <tr height="23">
                        <td><strong class="c_blue"><?php echo $gametype?> </strong> <b class="blue_h"><?php echo $sub_type ?></b></td>
                        <td><strong class="red">今日输赢：<span id="sy" class="red">0</span></strong></td>
                        <td colspan="3" id="resultnum" class="pk10" align="right"><strong class="c_blue"><b
                                    id="number">398261</b>期开奖</strong>
                                <span id="a" class="nc18"></span>
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
                        <td width="18%" height="29"><strong class="green" id="o"></strong><span
                                >期</span></td>
                        <td width="25%"> 距离封盘：<span style="color:#511E02" id="endTime" nc="0">00:00</span></td>
                        <td class="pk10_nav_td"> 距离开奖：<span class="red" id="endTimes" nc="0">00:00</span></td>
                        <td align="right" style="color:#511E02"><span id="endTimea" class="endTimea">6</span>秒
                            <span id="resultwheel" class="hide"></span></td>
                    </tr>
                    </tbody>
                </table>
                <form id="lm" action="" method="post" target="leftFrame" >
                    <div class="ballqueue-module  ec-m lianma">
                        <table class="lianma-t w100 t1 align-c">
                            <tbody>
                            <tr>
                                <!-- <td class='bq-title' name='1'><input type='radio' id='1' name='x'  playType="060" /><label for='1' class='label'>果蔬单选</label><span odds='060'></span></td><td class="b-top-none">&nbsp;</td><td class='bq-title' name='1'><input type='radio' id='2' name='x'  playType="061" /><label for='2' class='label'>动物单选</label><span odds='061'></span></td><td class="b-top-none">&nbsp;</td> -->
                                <td class="bq-title kon" name="2">
                                    <input type="radio" onclick="cRadio(this)" name="gg" playtype="062" value="t1"
                                                                         checked="true">
                                    <label for="3"
                                                                                               class="label">任选二</label>
                                    <span class="o" id="h1" style="color: rgb(255, 0, 0);">6.62</span></td>
                                <td class="b-top-none">&nbsp;</td>
                                <td class="bq-title" name="2">
                                    <input type="radio" name="gg" playtype="062" value="t7">
                                    <label for="5" class="label">选二连直</label>
                                    <span class="o" id="h7" style="color: rgb(255, 0, 0);">2</span>
                                </td>
                                <td class="b-top-none">&nbsp;</td>
                                <td class="bq-title" name="2">
                                    <input type="radio" name="gg" playtype="062" value="t2" >
                                    <label>选二连组 </label>
                                    <span class="o" id="h2" style="color: rgb(255, 0, 0);">25.2</span>
                                </td>
                                <td class="b-top-none">&nbsp;</td>
                                <td class="bq-title" name="3">
                                    <input type="radio" name="gg" playtype="062" value="t3">
                                    <label>任选三</label>
                                    <span class="o" id="h3" style="color: rgb(255, 0, 0);">19.1</span>
                                </td>
                                <td class="b-top-none">&nbsp;</td>
                                <td class="bq-title" name="3">
                                    <input type="radio" name="gg" playtype="062" value="t4" >
                                    <label>选三前组 </label>
                                    <span class="o" id="h4" style="color: rgb(255, 0, 0);">970</span>
                                </td>
                                <td class="b-top-none">&nbsp;</td>
                                <!-- <td class='bq-title' name='3'><input type='radio' id='7' name='x'  playType="066"/><label for='7' class='label'>三全中</label><span odds='066'></span></td><td class="b-top-none">&nbsp;</td><td class='bq-title' name='3'><input type='radio' id='8' name='x'  playType="067"/><label for='8' class='label'>三连中</label><span odds='067'></span></td><td class="b-top-none">&nbsp;</td>-->
                                <td class="bq-title" name="4">
                                    <input type="radio"  name="gg" playtype="062" value="t5" >
                                    <label>任选四</label>
                                    <span class="o" id="h5" style="color: rgb(255, 0, 0);">63.5</span>
                                </td>
                                <td class="b-top-none">&nbsp;</td>
                                <td class="bq-title" name="5">
                                    <input type="radio" name="gg" playtype="062" value="t6" >
                                    <label>任选五</label>
                                    <span class="o" id="h6" style="color: rgb(255, 0, 0);">240</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="touzhuArea w100 t1 betArea lianma_f">
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
                                <th colspan="8" class="lianma_q" style="display: none;"></th>
                            </tr>
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
                                <td class="ballno-t-t "><span class="number num1"></span></td>
                                <td><input type="checkbox" name="t[]" value="01" number="01"></td>
                                <td class="ballno-t-t"><span class="number num6"></span></td>
                                <td><input type="checkbox" name="t[]" value="06" number="06"></td>
                                <td class="ballno-t-t"><span class="number num11"></span></td>
                                <td><input type="checkbox" name="t[]" value="11" number="11"></td>
                                <td class="ballno-t-t"><span class="number num16"></span></td>
                                <td class="td-last"><input type="checkbox" name="t[]" value="16" number="16" ></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num2"></span></td>
                                <td><input type="checkbox" name="t[]" value="02" number="02"></td>
                                <td class="ballno-t-t"><span class="number num7"></span></td>
                                <td><input type="checkbox" name="t[]" value="07" number="07"></td>
                                <td class="ballno-t-t"><span class="number num12"></span></td>
                                <td><input type="checkbox" name="t[]" value="12" number="12"></td>
                                <td class="ballno-t-t"><span class="number num17"></span></td>
                                <td class="td-last"><input type="checkbox" name="t[]" value="17" number="17"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num3"></span></td>
                                <td><input type="checkbox" name="t[]" value="03" number="03"></td>
                                <td class="ballno-t-t"><span class="number num8"></span></td>
                                <td><input type="checkbox" name="t[]" value="08" number="08"></td>
                                <td class="ballno-t-t"><span class="number num13"></span></td>
                                <td><input type="checkbox" name="t[]" value="13" number="13"></td>
                                <td class="ballno-t-t"><span class="number num18"></span></td>
                                <td class="td-last"><input type="checkbox" name="t[]" value="18" number="18"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num4"></span></td>
                                <td><input type="checkbox" name="t[]" value="04" number="04"></td>
                                <td class="ballno-t-t"><span class="number num9"></span></td>
                                <td><input type="checkbox" name="t[]" value="09" number="09"></td>
                                <td class="ballno-t-t"><span class="number num14"></span></td>
                                <td><input type="checkbox" name="t[]" value="14" number="14"></td>
                                <td class="ballno-t-t"><span class="number num19"></span></td>
                                <td class="td-last"><input type="checkbox" name="t[]" value="19" class="animal" number="19"></td>
                            </tr>
                            <tr class="lasttr">
                                <td class="ballno-t-t"><span class="number num5"></span></td>
                                <td><input type="checkbox" name="t[]" value="05" number="05"></td>
                                <td class="ballno-t-t"><span class="number num10"></span></td>
                                <td><input type="checkbox" name="t[]" value="10" number="10"></td>
                                <td class="ballno-t-t"><span class="number num15"></span></td>
                                <td><input type="checkbox" name="t[]" value="15"></td>
                                <td class="ballno-t-t"><span class="number num20"></span></td>
                                <td class="td-last"><input type="checkbox" name="t[]" value="20" class="animal" number="20"></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="struct_table  ec-table touzhuArea w100 t1 betArea lianma_zh"
                               style="display: none;">
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
                                <th colspan="8" style="border:none;">前位
                                </th>
                            </tr>
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
                                <td class="ballno-t-t"><span class="number num1"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="01"></td>
                                <td class="ballno-t-t"><span class="number num6"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="06"></td>
                                <td class="ballno-t-t"><span class="number num11"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="11"></td>
                                <td class="ballno-t-t"><span class="number num16"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_front[]" value="16"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num2"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="02"></td>
                                <td class="ballno-t-t"><span class="number num7"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="07"></td>
                                <td class="ballno-t-t"><span class="number num12"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="12"></td>
                                <td class="ballno-t-t"><span class="number num17"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_front[]" value="17"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num3"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="03"></td>
                                <td class="ballno-t-t"><span class="number num8"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="08"></td>
                                <td class="ballno-t-t"><span class="number num13"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="13"></td>
                                <td class="ballno-t-t"><span class="number num18"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_front[]" value="18"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num4"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="04"></td>
                                <td class="ballno-t-t"><span class="number num9"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="09"></td>
                                <td class="ballno-t-t"><span class="number num14"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="14"></td>
                                <td class="ballno-t-t"><span class="number num19"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_front[]" value="19"></td>
                            </tr>
                            <tr class="lasttr">
                                <td class="ballno-t-t"><span class="number num5"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="05"></td>
                                <td class="ballno-t-t"><span class="number num10"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="10"></td>
                                <td class="ballno-t-t"><span class="number num15"></span></td>
                                <td><input type="checkbox" name="t_front[]" value="15"></td>
                                <td class="ballno-t-t"><span class="number num20"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_front[]" value="20"></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="struct_table  ec-table touzhuArea w100 t1 betArea lianma_h"
                               style="display: none;">
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
                                <th colspan="8" style="border:none;">后位</th>
                            </tr>
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
                                <td class="ballno-t-t"><span class="number num1"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="01"></td>
                                <td class="ballno-t-t"><span class="number num6"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="06"></td>
                                <td class="ballno-t-t"><span class="number num11"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="11"></td>
                                <td class="ballno-t-t"><span class="number num16"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_end[]" value="16"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num2"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="02"></td>
                                <td class="ballno-t-t"><span class="number num7"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="07"></td>
                                <td class="ballno-t-t"><span class="number num12"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="12"></td>
                                <td class="ballno-t-t"><span class="number num17"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_end[]" value="17"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num3"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="03"></td>
                                <td class="ballno-t-t"><span class="number num8"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="08"></td>
                                <td class="ballno-t-t"><span class="number num13"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="13"></td>
                                <td class="ballno-t-t"><span class="number num18"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_end[]" value="18"></td>
                            </tr>
                            <tr>
                                <td class="ballno-t-t"><span class="number num4"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="04"></td>
                                <td class="ballno-t-t"><span class="number num9"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="09"></td>
                                <td class="ballno-t-t"><span class="number num14"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="14"></td>
                                <td class="ballno-t-t"><span class="number num19"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_end[]" value="19"></td>
                            </tr>
                            <tr class="lasttr">
                                <td class="ballno-t-t"><span class="number num5"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="05"></td>
                                <td class="ballno-t-t"><span class="number num10"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="10"></td>
                                <td class="ballno-t-t"><span class="number num15"></span></td>
                                <td><input type="checkbox" name="t_end[]" value="15"></td>
                                <td class="ballno-t-t"><span class="number num20"></span></td>
                                <td class="td-last"><input type="checkbox" name="t_end[]" value="20"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="elem_type_box">
                        <tbody>
                        <tr>
                            <td colspan="3"><b class="red">*</b>最多可选择 <span class="red">10</span> 个号码 <span
                                    class="elem_selected bulk-amount-times" style="display: none;">已经选中<span
                                        id="selectedlist" class="red"></span>共<span id="selectedAmount"
                                                                                    class="amount selectedAmount">5</span>注</span><span
                                    class="elem_selected bulk-amount-times elem_selected_1" style="display: none;"><b
                                        class="green">球号</b> 前位：<span id="selectedlist_m1"></span> 后位：<span
                                        id="selectedlist_m2"></span>共<span id="selectedAmount2"
                                                                           class="amount selectedAmount">5</span>注</span><span
                                    class="elem_selected bulk-amount-times elem_selected_2" style="display: none;"><b
                                        class="green">球号</b> 前位：<span id="selectedlist_n1"></span> 中位：<span
                                        id="selectedlist_n2"></span> 后位：<span id="selectedlist_n3"></span>共<span
                                        id="selectedAmount" class="amount selectedAmount">5</span>注</span></td>
                        </tr>
                        <tr>
                            <td width="25%"></td>
                            <td width="45%" class="align-c">
                                <div class="elem_amount"><strong class="t">金额</strong>
                                    <span id="bulk-amount-input" class="">
                                        <input type="text" class="elem_amount_input" name="money" maxlength="9" id="">
                                    </span>
                                    <a href="javascript:void(0)" onclick="set_action('fn9.php')" class="btn_m elem_btn" id="submit">确 定</a>
                                    <a href="javascript:void(0)" class="btn_m elem_btn" id="reset">重 置</a></div>
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
                    <div class="empty-d"></div>
                </form>
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
                            <td class="cl_1 inner_text">第4球<span class="part">-</span>虎</td>
                            <td class="align-c red" style="width:33%;">5期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第1球<span class="part">-</span>合数双</td>
                            <td class="align-c red" style="width:33%;">5期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第4球<span class="part">-</span>小</td>
                            <td class="align-c red" style="width:33%;">5期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第5球<span class="part">-</span>合数单</td>
                            <td class="align-c red" style="width:33%;">5期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>虎</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第1球<span class="part">-</span>尾大</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>合数单</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第7球<span class="part">-</span>尾大</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>大</td>
                            <td class="align-c red" style="width:33%;">4期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第2球<span class="part">-</span>双</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>小</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第3球<span class="part">-</span>单</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>单</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第8球<span class="part">-</span>合数双</td>
                            <td class="align-c red" style="width:33%;">3期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第2球<span class="part">-</span>龙</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第4球<span class="part">-</span>双</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第4球<span class="part">-</span>尾小</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第5球<span class="part">-</span>大</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第5球<span class="part">-</span>双</td>
                            <td class="align-c red" style="width:33%;">2期</td>
                        </tr>
                        <tr>
                            <td class="cl_1 inner_text">第7球<span class="part">-</span>小</td>
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
