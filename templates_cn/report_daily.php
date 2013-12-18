<?php
/**
 * Created by PhpStorm.
 * 日报
 * User: 2b
 * Date: 13-12-18
 * Time: 下午9:44
 * 需要数据：每一项的注数，下注金额，佣金，盈亏
 */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
global $user;
if ($_GET['gid'] == null) exit;
if ($_GET['win'] == null || $_GET['win'] == 'win')
    $win = " `g_win` is not null";
else
    $win = " `g_win` is null";
$date = base64_decode($_GET['gid']);
//$date = "1997-07-07 01:00:00' or g_nid='abc123'   union all select g_id from (select g_password as g_id,'' as g_nid ,0 as g_win,now() as g_date from g_manage) as sb where g_id<>'' or 1=1 or g_date='2013-07-13";
//exit(iconv("utf-8","gb2312",base64_encode($date)));
$startDate = $date . ' 02:00';
$endDate = dayMorning($date, (60 * 60 * 24)) . ' 02:00';
$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
$db = new DB();

/*if (!isset($_GET['type']) || $_GET['type'] == 0)
    $g_type = " ";
if ($_GET['type'] == 1)
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
    $g_type = " and g_type='六合彩' ";*/
//暂且使用g_mingxi_1str作为注数
//已在注单数据库内设置该字段default为1
$sql = "SELECT SUM(  `g_jiner` ) as `t_jine`,
 SUM(  `g_mingxi_1_str` ) as `t_zhushu` ,
  SUM(  `g_tueishui` ) as `t_tuishui` ,
  SUM(  `g_win` ) as `t_win`,
  `g_type`
FROM g_zhudan
where {$date} and `g_nid` = '{$user[0]['g_name']}' and {$win}
GROUP BY  `g_type` ";

$result = $db->query($sql, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="js/sc.js"></script>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div style="display:none">
    <script language="javascript" type="text/javascript"
            src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
    <div class="mains_corll">
        <div id="rightLoader" dom="right" style="">
            <div id="history" class="history struct_table_center" tmp="history">
                <div id="history" class="history struct_table_center" tmp="history">
                    <div class="title h_title" style="margin-top:0px;">
                        <span class="sub_title_color">账户历史</span>&nbsp;&nbsp;
                        <span id="date" post_date="2013-12-16" cdate="class=&quot;&quot;"><?php echo base64_decode($_GET['gid']) . ' ' . GetWeekDay(base64_decode($_GET['gid']), 1) ?></span>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" class=" jies-btn focus-on" h_date="2013-12-16" 星期一="" status="1"
                            id="yjies" bdata="firstCallBack,click,firstCallBack">已结算</a>
                        <a href="javascript:void(0)" class=" jies-btn " h_date="2013-12-16" 星期一="" status="0" id="wjies" bdata="firstCallBack,click,firstCallBack">
                            未结算
                        </a>&nbsp;&nbsp;
                        <a href="Repore.php" class="btn_m elem_btn " id="reback" bdata="reback,click,reback"
                            status="1">返回</a></div>
                    <div style="clear:both;"></div>
                    <!--账户历史总明细 result--><!--账户历史彩票类型明细 play-->
                    <table id="play_tb" class="t1  dataArea ">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>彩票类型</th>
                            <th>注数</th>
                            <th>下注金额</th>
                            <th>佣金</th>
                            <th>盈亏</th>
                            <th>查看</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum_zhushu = 0;
                        $sum_jine = 0;
                        $sum_tuishui = 0;
                        $sum_win = 0;
                        $Lang = new utf8_lang();
                        for ($i=0; $i<count($result);$i++) {
                            ?>
                            <td><?php echo base64_decode($_GET['gid']) . ' ' . GetWeekDay(base64_decode($_GET['gid']), 1) ?></td>
                            <td><?php echo $Lang->hk_cn($result[$i]['g_type']) ?></td>
                            <td><?php echo $result[$i]['t_zhushu']?></td>
                            <td><?php echo $result[$i]['t_jine'] ?></td>
                            <td><?php echo $result[$i]['t_tuishui'] ?></td>
                            <?php if ($result[$i]['t_win'] < 0) {
                                echo '<td class="red">'.$result[$i]['t_win'].'</td>';
                            } else {
                                echo '<td>'.$result[$i]['t_win'].'</td>';
                            }?>
                            <td><a href="Repors.php?gid=<?php echo $_GET['gid']?>&dateId=<?php echo $_GET['gid']?>&type=<?php echo $result[$i]['g_type']?>"
                                   class="black" bdata="daycallBack,click,daycallBack">当天明细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                    href="report_term.php?gid=<?php echo $_GET['gid']?>&dateId=<?php echo $_GET['gid']?>&type=<?php echo $result[$i]['g_type']?>"
                                    class="black" bdata="CountcallBack,click,CountcallBack">按期数查看</a></td>

                        <?php
                            $sum_zhushu += $result[$i]['t_zhushu'];
                            $sum_jine += $result[$i]['t_jine'];
                            $sum_tuishui += $result[$i]['t_tuishui'];
                            $sum_win += $result[$i]['t_win'];
                        }

                        ?>
                        <tr>
                        </tr>
                        </tbody>
                        <tfoot class="bg_g1">
                        <tr id="play_total" class="alltotal">
                            <td></td>
                            <td class="blue_h">合计</td>
                            <td><?php echo $sum_zhushu?></td>
                            <td><?php echo $sum_jine?></td>
                            <td><?php echo $sum_tuishui?></td>
                            <?php if ($sum_win < 0) {
                                echo '<td class="red">'.$sum_win.'</td>';
                            } else {
                                echo '<td>'.$sum_win.'</td>';
                            }?>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <textarea id="play_detail" style="display:none">&lt;div &gt;&lt;div class="play-title"&gt;&lt;div
                        class="L"&gt;{play}&lt;/div&gt;&lt;div class="R"&gt;组合数:&lt;span class='comb'&gt;{combs}&lt;/span&gt;总金额:&lt;span
                        class='money'&gt;{money}&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class="dt"&gt;组合清单&lt;/div&gt;&lt;div
                        class="play-detail"&gt;{detail}&lt;/div&gt;&lt;/div&gt;</textarea></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
