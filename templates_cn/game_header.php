<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 13-12-6
 * Time: 上午6:19
 */
?>
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
            <span id="j" class="number num4"></span>
            <span id="k" class="number num8"></span>
        </td>
    </tr>
    <tr height="29">
        <td width="25%" height="29"><strong class="green" id="o"></strong><span
                 >期</span></td>
        <td width="28%"> 距离封盘：<span style="color:#511E02" id="endTime" nc="0">00:00</span></td>
        <td class="pk10_nav_td"> 距离开奖：<span class="red" id="endTimes" nc="0">00:00</span></td>
        <td align="right" style="color:#511E02"><span id="endTimea" class="endTimea">6</span>秒
            <span id="resultwheel" class="hide"></span></td>
    </tr>
    </tbody>
</table>
