<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $LoginId, $Users;
if ($LoginId == 89)
    $Users[0]['g_Lnid'][0] = $Users[0]['g_Lnid'][1];
$db = new DB();
$result = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultcq = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history2` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultgx = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history3` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultpk = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history6` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultlhc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history_lhc` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultnc = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history5` ORDER BY g_qishu DESC LIMIT 30 ", 1);

$resultxj = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history8` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$resultjsk3 = $db->query("SELECT `g_id`, `g_qishu` FROM `g_history9` ORDER BY g_qishu DESC LIMIT 30 ", 1);
$week = week();
if (date("H") >= 3) {
    $week['weekend'][6] = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
    $sDate = array(
        0 => date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))),
        1 => date('Y-m-d', mktime(0, 0, 0, date('n'), 1, date('Y'))),
        2 => date('Y-m-d', mktime(0, 0, 0, date('n'), date('t'), date('Y'))),
        3 => date('Y-m-01', strtotime('last month')),
        4 => date('Y-m-t', strtotime('last month')),
        5 => $week['weekend'][0],
        6 => $week['weekend'][6],
        7 => $week['weekstart'][0],
        8 => $week['weekstart'][6],
        9 => date("Y-m-d", mktime(0, 0, 0, date('m') - 1, date('d') - 4, date('Y'))),
        10 => date("Y-m-d"));
} else {
    $week['weekend'][6] = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
    $sDate = array(
        0 => date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 2, date('Y'))),
        1 => date('Y-m-d', mktime(0, 0, 0, date('n'), 1, date('Y'))),
        2 => date('Y-m-d', mktime(0, 0, 0, date('n'), date('t'), date('Y'))),
        3 => date('Y-m-01', strtotime('last month')),
        4 => date('Y-m-t', strtotime('last month')),
        5 => $week['weekend'][0],
        6 => $week['weekend'][6],
        7 => $week['weekstart'][0],
        8 => $week['weekstart'][6],
        9 => date("Y-m-d", mktime(0, 0, 0, date('m') - 1, date('d') - 4, date('Y'))),
        10 => date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript">
        <!--
        function AutoSet_Date(str) {
            var startDate = $("#startDate");
            var endDate = $("#endDate");
            switch (str) {
                case 1 :
                    startDate.val("<?php echo $sDate[10]?>");
                    endDate.val("<?php echo $sDate[10]?>");
                    break;
                case 2 :
                    startDate.val("<?php echo $sDate[0]?>");
                    endDate.val("<?php echo $sDate[0]?>");
                    break;
                case 3 :
                    startDate.val("<?php echo $sDate[5]?>");
                    endDate.val("<?php echo $sDate[6]?>");
                    break;
                case 4 :
                    startDate.val("<?php echo $sDate[7]?>");
                    endDate.val("<?php echo $sDate[8]?>");
                    break;
                case 5 :
                    startDate.val("<?php echo $sDate[1]?>");
                    endDate.val("<?php echo $sDate[2]?>");
                    break;
                case 6 :
                    startDate.val("<?php echo $sDate[3]?>");
                    endDate.val("<?php echo $sDate[4]?>");
                    break;
            }
        }
        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');
            AutoSet_Date(1);
        });
        //-->
    </script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height: 258px;">
    <div dom="left" class="sidebar" style="display: none;"></div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1">
        <div id="reportForm" class="reportForm">
            <form action="Report_Crystals.php" method="get">
                <div id="basicSettings">
                    <table class="bet-table z3-table td-cd">
                        <colgroup>
                            <col class="">
                            <col class="">
                        </colgroup>
                        <thead>
                        <tr>
                            <th colspan="2">报表</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="basic_left">彩票类型</td>
                            <td class="right">
                                <select id="allClass" name="s_type" onchange="form_type_change(this.value)">
                                    <option value="0">全部</option>
                                    <option value="1">广东快乐十分</option>
                                    <option value="2">重庆时时彩</option>
                                    <option value="5">北京赛车(PK10)</option>
                                    <option value="6">幸运农场</option>
                                    <option value="9">江苏骰宝</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td class="basic_left">日期查询</td>
                            <input name="t_N" type="hidden" value="1" checked="checked">
                            <!--默认按照日期进行查询-->
                            <td class="right date-se">
                                <input type="text" vmessage="请选择日期"
                                                             id="startDate" name="startDate" onfocus="WdatePicker({el:'startDate'})">
                                <span class="g-vd-status">
                                </span>到&nbsp;&nbsp;&nbsp;&nbsp;
                                <input
                                    type="text" id="endDate" vmessage="请选择日期" name="endDate" onfocus="WdatePicker({el:'endDate'})">
                                <span
                                    class="g-vd-status"></span><span class="huise-btn re-btn" id="thisToday"><span
                                        class="huise-btn" onclick="AutoSet_Date(1)">今天</span></span><span class="huise-btn re-btn"
                                                                                id="thisYesterday"><span
                                        class="huise-btn" onclick="AutoSet_Date(2)">昨天</span></span><span class="huise-btn re-btn"
                                                                                id="thisWeek"><span
                                        class="huise-btn" onclick="AutoSet_Date(3)">本星期</span></span><span class="huise-btn re-btn"
                                                                                 id="lastWeek"><span
                                        class="huise-btn" onclick="AutoSet_Date(4)">上星期</span></span><span class="huise-btn re-btn"
                                                                                 id="thisMonth"><span
                                        class="huise-btn" onclick="AutoSet_Date(5)">本月</span></span><span class="huise-btn re-btn"
                                                                                id="lastMonth"><span
                                        class="huise-btn" onclick="AutoSet_Date(6)">上月</span></span></td>
                        </tr>
                        <!-- <tr id="level1contrl"><td class="basic_left">报表级别</td><td class="right"><label ><input class="radio" type="radio" name="level" checked="checked" nav="1" />分公司报表</label><label ><input class="radio" type="radio" name="level" nav="0" />后台报表</label></td></tr> -->
                        <tr>
                            <td class="basic_left">期数查询</td>
                            <td class="right">
                                <select id="default" class="show" name="s_number">
                                    <option value="all">全部</option>
                                </select>
                                <select name="" id="klsf" class="hidden"><!--快乐十分-->
                                    <?php for ($i=0; $i<count($result); $i++){?>
                                        <option value='<?php echo$result[$i]['g_qishu']?>'> <?php echo$result[$i]['g_qishu']?> </option>
                                    <?php }?>
                                </select>
                                <select name="" id="cqssc" class="hidden"><!--时时彩-->
                                    <?php for ($i=0; $i<count($resultcq); $i++){?>
                                        <option value='<?php echo$resultcq[$i]['g_qishu']?>'> <?php echo$resultcq[$i]['g_qishu']?> </option>
                                    <?php }?>
                                </select>
                                <select name="" id="bjsc" class="hidden"><!--北京赛车-->
                                    <?php for ($i=0; $i<count($resultpk); $i++){?>
                                        <option value='<?php echo$resultpk[$i]['g_qishu']?>'> <?php echo$resultpk[$i]['g_qishu']?> </option>
                                    <?php }?>
                                </select>
                                <select name="" id="xync" class="hidden"> <!--幸运农场-->
                                    <?php for ($i=0; $i<count($resultnc); $i++){?>
                                        <option value='<?php echo$resultnc[$i]['g_qishu']?>'> <?php echo$resultnc[$i]['g_qishu']?> </option>
                                    <?php }?>
                                </select>
                                <select name="" id="jssb" class="hidden"> <!--江苏晒宝-->
                                    <?php for ($i=0; $i<count($resultjsk3); $i++){?>
                                        <option value='<?php echo$resultlhc[$i]['g_qishu']?>'> <?php echo$resultlhc[$i]['g_qishu']?> </option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="basic_left">类别</td>
                            <td class="right"><label for="totalzon"><input class="radio" type="radio" name="ReportType"
                                                                           checked="checked" nav="total" value="1"
                                                                           id="totalzon">总账</label>&nbsp;&nbsp;&nbsp;<label
                                    for="classfeng"><input type="radio" class="radio" name="ReportType" nav="class" value="2"
                                                           id="classfeng">分类账</label></td>
                        </tr>
                        <tr>
                            <td class="basic_left">开奖状态</td>
                            <td class="right"><label for="settlementok"><input class="radio" type="radio"
                                                                               name="Balance"
                                                                               id="settlementok" checked="checked"
                                                                               value="1">已结算</label>&nbsp;&nbsp;&nbsp;<label
                                    for="settlement"><input type="radio" class="radio" name="Balance" id="settlement"
                                                            value="0">未结算</label></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="btn-line"><input type="submit" class="yellow-btn" id="submit" value="查 询">

                    </div>
                    <div class="gundandown" id="gundandown" style="visibility: visible;">
                        <ul>
                            <li><span class="gundan-btn" id="guendan"></span>

                                <p class="gray">1.该程序能够自动下载当天所有期数的注单，并提供结算功能。让您对账目更加放心。<br>（<font color="red">注：保存在本地注单结算信息仅供参考，实际数据以报表显示为准！</font>）
                                </p>

                                <p class="gray">2.如果客户是U盘系统，在下载前需要再装多一个U盘，因为程序下载的数据是固定保存在本地D盘的。</p></li>
                            <li><span class="gundan-btn1" id="guendan1"></span>

                                <p style="line-height: 51px;" class="gray">点击查看&nbsp;&nbsp;公司ID、公司名称、域名信息以及设置说明！</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--main content--></div>
</body>
</html>