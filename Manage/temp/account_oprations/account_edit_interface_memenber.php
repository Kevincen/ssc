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
        <input autocomplete="off" type="text" name="account_money" maxlength="9" datatype="n"
               errormsg="10000~47000" nullmsg="请输入信用额度" title="10000~47000" value="<?php echo $this_module->account_money; ?>"></td>
    <th>所属盘口</th>
    <td><select name="panlu">
            <option value="<?php echo strtoupper($this_module->panlu) ?>"><?php echo $this_module->panlu ?></option>
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
    <script type="text/javascript">
        function list_click($this)
        {
            var value = $this.text();
            $input = $this.parent().prev().prev();
            $input.val(value);
            $this.parent().hide();
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
        $(document).ready(function() {
            $('input[name=my_distribution]').bind( 'keyup'
                ,function(event) {
                    if (event.keycode != 13) {//避免回车提交表单时此栏目被清空
                        $(this).val('');
                    }
                }
            )
        });
    </script>
    <th>对此<?php echo $this_module->rank_name ?>的实际占成数(%)</th>
    <td>
        <div class="share_up_div">
            <input name="upper_distribution" type="text" maxlength="3"
                   max_value="<?php echo $top_module->my_distribution?>" value="<?php echo $this_module->upper_distribution?>">
            <a href="javascript:void(0)" class="select" id="share_up" onclick="set_list($(this))"></a>
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
            <input id="beishu_set1" value="true" name="beishu" type="radio"
                checked="<?php echo $this_module->beishu==1?'true':'false' ?>">允许
        </label>
        <label for="beishu_set2">
            <input id="beishu_set2" value="false" name="beishu" type="radio"
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
