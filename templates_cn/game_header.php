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
        <td><strong class="c_blue"><?php echo $gametype ?> </strong> <b class="blue_h"><?php echo $sub_type ?></b></td>
        <td><strong class="red">今日输赢：<span id="sy" class="red">0</span></strong></td>
        <td colspan="3" id="resultnum" class="pk10" align="right"><strong class="c_blue"><b
                    id="number">398261</b>期开奖</strong>
            <?php if ($number_type === "k3") { ?>
                <span id="a" class="number num6" style="float: right"></span>
                <span id="b" class="number num1" style="float: right"></span>
                <span id="c" class="number num5" style="float: right"></span>
            <?php } else if ($number_type == 'nc') { ?>
                <span id="a" class="nc18"></span>
                <span id="b" class="number "></span>
                <span id="c" class="number "></span>
                <span id="d" class="number "></span>
                <span id="e" class="number "></span>
                <span id="f" class="number "></span>
                <span id="g" class="number "></span>
                <span id="h" class="number "></span>
                <span></span><span></span>
            <?php } else { ?>
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
            <?php } ?>
        </td>
    </tr>
    <tr height="29">
    <?php if ($number_type == 'nc') { ?>
        <td width="18%" height="29"><strong class="green" id="o"></strong><span
                >期</span></td>
        <td width="23%"> 距离封盘：<span style="color:#511E02" id="endTime" nc="0">00:00</span></td>
        <td class="nc_nav_td nc_nav_td_liangmian"> 距离开奖：<span class="red" id="endTimes" nc="0">00:00</span></td>
        <td align="right" style="color:#511E02"><span id="endTimea" class="endTimea">6</span>秒
            <span id="resultwheel" class="hide"></span></td>

    <?php } else { ?>

        <td width="25%" height="29"><strong class="green" id="o"></strong><span
                >期</span></td>
        <td width="28%"> 距离封盘：<span style="color:#511E02" id="endTime" nc="0">00:00</span></td>
        <td class="pk10_nav_td"> 距离开奖：<span class="red" id="endTimes" nc="0">00:00</span></td>
        <td align="right" style="color:#511E02"><span id="endTimea" class="endTimea">6</span>秒
            <span id="resultwheel" class="hide"></span></td>
    <?php } ?>
    </tr>
    </tbody>
</table>
<table cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td width="18%">
            <div class="elem_type" id="elem_type_div"><strong class="t">投注类型：</strong><a
                    href="javascript:void(0)" class="elem_btn btnnav" id="kuijie">快捷</a><a
                    href="javascript:void(0)" class="elem_btn btnnav on" id="yiban">一般</a></div>
        </td>
        <td width="28%" class="align-c">
            <div class="elem_amount">
                <div id="td_input_money">
                    <strong class="t kuaijie">金额</strong>
                                    <span class="kuaijie">
                                        <input type="text" class="elem_amount_input elem_amount_input_quick"
                                               id="AllMoney" name="" maxlength="9" id="" onkeydown="return IsNumeric()">
                                    </span>
                </div>
                <a class="btn_m elem_btn" id="submit_top" onclick="submitforms()">确 定</a>
                <a onclick="MyReset()" class="btn_m elem_btn" id="reset_top">重 置</a></div>
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
