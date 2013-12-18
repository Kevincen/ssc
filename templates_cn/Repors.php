<?php
/*
  *此处需要每笔注单的单号
  * */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
global $user;
if ($_GET['gid'] == null) exit;
$date = base64_decode($_GET['gid']);
//$date = "1997-07-07 01:00:00' or g_nid='abc123'   union all select g_id from (select g_password as g_id,'' as g_nid ,0 as g_win,now() as g_date from g_manage) as sb where g_id<>'' or 1=1 or g_date='2013-07-13";
//exit(iconv("utf-8","gb2312",base64_encode($date)));
$startDate = $date . ' 02:00';
$endDate = dayMorning($date, (60 * 60 * 24)) . ' 02:00';
$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
$db = new DB();

if (!isset($_GET['type']) || $_GET['type'] == 0)
    $g_type = " ";
else {
    $g_type = " and g_type='" . $_GET['type'] . "' ";
}
//下注球号，其他 subArray(ballarry,选n)
//选二连直为：subArray_xuanerlianzhi(front_ball_array, end_array);
//win球号：首先通过数据库获得开奖球号。再将开奖球号传入以下函数：
//任选X: sumAcount->sumLM(开奖球号，注单球号，false)
//选二连组：见sumAcountnc.php356行，最后增加一个参数为 true
//选二连直：sumAcountnc->xuanerlianzhi(开奖球号，mingxi2当中的球号)
$sql = "SELECT `g_id` FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";
$total = $db->query($sql, 3);
//exit($sql);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan`
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type} ORDER BY g_date DESC {$page->limit} ";
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan`
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results) {
    for ($i = 0; $i < count($results); $i++) {
        $countMoney = sumCountMoney($user, $results[$i]);
        $countBNum += $countMoney['Num'];
        $countTNum += $countMoney['Money'];
        $countSNum += $countMoney['Win'];
    }
}
$lang = new utf8_lang();
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
<div class="main-content bet-content" dom="layoutright" id="layoutright" style="display: block;">
    <div class="mains_corll">
        <div id="rightLoader" dom="right" style="">
            <div id="history" class="history struct_table_center" tmp="history">
                <div id="history" class="history struct_table_center" tmp="history">
                    <div class="title h_title" style="margin-top:0px;"><span class="sub_title_color">账户历史</span>&nbsp;&nbsp;<span
                            id="date" post_date="2013-12-16" cdate="2013-12-16"
                            class=""><?php echo base64_decode($_GET['gid']) ?></span>&nbsp;&nbsp;<span id="play_type"
                                                                                                       platform="klc"></span><span
                            class=""><?php echo $lang->hk_cn($_GET['type'])?>-已结算注单</span>&nbsp;&nbsp;
                        <a href="report_daily.php?gid=<?php echo $_GET['gid'] ?>" class="btn_m elem_btn "
                                                                 id="reback" bdata="reback,click,reback"
                                                                 status="1">返回</a></div>
                    <div class="elem_pager pager" id="history_pager" ajax_json="get_all" platform="klc" pager="true"><a
                            title="第一页" class="first" id="first" href="javascript:void(0)"></a><a title="上一页"
                                                                                                   class="previous"
                                                                                                   id="previous"
                                                                                                   href="javascript:void(0)"></a><span
                            class="other">第<input type="text" class="pageindex" id="current_page"
                                                  value="1">页</span><span class="other">共<span id="total_page">1</span>页</span><a
                            title="下一页" class="next" id="next" href="javascript:void(0)"></a><a title="末页" class="last"
                                                                                                 id="last"
                                                                                                 href="javascript:void(0)"></a>
                    </div>
                    <div style="clear:both;"></div>
                    <!--账户历史总明细 result--><!--按天数查看期数明细 number-->
                    <table class="t1 dataArea " id="d_all" times="">
                        <thead>
                        <tr>
                            <th>注单号</th>
                            <th>下注时间</th>
                            <th>期数</th>
                            <th>玩法</th>
                            <th>盘口</th>
                            <th>下注金额</th>
                            <th>退水(%)</th>
                            <th>结果</th>
                            <th>盈亏</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($result) < 1) {
                            echo '<tr class="t_td_text" align="center"><td colspan="10">當前沒有任何記錄</td></tr>';
                        }
                        else {
                        for ($i = 0; $i < count($result); $i++) {
                            $money = 0;
                            if ($result[$i]['g_mingxi_1_str'] == null) {
                                $money =  $result[$i]['g_jiner'];
                                if ($result[$i]['g_win'] < 0) {
                                    $class = 'class="red"';
                                    $win_str = "不中奖";
                                } else {
                                    $class = '';
                                    $win_str = "中奖";
                                }
                            }
                            else {
                                $money =  $result[$i]['g_jiner'] * $result[$i]['g_mingxi_1_str'];
                                if ($result[$i]['g_mingxi_2_str'] == $result[$i]['g_mingxi_1_str']) {
                                    $win_str = "中奖";
                                } else if ($result[$i]['g_mingxi_2_str'] > 0) {
                                    $win_str = "部分中奖";
                                } else {
                                    $win_str = "不中奖";
                                }
                                if ($result[$i]['g_win'] < 0) {
                                    $class = 'class="red"';
                                } else {
                                    $class = 'class=""';
                                }
                            }
                            ?>
                            <tr class="">
                                <td>
                                    <span class="green">
                                        <?php echo$result[$i]['g_id']?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    echo $result[$i]['g_date'] ?>
                                </td>
                                <td><?php
                                    $qishu = $result[$i]['g_qishu'];
                                    echo substr($qishu, strlen($qishu)-2, strlen($qishu));
                                    ?></td>
                                <td class="td_autoline"><span class="bluer">
                                        <a href="javascript:void(0)" class="black">
                                            <?php echo $lang->hk_cn($result[$i]['g_mingxi_1']);
                                            echo " ";
                                            ?>
                                            <?php
                            if ($result[$i]['g_type'] == '选二连直')  {
                                $ball_list = explode('|',$result[$i]['g_mingxi_2']);
                                echo '前位 '.$ball_list[0].' 后位'.$ball_list[1];
                            } else {
                                echo $lang->hk_cn($result[$i]['g_mingxi_2']);
                            }
                                            ?>
                                        </a></span>@<span
                                        class="red"><?php echo $result[$i]['g_odds']?></span></td>
                                <td><?php echo $user[0]['g_panlu']?></td>
                                <td><?php echo $money?></td>
                                <td><?php echo $result[$i]['g_tueishui'] ?>%</td>
                                <td><?php echo $win_str ?></td>
                                <td <?php echo $class?>><?php echo $result[$i]['g_win']?></td>
                                <td>成功</td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot class="bg_g1">
                        <tr id="a_total" class="total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="blue_h">小计</td>
                            <td><?php echo number_format($countTNum, 1,".","")?></td>
                            <td></td>
                            <td></td>

                            <td <?php echo $countSNum <0 ?'class="red"':'class=""';?>>
                                <?php echo number_format($countSNum, 1,".","")?></td>
                            <td></td>
                        </tr>
                        <tr id="a_alltotal" class="alltotal">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="blue_h">总计</td>
                            <td><?php echo number_format($countTNum, 1,".","")?></td>
                            <td></td>
                            <td></td>

                            <td <?php echo $countSNum <0 ?'class="red"':'class=""';?>>
                                <?php echo number_format($countSNum, 1,".","")?></td>
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
