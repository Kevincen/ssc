<?php
/**
 * 非会员界面
 * User: 2b
 * Date: 14-1-8
 * Time: 下午5:26
 */
$this_module = new User_info(1, 2, 3);
$top_module =  new User_info($top_name,$top_cid);
?>
    <tr>
        <th>总信用额度</th>
        <td><input autocomplete="off" type="text" name="s_money" maxlength="9" vname="credit"
                   vmessage="10000~47000" title="10000~47000" value="<?php echo $this_module->account_money; ?>"></td>
        <th>所属盘口</th>
        <td><select name="s_pan">
                <option value="<?php echo strtolower($this_module->panlu) ?>"><?php echo $this_module->panlu ?></option>
            </select>盘
        </td>
        <th>状态</th>
        <td><select name="lock">
                <option value="3"
                    <?php if ($this_module->status == 3) {
                        echo 'selected="selected"';
                    } ?>
                    >停用
                </option>
                <option value="2"
                    <?php if ($this_module->status == 2) {
                        echo 'selected="selected"';
                    } ?>
                    >停押
                </option>
                <option value="1"
                    <?php if ($this_module == 1) {
                        echo 'selected="selected"';
                    } ?>
                    >启用
                </option>
            </select></td>
        <th>补货设定</th>
        <td><label for="short_covering1"><input id="short_covering1" value="1" name="s_a_lock"
                                                type="radio"
                    <?php if ($this_module->buhuo == 1) {
                        echo 'checked="checked"';
                    } ?>
                    >允许</label>
            <label for="short_covering2"><input id="short_covering2" value="2" name="s_a_lock"
                                                type="radio"
                    <?php if ($this_module->buhuo != 1) {
                        echo 'checked="checked"';
                    } ?>
                    >不允许</label></td>
    </tr>
    <tr>
        <th>补货是否占成???</th>
        <td>
            <label for="share_flag1">
                <input id="share_flag1" value="1" name="share_flag" type="radio"
                       checked="<?php echo $this_module->buhuo_dis==1?'true':'true' ?>">是

            </label>
            <label for="share_flag2">
                <input id="share_flag2" value="0" name="share_flag" type="radio"
                       checked="<?php echo $this_module->buhuo_dis==1?'false':'true' ?>">否
            </label>
        </td>
<!--        是自己的distribution -->
        <th name="currentname"><?php echo $this_module->rank_name ?>及下级占成权限总和(%)</th>
        <td><!--<select name='share_total'><option value="0"></option></select>-->
            <div class="share_up_div">
                <input name="upper_dis" type="text" maxlength="3"
                       max_value="<?php echo $top_module->my_distribution - $this_module->upper_distribution?>"
                       value="<?php echo $this_module->my_distribution?>">
                <a href="javascript:void(0)" class="select" id="upper_dis"></a>
                <ul id="upper_dis_list" class="share_up_list" style="display: none;">
                    <li style="">0</li>
                </ul>
            </div>
        </td>
<!--        两者 之和不能大于上级的destribution-->
        <!--        其实是 distibution_limit-->
        <th name="parentname"><?php echo $top_module->rank_name ?>占成(%)</th>
        <td><!--<select name='share_up'><option value="0"></option></select>-->
            <div class="share_up_div">
                <select name="this_dis" type="text" maxlength="3" vname="share_up"
                        max_value="<?php echo $top_module->my_distribution - $this_module->my_distribution?>"
                        value="<?php echo $this_module->upper_distribution?>">
                    <a href="javascript:void(0)" class="select" id="this_dis"></a>
                    <ul id="this_dis_list" class="share_up_list" style="display: none;">
                        <li style="">0</li>
                    </ul>
                </select>

            </div>
        </td>
        <th>倍数投注</th>
        <td>
            <label for="beishu_set1">
                <input id="beishu_set1" value="true" name="beishu_set" type="radio"
                       checked="<?php echo $this_module->beishu==1?'true':'false' ?>">允许
            </label>
            <label for="beishu_set2">
                <input id="beishu_set2" value="false" name="beishu_set" type="radio"
                       checked="<?php echo $this_module->beishu==1?'false':'true' ?>">不允许
            </label>
        </td>
    </tr>
    <tr id="set_water_tr" style="display: none;">
        <th><span class="set_water_t" style="display: none;">退水设定</span></th>
        <td id="set_water_td"></td>
        <th></th>
        <td></td>
        <th></th>
        <td></td>
        <th></th>
        <td></td>
    </tr>
