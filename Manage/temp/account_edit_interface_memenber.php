<?php
/**
 * 会员显示页面
 * User: 2b
 * Date: 14-1-8
 * Time: 下午5:28
 */
?>
        <tr>
            <th>总信用额度</th>
            <td><input autocomplete="off" type="text" name="s_money" maxlength="9" vname="credit"
                       vmessage="10000~47000" title="10000~47000" value="<?php echo $validMoney;?>"></td>
            <th>所属盘口</th>
            <td><select name="s_pan">
                    <?php $panlu = $userList[0]['g_panlus'];?>
                    <?php if (!$detList){?>
                        <option value="a" <?php if(strstr($P,'A')!=''){echo 'selected="selected"';}?>>A</option>
                        <option value="b" <?php if(strstr($P,'B')!=''){echo 'selected="selected"';}?>>B</option>
                        <option value="c" <?php if(strstr($P,'C')!=''){echo 'selected="selected"';}?>>C</option>
                    <?php } else { ?>
                    <?php } ?>
                </select>盘</td>
            <th>状态</th>
            <td><select name="lock">
                    <option value="3"
                        <?php if($userList[0]['g_look']==3){
                            echo 'selected="selected"';
                        } ?>
                        >停用
                    </option>
                    <option value="2"
                        <?php if($userList[0]['g_look']==2){
                            echo 'selected="selected"';
                        } ?>
                        >停押
                    </option>
                    <option value="1"
                        <?php if($userList[0]['g_look']==1){
                            echo 'selected="selected"';
                        } ?>
                        >启用
                    </option>
                </select></td>
            <?php //TODO:这里要到官网实验以下搞清楚到底是多少 ?>
            <th>对此会员的实际占成数(%)</th>
            <td>
                <div class="share_up_div">
                    <?php if (!$detList){?>
                        <select name="s_size_ky" type="text" maxlength="3" vname="share_up" value="0">
                            <?php for ($i=0;$i<=$top_info['g_distribution'];$i += 5)  {
                                $add_str =
                                    $i==($top_info['g_distribution'] - $userList[0]['g_distribution'])? 'selected="selected"':'';
                                echo '<option value="'. $i .'" '.$add_str.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                    <?php } ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>倍数投注</th>
            <td><label for="beishu_set1"><input id="beishu_set1" value="true" name="beishu_set"
                                                type="radio">允许</label><label
                    for="beishu_set2"><input id="beishu_set2" value="false" name="beishu_set" type="radio"
                                             checked="">不允许</label></td>
            <th></th>
            <td></td>
            <th></th>
            <td></td>
            <th></th>
            <td></td>
        </tr>
