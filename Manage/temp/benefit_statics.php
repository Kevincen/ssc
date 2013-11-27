<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 13-11-25
 * Time: 下午3:21
 * Describe:收付统计，类似与小报表的功能
 */

define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $LoginId, $Users;

$tid = $_GET['tid'];
$js_file = '';
$menu_html = '';
switch ($tid) {
    case 1:
        $js_file = 'oddsFile.js';
        $menu_html = '
        <li class="on">单码<p id="type_00">0</p></li>
        <li class="">正码<p id="type_29">0</p></li>
        <li class="">两面<p id="type_01">0</p></li>
        <li>中发白<p id="type_02">0</p></li>
        <li>方位<p id="type_03">0</p></li>
        <li>龙虎<p id="type_04">0</p></li>
        <li>连码<p id="type_05">0</p></li>
        ';
        break;
    case 2:
        $js_file = 'oddsFilecq.js';
        $menu_html = '
       <li class="on">单码<p id="type_00">0</p></li>
       <li>两面<p id="type_01">0</p></li>
       <li>龙虎和<p id="type_02">0</p></li>
       <li>前三<p id="type_03">0</p></li>
       <li>中三<p id="type_04">0</p></li>
       <li>后三<p id="type_05">0</p></li>
        ';
        break;
    case 6:
        $js_file = 'oddsFilepk.js';
        $menu_html = '
        <li class="on">单码<p id="type_00">0</p></li>
        <li>两面<p id="type_01">0</p></li>
        <li>冠亚和值<p id="type_02">0</p></li>
        ';
        break;
    case 5:
        $js_file = 'oddsFilenc.js';
        $menu_html = '
        <li class="on">单码<p id="type_00">0</p></li><li>正码<p id="type_29">0</p></li><li>两面<p id="type_01">0</p></li><li>中发白<p id="type_02">0</p></li><li>东南西北<p id="type_03">0</p></li><li>龙虎<p id="type_04">0</p></li><li>连码<p id="type_05">0</p></li>
        ';
        break;
    case 9:
        $js_file = 'oddsFilejsk3.js';
        $menu_html = '<li class="on">三军-大小<p id="type_00" <="" p="">0</p></li><li>围骰-全骰<p id="type_01">0</p></li><li>点数<p id="type_02">0</p></li><li>长牌<p id="type_03">0</p></li><li>短牌<p id="type_04">0</p></li>';
        break;
    default:
        echo "impossible";
        exit;
}


?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>
        收付统计
    </title>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/<?php echo $js_file ?>"></script>

</head>
<body>

<div id="layout" class="container" style="height: 558px;">
<div dom="main_nav" class="main-content1" style="display: block;">
    <?php
    include_once "./oddsTopBar.php";
    ?>
    <ul class="tongji_nav">
        <?php echo $menu_html?>
    </ul>
</div>
<div dom="main" class="main-content1" style="display: block;">
<div id="tongji" class="tongji klc">
<div class="tongji-title"><input type="button" value="补仓明细" id="bucang"><select id="timeValue"
                                                                                style="visibility: visible;">
        <option value="0">手动</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="60">60</option>
        <option value="90">90</option>
    </select><input type="text" disabled="disbaled" class="smallInput" id="autoRefresh"><input type="button"
                                                                                               value="刷新"
                                                                                               id="reflash"><span
        id="game_type"><label for="000"><input id="000" value="第一球" checked="checked" name="game"
                                               type="radio">第一球</label><label for="001"><input id="001"
                                                                                               value="第二球"
                                                                                               name="game"
                                                                                               type="radio">第二球</label><label
            for="002"><input id="002" value="第三球" name="game" type="radio">第三球</label><label
            for="003"><input id="003" value="第四球" name="game" type="radio">第四球</label><label
            for="004"><input id="004" value="第五球" name="game" type="radio">第五球</label><label
            for="005"><input id="005" value="第六球" name="game" type="radio">第六球</label><label
            for="006"><input id="006" value="第七球" name="game" type="radio">第七球</label><label
            for="007"><input id="007" value="第八球" name="game" type="radio">第八球</label></span>
    <ul class="pager" style="display: none;" pager="true">
        <li class="first" id="first"></li>
        <li class="previous" id="previous"></li>
        <li class="other">第<input id="current_tj" type="text" value="1">页</li>
        <li class="other t-pager">共<span id="total_tj">1</span>页</li>
        <li class="next" id="next"></li>
        <li class="last" id="last"></li>
    </ul>
