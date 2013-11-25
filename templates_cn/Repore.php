<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';

$week = week();
function setHtml($week, $str, $user, $type = 0)
{
    $date1 = GetWeekDay(date("Y-m-d"), 1);
    $a = 0;
    $b = 0;
    $ac = 0;
    $e = 0;
    $g = 0;
    foreach ($week as $value) {
        $date2 = GetWeekDay($value, 1);
        $c = explode('-', $value);
        $f = date('H:i:s') <= '02:00' ? dayMorning(date("Y-m-d"), (60 * 60 * 24), true) : date("Y-m-d");
        if ($f == $value) {
            $html = '<td align="center" style="color:blue;font-weight:bold"><span style="font-size:104%">' . $c[1] . '-' . $c[2] . '</span>&nbsp;&nbsp;&nbsp;' . $date2 . '</td>';
        } else {
            $html = '<td align="center"><span style="font-size:104%">' . $c[1] . '-' . $c[2] . '</span>&nbsp;&nbsp;&nbsp;' . $date2 . '</td>';
        }
        $date = GetWeekDay($value, 1);
        $result = GetForms($value . ' 02:00', dayMorning($value, (60 * 60 * 24)) . ' 02:00', $user[0]['g_name'], $type);
        //alert(count($result));
        $count_bishu = 0; //筆數
        $count_jiner = 0; //下注金額
        $count_win = 0; //輸贏結果
        $count_tueishui = 0; //退水
        $count_win_n = 0; //退水后結果
        for ($i = 0; $i < count($result); $i++) {
            $countMoney = sumCountMoney($user, $result[$i]);
            $count_bishu += $countMoney['Num'];
            $count_jiner += $countMoney['Money'];
            $count_tueishui += $countMoney['TuiShui'];
            $count_win_n += $countMoney['Win'];
            $count_win += $result[$i]['g_win'] - $countMoney['TuiShui'];
        }
        if ($count_win_n == 0 && $count_jiner == 0) {
            $count_win_n = '0.0';
        } else {
            $count_win_n = '<a href="repors.php?gid=' . base64_encode($value) . '&dateId=' . base64_encode($value) . '&type=' . $type . '" class="bgh">' . is_Number($count_win_n, 1) . '</a>';
        }
        $a += $count_bishu;
        $b += $count_jiner;
        $ac += $count_win;
        $e += $count_tueishui;
        $g += ($count_win + $count_tueishui);
        echo '<tr class="t_td_text" align="right">
			            ' . $html . '
			            <td align="center">' . $count_bishu . '</td>
			            <td style="letter-spacing:1px; font-size:104%;">' . is_Number($count_jiner) . '&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%;">' . number_format($count_win, 1, ".", "") . '&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%;">' . number_format($count_tueishui, 1, ".", "") . '&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%; color:red">' . $count_win_n . '&nbsp;</td>
        			  </tr>';
    }
    echo '<tr class="t_td_caption_1">
        	<td><b>' . $str . '</b></td>
            <td>' . $a . '</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">' . is_Number($b) . '&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">' . number_format($ac, 1, ".", "") . '&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">' . number_format($e, 1, ".", "") . '&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;"><b>' . number_format($g, 1, ".", "") . '</b>&nbsp;</td>
        </tr>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="js/sc.js"></script>
    <script>
        function typechang($this) {
            if ($this.value == 1) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=1";
            } else if ($this.value == 3) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=3";
            } else if ($this.value == 4) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=4";
            } else if ($this.value == 2) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=2";
            } else if ($this.value == 5) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=5";
            } else if ($this.value == 6) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=6";
            } else if ($this.value == 7) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=7";
            } else if ($this.value == 9) {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=9";
            } else {
                window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=0";
            }
        }
    </script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
</head>
<body class="skin_brown">

<div id="rightLoader" dom="right" style="">
    <div id="history" class="history struct_table_center" tmp="history">
        <div class="title h_title" style="margin-top:0px;"><span class="sub_title_color">账户历史</span>&nbsp;&nbsp;<span
                id="date" post_date="cdate=" class="hidden"></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"
                                                                                              class="btn_m elem_btn hidden"
                                                                                              id="reback"
                                                                                              bdata="reback,click,reback">返回</a>
        </div>
        <div style="clear:both;"></div>
        <!--账户历史总明细 result-->
        <div id="history_result" class="history_tb ">
            <table id="lastweek_tb" class="struct_table_five t1 dataArea " width="100%">
                <colgroup>
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                </colgroup>
                <thead>
                <tr>
                    <th>日期</th>
                    <th>注数</th>
                    <th>下注金额</th>
                    <th>佣金</th>
                    <th>盈亏</th>
                </tr>
                </thead>
                <tbody>
                <tr class="">
                    <td>2013-11-18 星期一</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-19 星期二</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-20 星期三</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-21 星期四</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-22 星期五</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-23 星期六</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-11-24 星期日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                </tbody>
                <tfoot class="bg_g1">
                <tr id="lastweek_total" class="alltotal">
                    <td>上周</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                </tfoot>
            </table>
            <table id="thisweek_tb" class="struct_table_five t1 dataArea" style="margin-top:19px">
                <colgroup>
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                    <col width="20%">
                </colgroup>
                <thead>
                <tr>
                    <th>日期</th>
                    <th>注数</th>
                    <th>下注金额</th>
                    <th>佣金</th>
                    <th>盈亏</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>2013-11-25 星期一</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-11-26 星期二</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-11-27 星期三</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-11-28 星期四</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-11-29 星期五</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr class="">
                    <td>2013-11-30 星期六</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                <tr>
                    <td>2013-12-01 星期日</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
                </tr>
                </tbody>
                <tfoot class="bg_g1">
                <tr id="thisweek_total" class="alltotal">
                    <td>本周</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="">0</td>
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