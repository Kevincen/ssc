<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 13-11-25
 * Time: 下午4:23
 */
//项目编码
//1 为快乐十分
//2 为时时彩
//6 北京赛车
//5 幸运农场
//6 江苏筛宝
if (!isset($tid)) {
    exit("tid not set oddsTopBar");
}

$ball_html = '';
$ball_cover = '';

switch ($tid) {
    case 1:
        $ball_cover = 'klc';
        $ball_html =
        '
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
                            <span id="q_d" class="number num11"></span>
                            <span id="q_e" class="number num2"></span>
                            <span id="q_f" class="number num4"></span>
                            <span id="q_g" class="number num8"></span>
                            <span id="q_h" class="number num6"></span>
        ';
        break;
    case 2:
        $ball_cover = 'klc';
        $ball_html = '
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
                            <span id="q_d" class="number num11"></span>
                            <span id="q_e" class="number num2"></span>
        ';
        break;
    case 6:
        $ball_cover = 'pk10';
        $ball_html =//北京赛车，10个球
            '
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
                            <span id="q_d" class="number num11"></span>
                            <span id="q_e" class="number num2"></span>
                            <span id="q_f" class="number num4"></span>
                            <span id="q_g" class="number num8"></span>
                            <span id="q_h" class="number num6"></span>
                            <span id="q_i" class="number num6"></span>
                            <span id="q_j" class="number num6"></span>
            ';
        break;
    case 5:
        $ball_cover = 'nc';
        $ball_html =
            '
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
                            <span id="q_d" class="number num11"></span>
                            <span id="q_e" class="number num2"></span>
                            <span id="q_f" class="number num4"></span>
                            <span id="q_g" class="number num8"></span>
                            <span id="q_h" class="number num6"></span>
            ';
        break;
    case 9:
        $ball_cover = 'ks';
        $ball_html =
            '
                            <span id="q_a" class="number num16"></span>
                            <span id="q_b" class="number num17"></span>
                            <span id="q_c" class="number num19"></span>
            ';
        break;
    default:
        echo "impossible";
        exit;
}
?>
<p class="today_info"><strong>今天输赢：<span
            id="win" class=" bold">0</span></strong><strong>【<span class="dgreen2 letter_space3 bold"
                                                                   id="number"></span>】<span
            class="ggray">期</span> &nbsp;&nbsp;&nbsp;距离封盘：<span class="bluer letter_space2 bold"
                                                                id="offTime" nc="264">加载中...</span>
        &nbsp;&nbsp;&nbsp;距离开奖：<span
            class="reder letter_space2" id="EndTime" nc="359">05:59</span></strong><strong
        class="resultnum-str">【<span class="bluer letter_space3 bold" id="q_number">加载中...</span>】<span
            class="ggray">期</span>&nbsp;&nbsp;&nbsp;开奖号码：
                        <span class="reder resultnum <?php echo $ball_cover?>" id="resultnum">
                            <?php echo $ball_html?>
                            </span>
    </strong>
</p>