</div>
<table style="width:100%">
    <tbody>
    <tr>
        <td style="vertical-align: top;width:85%">
            <table class="clear-table" id="tongji_tb">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>玩法</th>
                    <th>注数</th>
                    <th>下注金额</th>
                    <th>总占成</th>
                    <!-- <th class='ylch' >预留吃货</th> -->
                    <th>佣金收入</th>
                    <th>彩金</th>
                    <th>平均赔率</th>
                    <th id="scje" class="scjex">胜出金额</th>
                    <th>补仓<span id="bucang_num"></span></th>
                    <th>赔率<select id="handicap" style="visibility: visible;">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>盘
                    </th>
                </tr>
                </thead>
                <tfoot>
                <tr class="alltotal">
                    <td></td>
                    <td>总计</td>
                    <td id="total">0</td>
                    <td id="sum">0</td>
                    <td id="share">0</td>
                    <!--  <td class='ylch' id='ylch'></td> -->
                    <td id="comm">0</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="scjex"></td>
                </tr>
                </tfoot>
                <tbody>
                <tr class="bc">
                    <td colspan="12">暂无数据！</td>
                </tr>
                </tbody>
            </table>
        </td>
        <td style="vertical-align: top;">
            <table class="bet-table bt-width chlong bold" style="width:93%; margin:0 2px;">
                <caption>
                    <div class="changlong">两面长龙排行</div> <?php //TODO:这里在江苏筛宝的时候是近期开奖结果 ?>
                </caption>
                <colgroup>
                    <col class="changl-col1">
                    <col class="changl-col2">
                    <col class="changl-col3">
                </colgroup>
                <tbody id="changlong" class="ssc">
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第1球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">双</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">5期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第2球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">合数单</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">5期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第6球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">双</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">5期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第7球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">合数双</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">5期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第2球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">龙</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">总和</td>
                    <td class="grey blue" style="border-left:none;width:32%;">尾大</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第3球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">合数双</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">3期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第1球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">龙</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第1球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">尾小</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第5球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">合数单</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第6球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">尾大</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第7球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">尾小</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第8球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">双</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                <tr>
                    <td class="grey blue" style="border-right:none;width:38%;">第8球</td>
                    <td class="grey blue" style="border-left:none;width:32%;">尾大</td>
                    <td class="bg-pink bg-pink2" style="width:30%;">2期</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<textarea id="detailh_ta">&lt;ul class="pager de-pager" id="zdetail"&gt;&lt;li class="first" id="first"&gt;&lt;/li&gt;&lt;li
    class="previous" id="previous"&gt;&lt;/li&gt;&lt;li class="other"&gt;第&lt;input id="current_page"
    type="text" value="1" /&gt;页&lt;/li&gt;&lt;li class="other t-pager"&gt;共&lt;span id="total_page"&gt;1&lt;/span&gt;页&lt;/li&gt;&lt;li
    class="next" id="next"&gt;&lt;/li&gt;&lt;li class="last" id="last"&gt;&lt;/li&gt;&lt;/ul&gt;&lt;table
    class="clear-table detail"&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;注单号&lt;/th&gt;&lt;th&gt;盘口&lt;/th&gt;&lt;th&gt;玩法&lt;/th&gt;&lt;th&gt;会员&lt;/th&gt;&lt;th&gt;代理&lt;/th&gt;&lt;th&gt;总代理&lt;/th&gt;&lt;th&gt;股东&lt;/th&gt;&lt;th&gt;分公司&lt;/th&gt;&lt;th&gt;时间&lt;/th&gt;&lt;th&gt;下注金额&lt;/th&gt;&lt;th&gt;赔率&lt;/th&gt;&lt;th&gt;退水(%)&lt;/th&gt;&lt;th&gt;占成收入&lt;/th&gt;&lt;th&gt;补货&lt;/th&gt;&lt;th&gt;注单状态&lt;/th&gt;&lt;th
    style="display:none"&gt;操作&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tfoot&gt;&lt;tr &gt;&lt;th colspan="5"&gt;小计&lt;/th&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td
    name="x"&gt;{x1}&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td name="x"&gt;{x2}&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td
    style="display:none"&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;th colspan="5"&gt;合计&lt;/th&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td
    name="t"&gt;{t1}&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td name="t"&gt;{t2}&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td&gt;&lt;/td&gt;&lt;td
    style="display:none"&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tfoot&gt;ééé&lt;/table&gt;</textarea><!--后台补货--><textarea
    id="gb">&lt;h3 id='play_title'&gt;{play}&lt;/h3&gt;&lt;table class="clear-table buhuo" id="buhuo"&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;可补货后台&lt;/th&gt;&lt;th&gt;补货投注账户&lt;/th&gt;&lt;th&gt;盘口&lt;/th&gt;&lt;th&gt;退水(%)&lt;/th&gt;&lt;th&gt;赔率&lt;/th&gt;&lt;th&gt;操作&lt;/th&gt;&lt;th&gt;金额&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody
    id='waidaoCor'&gt;&lt;!--&lt;tr&gt;&lt;td&gt;-&lt;/td&gt;&lt;td id='play_type'&gt;&nbsp;&lt;/td&gt;&lt;td
    id='play_oddset'&gt;A盘&lt;/td&gt;&lt;td&gt;&lt;input type='text' vname="discount" id='play_discount' /&gt;&lt;/td&gt;&lt;td&gt;&lt;input
    type='text' vname="odd" id='play_odd' /&gt;&lt;/td&gt;&lt;td&gt;&lt;input type='radio' checked='true'/&gt;&lt;/td&gt;&lt;td&gt;&lt;input
    type='text' vname="sum" id='play_sum' /&gt;&lt;/td&gt;&lt;/tr&gt;--&gt;&lt;tr&gt;&lt;td colspan='7'&gt;&lt;img
    src='/webssc/images/ajax-loader.gif'/&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;</textarea><!--下级补货--><textarea
    id="xb">&lt;table class="clear-table buhuo" id="buhuo"&gt;&lt;caption id='play_title'&gt;[{play}]
    下级给上级补货&lt;/caption&gt;&lt;thead&gt;&lt;tr&gt;&lt;th&gt;金额&lt;/th&gt;&lt;th&gt;盘口&lt;/th&gt;&lt;th&gt;赔率&lt;/th&gt;&lt;th&gt;退水(%)&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td&gt;&lt;input
    type="text" vname="sum" id="play_sum" /&gt;&lt;/td&gt;&lt;td id="play_oddset"&gt;&lt;select
    id="xbselect" disabled&gt;&lt;option value="A" &gt;A&lt;/option&gt;&lt;option value="B" &gt;B&lt;/option&gt;&lt;option
    value="C" &gt;C&lt;/option&gt;&lt;/select&gt;盘&lt;/td&gt;&lt;td id="play_odd"&gt;&nbsp;&nbsp;&lt;/td&gt;&lt;td
    id="play_discount"&gt;&nbsp;&nbsp;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;</textarea><!--玩法选择菜单--><textarea
    id="yidan">&lt;label for="000"&gt;&lt;input id="000" value="第一球" checked="checked" name="game"
    type="radio"&gt;第一球&lt;/label&gt;&lt;label for="001"&gt;&lt;input id="001" value="第二球" name="game"
    type="radio"&gt;第二球&lt;/label&gt;&lt;label for="002"&gt;&lt;input id="002" value="第三球" name="game"
    type="radio"&gt;第三球&lt;/label&gt;&lt;label for="003"&gt;&lt;input id="003" value="第四球" name="game"
    type="radio"&gt;第四球&lt;/label&gt;&lt;label for="004"&gt;&lt;input id="004" value="第五球" name="game"
    type="radio"&gt;第五球&lt;/label&gt;&lt;label for="005"&gt;&lt;input id="005" value="第六球" name="game"
    type="radio"&gt;第六球&lt;/label&gt;&lt;label for="006"&gt;&lt;input id="006" value="第七球" name="game"
    type="radio"&gt;第七球&lt;/label&gt;&lt;label for="007"&gt;&lt;input id="007" value="第八球" name="game"
    type="radio"&gt;第八球&lt;/label&gt;</textarea><textarea id="ermian">&lt;label for="000"&gt;&lt;input
    id="000" value="第一球" checked="checked" name="game" type="radio"&gt;第一球&lt;/label&gt;&lt;label for="001"&gt;&lt;input
    id="001" value="第二球" name="game" type="radio"&gt;第二球&lt;/label&gt;&lt;label for="002"&gt;&lt;input
    id="002" value="第三球" name="game" type="radio"&gt;第三球&lt;/label&gt;&lt;label for="003"&gt;&lt;input
    id="003" value="第四球" name="game" type="radio"&gt;第四球&lt;/label&gt;&lt;label for="004"&gt;&lt;input
    id="004" value="第五球" name="game" type="radio"&gt;第五球&lt;/label&gt;&lt;label for="005"&gt;&lt;input
    id="005" value="第六球" name="game" type="radio"&gt;第六球&lt;/label&gt;&lt;label for="006"&gt;&lt;input
    id="006" value="第七球" name="game" type="radio"&gt;第七球&lt;/label&gt;&lt;label for="007"&gt;&lt;input
    id="007" value="第八球" name="game" type="radio"&gt;第八球&lt;/label&gt;&lt;label for="008"&gt;&lt;input
    id="008" value="总和" name="game" type="radio"&gt;总和&lt;/label&gt;</textarea><textarea id="lianma">&lt;label
    for="000"&gt;&lt;input id="000" value="任选二" checked="checked" name="game" type="radio"&gt;任选二&lt;/label&gt;&lt;!--&lt;label
    for="001"&gt;&lt;input id="001" value="选二连直" name="game" type="radio"&gt;选二连直&lt;/label&gt;--&gt;&lt;label
    for="002"&gt;&lt;input id="002" value="选二连组" name="game" type="radio"&gt;选二连组&lt;/label&gt;&lt;label
    for="003"&gt;&lt;input id="003" value="任选三" name="game" type="radio"&gt;任选三&lt;/label&gt;&lt;!--&lt;label
    for="004"&gt;&lt;input id="004" value="选三前直" name="game" type="radio"&gt;选三前直&lt;/label&gt;--&gt;&lt;label
    for="005"&gt;&lt;input id="005" value="选三前组" name="game" type="radio"&gt;选三前组&lt;/label&gt;&lt;label
    for="006"&gt;&lt;input id="006" value="任选四" name="game" type="radio"&gt;任选四&lt;/label&gt;&lt;label
    for="007"&gt;&lt;input id="007" value="任选五" name="game" type="radio"&gt;任选五&lt;/label&gt;</textarea>
</div>
</div>

</div>

</body>
