<?php
/**
 * 非会员界面
 * User: 2b
 * Date: 14-1-8
 * Time: 下午5:26
 */
?>
    <tr>
        <th>总信用额度</th>
        <td><input autocomplete="off" type="text" name="s_money" maxlength="9" vname="credit"
                   vmessage="10000~47000" title="10000~47000" value="<?php echo $userList[0]['g_money'] ?>"></td>
        <th>所属盘口</th>
        <td><select name="odds_set">

            </select>？？盘</td>
        <th>状态</th>
        <td><select name="lock">
                <option value="3"
                    <?php if ($userList[0]['g_lock'] == 3) {
                        echo 'selected=""';
                    }
                    ?>
                    >停用
                </option>
                <option value="2"
                    <?php if ($userList[0]['g_lock'] == 2) {
                        echo 'selected=""';
                    } ?>
                    >停押
                </option>
                <option value="1"
                    <?php if ($userList[0]['g_lock'] == 1) {
                        echo 'selected=""';
                    }
                    ?>
                    >启用
                </option>
            </select></td>
        <th>补货设定</th>
        <td><label for="short_covering1"><input id="short_covering1" value="1" name="s_a_lock"
                                                type="radio"
                    <?php if ($userList[0]['g_Immediate_lock'] == 1) {
                        echo 'checked="checked"';
                    } ?>
                    >允许</label>
            <label for="short_covering2"><input id="short_covering2" value="2" name="s_a_lock"
                                                type="radio"
                    <?php if ($userList[0]['g_Immediate_lock'] != 1) {
                        echo 'checked="checked"';
                    } ?>
                    >不允许</label></td>
    </tr>
    <tr>
        <th>补货是否占成???</th>
        <td><label for="share_flag1"><input id="share_flag1" value="true" name="share_flag" type="radio"
                                            checked="">是</label><label for="share_flag2"><input
                    id="share_flag2" value="false" name="share_flag" type="radio">否</label></td>
<!--        是自己的distribution -->
        <th name="currentname"><?php echo $Rank[0] ?>及下级占成权限总和(%)</th>
        <td><!--<select name='share_total'><option value="0"></option></select>-->
            <div class="share_up_div"><select name="s_size_ky"  >
                    <?php for ($i=0;$i+$userList[0]['g_distribution_limit']<=$top_info['g_distribution'];$i += 5)  {
                        $add_str = $i==$userList[0]['g_distribution']? 'selected="selected"':'';
                        echo '<option value="'. $i .'" '.$add_str.'>'.$i.'</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
<!--        两者 之和不能大于上级的destribution-->
        <!--        其实是 distibution_limit-->
        <th name="parentname"><?php echo $top_info['rank'] ?>占成(%)</th>
        <td><!--<select name='share_up'><option value="0"></option></select>-->
            <div class="share_up_div"><select name="s_next_ky" type="text" maxlength="3" vname="share_up"
                                              value="<?php echo $userList[0]['g_distribution_limit']?>">
                    <?php for ($i=0;$i+$userList[0]['g_distribution']<=$top_info[0]['g_distribution'];$i += 5)  {
                        $add_str =
                            $i==($userList[0]['g_distribution_limit'])? 'selected="selected"':'';
                        echo '<option value="'. $i .'" '.$add_str.'>'.$i.'</option>';
                    }
                    ?>
                </select>

            </div>
        </td>
        <th>倍数投注</th>
        <td><label for="beishu_set1"><input id="beishu_set1" value="true" name="beishu_set"
                                            type="radio">允许</label><label
                for="beishu_set2"><input id="beishu_set2" value="false" name="beishu_set" type="radio"
                                         checked="">不允许</label></td>
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
