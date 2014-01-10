<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-9
 * Time: 下午10:41
 */ 
?>
<tbody id="klc">
<tr>
    <td class="game-flag" colspan="15">
        <div><?php echo $type_name ?></div>
    </td>
</tr>
<tr class="games_head">
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
    <td class="games_sp"></td>
    <td></td>
    <td>单注最低</td>
    <td>单注最高</td>
    <td>单项最高</td>
    <td>A盘(%)</td>
    <td>B盘(%)</td>
    <td>C盘(%)</td>
</tr>
<?php for ($i = 0; $i <count($sub_array); $i++) { ?>
<tr>
    <?php
    for ($n=0;$n<2;$n++,$i++) {
        if ($i>=count($sub_array)) {
            break;
        }
        $sub_array[$i]['g_type'] = $lang->hk_cn($sub_array[$i]['g_type']);
        $color = $color_array[$sub_array[$i]['g_type']];
    ?>
        <th><span class="playColor <?php echo $color_array[$sub_array[$i]['g_type']] ?>">&nbsp;</span>
            <?php echo $sub_array[$i]['g_type'] ?>
        </th>
        <td><input name="<?php echo $sub_array[$i]['g_game_id'] ?>[<?php echo $sub_array[$i]['g_type'] ?>][danzhu_min]"  maxlength="9"
                   type="text" value="<?php echo $sub_array[$i]['g_danzhu_min'] ?>"
                   vname="sub_<?php echo $color?>_ordermin">
        </td>
        <td><input name="<?php echo $sub_array[$i]['g_game_id'].'['.$sub_array[$i]['g_type'].'][danzhu_max]'; ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $sub_array[$i]['g_danzhu'] : 0; ?>"
                   vname="sub_<?php echo $color?>_ordermax">
        </td>
        <td><input name="<?php echo $sub_array[$i]['g_game_id'].'['.$sub_array[$i]['g_type'].'][danxiang_max]'; ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $sub_array[$i]['g_danxiang'] : 0; ?>"
                vname="sub_<?php echo $color?>_itemmax">
        </td>
        <td>
            <?php //todo:所有的最大值都应该是上级的?>
            <div class="spaning"><input name="<?php echo $sub_array[$i]['g_game_id'].'['.$sub_array[$i]['g_type'].']'; ?>[panlu_a]"

                    <?php echo $sub_array[$i]['g_panlu_a'] == NULL? 'value="0.5" disabled="disabled ': 'value="'.(100-$sub_array[$i]['g_panlu_a']).'"' ?>
                                        type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $sub_array[$i]['g_a_limit'] : 0; ?>"
                                        vname="sub_<?php echo $color?>_A">
                    <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="<?php echo $sub_array[$i]['g_game_id'].'['.$sub_array[$i]['g_type'].']'; ?>[panlu_b]"
                    <?php echo $sub_array[$i]['g_panlu_b'] == NULL? 'value="1.6" disabled="disabled ': 'value="'.(100-$sub_array[$i]['g_panlu_b']).'"' ?>
                                        vname="klcdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $sub_array[$i]['g_b_limit'] : 0; ?>"
                                        vname="sub_<?php echo $color?>_B">
                    <a href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="<?php echo $sub_array[$i]['g_game_id'].'['.$sub_array[$i]['g_type'].']'; ?>[panlu_c]"
                    <?php echo $sub_array[$i]['g_panlu_c'] == NULL? 'value="2.6" disabled="disabled ': 'value="'.(100-$sub_array[$i]['g_panlu_c']).'"' ?>
                                        vname="klcdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $sub_array[$i]['g_c_limit'] : 0; ?>"
                                        vname="sub_<?php echo $color?>_C">
                <a href="javascript:void(0)" name="up"></a>
                <a href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php
    }//inner for end
        ?>
    </tr>
<?php }//outer for end ?>
</tbody>
