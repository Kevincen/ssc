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
    <td>
            <span class="g-vd-tooltip g-vd-prompt" style="display:none;z-index:10000000">
                <p>
                    由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！
                </p>
                <i></i>
            </span>
        <span class="g-vd-tooltip g-vd-prompt" style="display:none">
            <p>
            </p>
            <i></i>
        </span>
        <input autocomplete="off" type="text" name="account_money" maxlength="9" datatype="n" nullmsg="请输入信用额度"
               errormsg="10000~47000" title="10000~47000" value="<?php echo $this_module->account_money; ?>"></td>
    <th>所属盘口</th>
    <td><select name="panlu">
            <option value="<?php echo strtolower($this_module->panlu) ?>"><?php echo $this_module->panlu ?></option>
        </select>盘
    </td>
    <th>状态</th>
    <td><select name="status">
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
    <td><label for="short_covering1"><input id="short_covering1" value="1" name="buhuo"
                                            type="radio"
                <?php if ($this_module->buhuo == 1) {
                    echo 'checked="checked"';
                } ?>
                >允许</label>
        <label for="short_covering2"><input id="short_covering2" value="2" name="buhuo"
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
            <input id="share_flag1" value="1" name="buhuo_dis" type="radio"
                   checked="<?php echo $this_module->buhuo_dis == 1 ? 'true' : 'true' ?>">是

        </label>
        <label for="share_flag2">
            <input id="share_flag2" value="0" name="buhuo_dis" type="radio"
                   checked="<?php echo $this_module->buhuo_dis == 1 ? 'false' : 'true' ?>">否
        </label>
    </td>
    <script type="text/javascript">
        function list_click($this)
        {
            var value = $this.text();
            $input = $this.parent().prev().prev();
            $input.val(value);
            $this.parent().hide();

            var another_max_value = total_max_value - value;
            if ($input.attr('name') == 'upper_distribution') {
                $('input[name=my_distribution]').attr('max_value',another_max_value);
            }else if ($input.attr('name') == 'my_distribution') {
                $('input[name=upper_distribution]').attr('max_value',another_max_value);
            }
        }
        function set_list($this)
        {
            var max_value = $this.prev().attr('max_value');
            var $list = $this.next();
            var $input = $this.prev();

            var list_html = '';
            for (var i=0; i<=max_value;i+=5) {
                list_html += '<li onclick="list_click($(this))">' + i + '</li>';
            }

            $list.html(list_html);
            $list.toggle();
        }
        var total_max_value=0;
        $(document).ready(function() {
            total_max_value = $('input[name=my_distribution]').bind( 'keyup'
                ,function(event) {
                    $(this).val('');
                }
            ).attr('max_value');
            $('input[name=upper_distribution]').bind('keyup'
                ,function(event) {
                    $(this).val('');
                }
            )
        });
    </script>
    <!--        是自己的distribution -->
    <th name="currentname"><?php echo $this_module->rank_name ?>及下级占成权限总和(%)</th>
    <td><!--<select name='share_total'><option value="0"></option></select>-->
        <div class="share_up_div">
            <input name="upper_distribution" type="text" maxlength="3"
                   max_value="<?php echo $top_module->my_distribution - $this_module->upper_distribution ?>"
                   value="<?php echo $this_module->my_distribution ?>">
            <a href="javascript:void(0)" class="select" id="upper_dis" onclick="set_list($(this))"></a>
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
            <input name="my_distribution" type="text" maxlength="3" vname="share_up"
                    max_value="<?php echo $top_module->my_distribution - $this_module->my_distribution ?>"
                    value="<?php echo $this_module->upper_distribution ?>">
            <a href="javascript:void(0)" class="select" id="this_dis" onclick="set_list($(this))"></a>
            <ul id="this_dis_list" class="share_up_list" style="display: none;">
                <li style="">0</li>
            </ul>
        </div>
    </td>
    <th>倍数投注</th>
    <td>
        <label for="beishu_set1">
            <input id="beishu_set1" value="true" name="beishu" type="radio"
                   checked="<?php echo $this_module->beishu == 1 ? 'true' : 'false' ?>">允许
        </label>
        <label for="beishu_set2">
            <input id="beishu_set2" value="false" name="beishu" type="radio"
                   checked="<?php echo $this_module->beishu == 1 ? 'false' : 'true' ?>">不允许
        </label>
    </td>
</tr>
<tr id="set_water_tr">
    <th><span class="set_water_t" style="display: inline;">退水设定</span></th>
    <td id="set_water_td"><select name="set_water" style="visibility: visible;">
            <option selected="" value="0">水全退到底</option>
            <option value="100">赚取所有退水</option>
            <option value="0.05">赚取0.05%退水</option>
            <option value="0.1">赚取0.1%退水</option>
            <option value="0.15">赚取0.15%退水</option>
            <option value="0.2">赚取0.2%退水</option>
            <option value="0.25">赚取0.25%退水</option>
            <option value="0.3">赚取0.3%退水</option>
        </select></td>
    <th></th>
    <td></td>
    <th></th>
    <td></td>
    <th></th>
    <td></td>
</tr>
