<?php
/*
  *此处需要每笔注单的单号
  * */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
//debug宏
//define('DEBUG',true);
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

function get_numbers($db_name, $qishu)
{
    $db = new DB();
    $sql_str = "SELECT `g_qishu`, `g_ball_1`, `g_ball_2`, `g_ball_3`, `g_ball_4`, `g_ball_5`, `g_ball_6`, `g_ball_7`, `g_ball_8`
		FROM $db_name WHERE `g_qishu` = '{$qishu}' AND g_ball_1 is not null LIMIT 1";
    return $db->query($sql_str, 1);
}

function get_checked_numberlist($number_array, $result_list)
{
//下注球号，其他 subArray(ballarry,选n)
//选二连直为：subArray_xuanerlianzhi(front_ball_array, end_array);
//win球号：首先通过数据库获得开奖球号。再将开奖球号传入以下函数：
//任选X: sumAcount->sumLM(开奖球号，注单球号，false)
//选二连组：见sumAcountnc.php356行，最后增加一个参数为 true
//选二连直：sumAcountnc->xuanerlianzhi(开奖球号，mingxi2当中的球号)
    include_once ROOT_PATH . 'class/SumAccount.php';
    include_once ROOT_PATH . 'class/SumAccountnc.php';
    $sum_LM = new SumAmount('123');
    $sum_nc_LM = new SumAmountnc('123');

    $numberList = array_slice($number_array[0], 1);
    if (defined('DEBUG')) {
        echo '</br>';
        var_dump($numberList);
    }
    $_numberList = array();
    foreach ($numberList as $value) {
        $_numberList[] = $value;
    }
    if ($result_list['g_mingxi_1'] == '任选二' || $result_list['g_mingxi_1'] == '任選二') {
        // 任選二規則、8個中2個 視為中獎
        $result = $sum_LM->SumLM($numberList, $result_list, 2, false);
    } else if ($result_list['g_mingxi_1'] == '选二连组' || $result_list['g_mingxi_1'] == '選二連組') {
        // 選二連組規則 任意兩個號碼相連 視為中獎
        $index = array(
            0 => 7,
            1 => 2,
            2 => 2,
            3 => 2
        );
        $result = $sum_LM->SumLM1($_numberList, $result_list, $index, true);
    } else if ($result_list['g_mingxi_1'] == '任选三' || $result_list['g_mingxi_1'] == '任選三') {
        // 任選二規則、8個中3個 視為中獎
        $result = $sum_LM->SumLM($numberList, $result_list, 3, false);
    } else if ($result_list['g_mingxi_1'] == '选二连直') {
        //todo:找2a一起来解决
        //選二連直規則 任意三個號碼相連、並且對應下注號碼的前後。視為中獎
        $result = $sum_nc_LM->xuanerlianzhi($numberList, $result_list);
    } else if ($result_list['g_mingxi_1'] == '选三前组' || $result_list['g_mingxi_1'] == '選三前組') {
        // 選三前組規則 任意三個號碼相連。視為中獎
        $index = array(
            0 => 1,
            1 => 3,
            2 => 3,
            3 => 3
        );
        $result = $sum_LM->SumLM1($_numberList, $result_list, $index, true);
    } else if ($result_list['g_mingxi_1'] == '任选四' || $result_list['g_mingxi_1'] == '任選四') {
        // 任選四規則、8個中4個 視為中獎
        $result = $sum_LM->SumLM($numberList, $result_list, 4, false);
    } else if ($result_list['g_mingxi_1'] == '任选五' || $result_list['g_mingxi_1'] == '任選五') {
        // 任選五規則、8個中5個 視為中獎
        $result = $sum_LM->SumLM($numberList, $result_list, 5, false);
    }

    return $result;
}

function get_count_from_type($string)
{
    $count = -1;
    switch ($string) {
        case '選二連直':
        case '任選二':
        case '任选二':
            $count = 2;
            break;
        case '選二連組':
        case '选二连组':
            $count = 2;
            break;
        case '任選三':
        case '任选三':
            $count = 3;
            break;
        case '選三前組':
        case '選三前直':
        case '选三前组':
            $count = 3;
            break;
        case '任選四':
        case '任选四':
            $count = 4;
            break;
        case '任選五':
        case '任选五':
            $count = 5;
            break;
        case '选二连直':
            $count = 2;
            break;
        default:
            $count = -1;

    }
    return $count;

}

function get_user_numberlist($result_list)
{
    include_once ROOT_PATH . 'function/parameter.php';
    $count = get_count_from_type($result_list['g_mingxi_1']);
    if ($count == -1) {
        echo $result_list['g_mingxi_1'];
        echo "wrong type";
    }
    if ($result_list['g_mingxi_1'] == '选二连直') {
        $user_array = explode('|', $result_list['g_mingxi_2']);
        $front_array = explode('、', $user_array[0]);
        $end_array = explode('、', $user_array[1]);
        sort($front_array);
        sort($end_array);
        $result = subArray_xuanerlianzhi($front_array, $end_array);
    } else {
        $user_array = explode('、', $result_list['g_mingxi_2']);
        sort($user_array);
        $result = subArr($user_array, $count);
    }
    return $result[1];
}

