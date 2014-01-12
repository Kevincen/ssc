<?php
/**
 *
 * 会员显示页面
 * User: 2b
 * Date: 14-1-8
 * Time: 下午5:28
 */
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
    <th>对此<?php echo $this_module->rank_name ?>的实际占成数(%)</th>
    <td>
        <div class="share_up_div">
            <input name="share_up" type="text" maxlength="3" max_value="<?php echo $top_module->my_distribution?>" value="<?php echo $this_module->upper_distribution?>">
            <a href="javascript:void(0)" class="select" id="share_up"></a>
            <ul id="share_up_list" class="share_up_list" style="display: none;">
                <li style="">0</li>
            </ul>
        </div>
    </td>
</tr>
<tr>
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
    <th></th>
    <td></td>
    <th></th>
    <td></td>
    <th></th>
    <td></td>
</tr>
