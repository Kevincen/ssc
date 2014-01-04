<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
global $user;
$db = new DB();
$lang = new utf8_lang();
if (!isset($_GET['type']) || $_GET['type'] == 0||$_GET['type'] ==1)
    $g_type = " and g_type='廣東快樂十分' ";
if ($_GET['type'] == 2)
    $g_type = " and g_type='重慶時時彩' ";
if ($_GET['type'] == 3)
    $g_type = " and g_type='廣西快樂十分' ";
if ($_GET['type'] == 6)
    $g_type = " and g_type='北京赛车PK10' ";
if ($_GET['type'] == 5)
    $g_type = " and g_type='幸运农场' ";
if ($_GET['type'] == 7)
    $g_type = " and g_type='六合彩' ";
$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type} ORDER BY g_date DESC {$page->limit} ";
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results) {
    for ($i = 0; $i < count($results); $i++) {
        $countMoney = sumCountMoney($user, $results[$i], true);
        $countBNum += $countMoney['Num'];
        $countTNum += $countMoney['Money'];
        $countSNum += $countMoney['Win'];
    }
}
$total_jiner = 0;
$total_winable = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="js/sc.js"></script>
    <script>
        function typechang($this) {
            if ($this.value == 1) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=1";
            } else if ($this.value == 3) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=3";
            } else if ($this.value == 4) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=4";
            } else if ($this.value == 2) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=2";
            } else if ($this.value == 5) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=5";
            } else if ($this.value == 6) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=6";
            } else if ($this.value == 7) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=7";
            } else if ($this.value == 9) {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=9";
            } else {
                window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=0";
            }
        }
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <title></title>
</head>
<body class="skin_brown">
<div style="display:none">
    <script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "%68%6D%2E%62%61%69%64%75%2E%63%6F%6D/h.js%3F9898c9fdab97319b23cd83299998e52e' type='text/javascript'%3E%3C/script%3E"));
    </script>
</div>

<div id="rightLoader" dom="right" style="">
    <div class="page status status-module" id="status" tmp="status">
        <div style="height:4px;visibility:hidden;font-size:0"></div>
        <ul class="of-h status-contain hidden">
            <li class="float-l status-on status-off" id="ssc-status">重庆时时彩</li>
            <li class="float-l status-on" id="klc-status" current="1">广东快乐十分</li>
            <li class="float-l status-on status-off" id="pk10-status" current="2">北京赛车</li>
        </ul>
        <div class="status-xg"></div>
        <div class="fLeft">
            <div class="elem_detailTabs" id="radio_se"><input type="radio" checked="&quot;checked&quot;" id="su"
                                                              name="sl" value="1" \=""><label for="su" class="label">成功明细</label><input
                    type="radio" id="lo" name="sl" value="1"><label for="lo" class="label">失败明细</label></div>
        </div>
        <!--  <div class="fRight"><div class="elem_pager" id="status_pager"><a href="javascript:void(0)" id="first" class="first" title="第一页">&#xf051;</a><a href="javascript:void(0)" id="previous" class="previous" title="上一页">&#xe001;</a><span class="other">第<input type="text" value="1" id="current_page" class="pageindex">页</span><span class="other">共<span id="total_page"></span>页</span><a href="javascript:void(0)" id="next" class="next" title="下一页">&#xe000;</a><a href="javascript:void(0)" id="last" class="last" title="末页">&#xf051;</a></div></div> -->
        <div class="clear"></div>
        <div class="dataArea">
            <table class="t1 tc h1 status" id="result_tb" width="100%">
                <thead>
                <tr>
                    <th>注单号</th>
                    <th>时间</th>
                    <th>类型</th>
                    <th>玩法</th>
                    <th>盘口</th>
                    <th>下注金额</th>
                    <th>退水(%)</th>
                    <th>可赢金额</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (count($result) <= 0) { ?>
                    <tr class="">
                    <td colspan="9">暂无数据!</td>
                    </tr>
                    <?php } else {
                        for($i=0;$i<count($result);$i++) {
                            $total_jiner += $result[$i]['g_jiner'];
                            $total_winable += $result[$i]['g_jiner'] * $result[$i]['g_odds'];
                        ?>
                    <tr class="">
                        <td><?php echo $result[$i]['g_id']?></td>
                        <td><?php echo $result[$i]['g_date']?></td>
                        <td><?php echo $lang->hk_cn($result[$i]['g_type'])?></td>
                        <td><?php echo $lang->hk_cn($result[$i]['g_mingxi_1'])?></td>
                        <td name="title"><?php echo $user[0]['g_panlu'] ?></td>
                        <td name="t1"><?php echo $result[$i]['g_jiner'] ?></td>
                        <td><?php echo 100 -$result[$i]['g_tueishui'] ?>%</td>
                            <?php //todo:可赢金额是这么算的么？。。。 ?>
                        <td name="t2"><?php echo $result[$i]['g_jiner']*($result[$i]['g_odds']-1) 
                        + $result[$i]['g_jiner']*(100 -$result[$i]['g_tueishui'])/100 ?></td>
                        <td name="t3">成功</td>
                    </tr>
                    <?php }
                     } ?>
                </tbody>
                <tfoot class="bg_g1">
                <!-- <tr id="s_total" class="total bold"><td></td><td></td><td></td><td></td><td name="title"><strong class="blue">小计</strong></td><td name="t1"></td><td></td><td name="t2"></td><td name="t3"></td></tr> -->
                <tr id="s_alltotal" class="alltotal bold">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td name="title"><strong class="blue">总计</strong></td>
                    <td name="t1"><?php echo $total_jiner?></td>
                    <td></td>
                    <td name="t2"><?php echo $total_winable?></td>
                    <td name="t3"></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <textarea id="play_detail" style="display:none">&lt;div &gt;&lt;div class="play-title"&gt;&lt;div class="L"&gt;{play}&lt;/div&gt;&lt;div
            class="R"&gt;组合数:&lt;span class='comb'&gt;{combs}&lt;/span&gt;总金额:&lt;span class='money'&gt;{money}&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div
            class="dt"&gt;组合清单&lt;/div&gt;&lt;div class="play-detail"&gt;{detail}&lt;/div&gt;&lt;/div&gt;</textarea>
    </div>
</div>
</body>
</html>