//返回：array[0]为中奖的球号列表,array[1]为投注球号列表
function set_mingxi($result_list)
{

    if ($result_list['g_mingxi_1_str'] == null) {
        return null;
    }

    $sub_type = $result_list['g_mingxi_1'];
    $qishu = $result_list['g_qishu'];
    $type = $result_list['g_type'];
    $history_db_name = '';


    switch ($type) {
        case '廣東快樂十分':
            $history_db_name = 'g_history';
            break;
        case '幸运农场':
            $history_db_name = 'g_history5';
            break;
        default:
            return null;
    }

    $numberList = get_numbers($history_db_name, $qishu);

    $result_numbers = get_checked_numberlist($numberList, $result_list);
    $user_numbers = get_user_numberlist($result_list);
    if (defined('DEBUG')) {
        var_dump($numberList);
        echo 'result:';
        var_dump($result_numbers);
        echo 'user:';
        var_dump($user_numbers);
        echo '</br>';
    }

    $ret_array = array();
    $ret_array[] = $result_numbers;
    $ret_array[] = $user_numbers;
    return $ret_array;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
    <script type="text/javascript" src="js/sc.js"></script>
    <script type="text/javascript" src="js/show_mingxi.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a[clickable=true]').click(function(){
                show_mingxi($(this));
            })
        });
    </script>
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
                            class=""><?php echo $lang->hk_cn($_GET['type']) ?>-已结算注单</span>&nbsp;&nbsp;
                        <a href="report_daily.php?gid=<?php echo $_GET['gid'] ?>" class="btn_m elem_btn "
                           id="reback" bdata="reback,click,reback"
                           status="1">返回</a></div>
                    <div class="elem_pager pager" id="history_pager" ajax_json="get_all" platform="klc" pager="true">
                        <?php echo $page->reporepage(array(0,1,2,3,4))?>
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
                        } else {
                            for ($i = 0; $i < count($result); $i++) {
                                $money = 0;
                                if ($result[$i]['g_mingxi_1_str'] == null) {
                                    $money = $result[$i]['g_jiner'];
                                    if ($result[$i]['g_win'] < 0) {
                                        $class = 'class="red"';
                                        $win_str = "不中奖";
                                    } else {
                                        $class = '';
                                        $win_str = "中奖";
                                    }
                                } else {
                                    $detail_balls = set_mingxi($result[$i]);

                                    $money = $result[$i]['g_jiner'] * $result[$i]['g_mingxi_1_str'];
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
                                        <?php echo $result[$i]['g_id'] ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?php
                                        echo $result[$i]['g_date'] ?>
                                    </td>
                                    <td><?php
                                        $qishu = $result[$i]['g_qishu'];
                                        echo substr($qishu, strlen($qishu) - 2, strlen($qishu));
                                        ?></td>
                                    <td class="td_autoline"><span class="bluer">
                                        <a href="javascript:void(0)" class="black"
                                           <?php if ($result[$i]['g_mingxi_1_str'] != null) { ?>
                                           clickable="true"
                                           results="<?php echo join('|', $detail_balls[0]) ?>"
                                           users="<?php echo join('|', $detail_balls[1]) ?>"
                                           money="<?php echo $money ?>"
                                           game_type="<?php echo $lang->hk_cn($results[$i]['g_type']) ?>"
                                           odds="<?php echo $results[$i]['g_odds']?>"
                                            <?php }?>
                                            >
                                            <?php echo $lang->hk_cn($result[$i]['g_mingxi_1']);
                                            echo " ";
                                            ?>
                                            <?php
                                            if ($result[$i]['g_type'] == '选二连直') {
                                                $ball_list = explode('|', $result[$i]['g_mingxi_2']);
                                                echo '前位 ' . $ball_list[0] . ' 后位' . $ball_list[1];
                                            } else {
                                                echo $lang->hk_cn($result[$i]['g_mingxi_2']);
                                            }
                                            ?>
                                        </a></span>@<span
                                            class="red"><?php echo $result[$i]['g_odds'] ?></span></td>
                                    <td><?php echo $user[0]['g_panlu'] ?></td>
                                    <td><?php echo $money ?></td>
                                    <td><?php echo $result[$i]['g_tueishui'] ?>%</td>
                                    <td><?php echo $win_str ?></td>
                                    <td <?php echo $class ?>><?php echo $result[$i]['g_win'] ?></td>
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
                            <td><?php echo number_format($countTNum, 1, ".", "") ?></td>
                            <td></td>
                            <td></td>

                            <td <?php echo $countSNum < 0 ? 'class="red"' : 'class=""'; ?>>
                                <?php echo number_format($countSNum, 1, ".", "") ?></td>
                            <td></td>
                        </tr>
                        <tr id="a_alltotal" class="alltotal">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="blue_h">总计</td>
                            <td><?php echo number_format($countTNum, 1, ".", "") ?></td>
                            <td></td>
                            <td></td>

                            <td <?php echo $countSNum < 0 ? 'class="red"' : 'class=""'; ?>>
                                <?php echo number_format($countSNum, 1, ".", "") ?></td>
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
    <!--玩法明细-->
    <div id="popup_form" style="display:none">
        <div class="pop-bd">
            <div dom="container" class="pop-container" style="width: 659px;">
                <div id="1387494492313" class="pop_loader" style="display: block;">
                    <div class="requestData" style="height:auto">
                        <div>
                            <div class="play-title">
                                <div class="L">选二连直 前位 02,08 后位07,12</div>
                                <div class="R">组合数:<span class="comb">4</span>总金额:<span class="money">8</span></div>
                            </div>
                            <div class="dt">组合清单</div>
                            <div class="play-detail">
                                <div style="border-left:1px solid #CDCDCD">
                                    <em>选二连直</em><br>02,07<br>(2)<br><span>2</span>
                                </div>
                                <div><em>选二连直</em><br>02,12<br>(2)<br><span>2</span></div>
                                <div><em>选二连直</em><br>08,07<br>(2)<br><span>2</span></div>
                                <div><em>选二连直</em><br>08,12<br>(2)<br><span>2</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
