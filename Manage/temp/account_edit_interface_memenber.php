<?php
/**
 * 会员显示页面
 * User: 2b
 * Date: 14-1-8
 * Time: 下午5:28
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript">
        $(document).ready(function(){
            var win_height = window.innerHeight;
            $("#layout").css('height',win_height+'px');

        });
    </script>
    <script type="text/javascript" src="/Manage/temp/js/common.js"></script>
    <script type="text/javascript" src="/Manage/temp/js/Pwd_Safety.js"></script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height:358px;">


<div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
<div id="member" class="member">
<div class="title">
    <span id="account_name">修改<?php echo $userModel->Get_rank_from_name($userList[0]['g_f_name']) ?><?php echo $userList[0]['g_f_name'] ?>
            </span>上级<span id="superior"><?php echo $top_info['rank'].$top_info['g_name'] ?></span><a href="Actfor.php?cid=<?php echo $cid ?>"
                                                                                                      id="reback" level="1"
                                                                                                      class="mag-btn1">返回</a></div>
<form method="post" action="Manage_Up.php?cid=<?php echo $cid?>&uid=<?php echo $uid?>">
<table class="clear-table base-info">
    <caption>
        <div>基本资料</div>
    </caption>
    <tbody>
    <tr>
        <th>名称</th>
        <td><input autocomplete="off" name="s_F_Name" type="text" vname="name"
                   vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                   value="<?php echo $userList[0]['g_f_name'] ?>"></td>
        <th>账号</th>
        <td><input autocomplete="off" name="name" type="text" vname="account" readonly
                   vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！" value="<?php echo $userList[0]['g_name'] ?>" class="">
        </td>
        <th>密码</th>
        <td><input autocomplete="off" name="s_Pwd" type="password" vname="password"
                   vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
        <th>确认密码</th>
        <td class="error-info"><input autocomplete="off" name="repassword" type="password"
                                      vname="repassword" vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
    </tr>
        <tr>
            <th>总信用额度</th>
            <td><input autocomplete="off" type="text" name="s_money" maxlength="9" vname="credit"
                       vmessage="10000~47000" title="10000~47000" value="<?php echo $validMoney;?>"></td>
            <th>所属盘口</th>
            <td><select name="odds_set">
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
    </tbody>
</table>
<table class="general_info games_info" id="general_info"><!-- 快速设置-->
    <tbody id="general ">
    <tr>
        <td class="game-flag" colspan="8">
            <div>大项快速设置（注意：设置高于上级最高限制时按最高可调）??</div>
            <p class="reder game-tip">*占成、退水修改后，第二天新开期才能生效。下级会员当日没下注注单，修改占成、退水即时生效！</p></td>
    </tr>
    <tr class="games_head">
        <td width="400px">调整项目</td>
        <td>单注最低</td>
        <td>单注最高</td>
        <td>单项最高</td>
        <td>A盘(%)</td>
        <td>B盘(%)</td>
        <td>C盘(%)</td>
        <td>操作</td>
    </tr>
    <tr>
        <th>单码项（1~8单码、1~5单码、冠亚，3~10单码...）</th>
        <td><span class="playColor bBlue">&nbsp;</span><input name="general00" vname="generalordermin00"
                                                              autocomplete="off" maxlength="9" type="text"
                                                              style="margin-top:4px;_margin-top:2px;_"
                                                              value="2"></td>
        <td><input name="general00" vname="generalordermax00" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general00" vname="generalitem00" autocomplete="off" maxlength="9" type="text"
                   value="50000"></td>
        <td>
            <div class="spaning"><input name="general00" value="0.6" vname="generaldiscountA00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="1.6" vname="generaldiscountB00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general00" value="2.6" vname="generaldiscountC00" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g00" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>两面项（1~8两面，1~10两面、龙虎、三军…）</th>
        <td><span class="playColor bZise">&nbsp;</span><input name="general08" vname="generalordermin08"
                                                              autocomplete="off" maxlength="9" type="text"
                                                              style="margin-top:4px;_margin-top:2px;_"
                                                              value="2"></td>
        <td><input name="general08" vname="generalordermax08" autocomplete="off" maxlength="9" type="text"
                   value="100000"></td>
        <td><input name="general08" vname="generalitem08" autocomplete="off" maxlength="9" type="text"
                   value="200000"></td>
        <td>
            <div class="spaning"><input name="general08" value="0.6" vname="generaldiscountA08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general08" value="1.6" vname="generaldiscountB08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general08" value="2.6" vname="generaldiscountC08" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g01" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>连码项（任选二、任选三、围骰、长牌…）</th>
        <td><span class="playColor bGreen">&nbsp;</span><input name="general18" vname="generalordermin18"
                                                               autocomplete="off" maxlength="9" type="text"
                                                               style="margin-top:4px;_margin-top:2px;_"
                                                               value="2"></td>
        <td><input name="general18" vname="generalordermax18" autocomplete="off" maxlength="9" type="text"
                   value="2000"></td>
        <td><input name="general18" vname="generalitem18" autocomplete="off" maxlength="9" type="text"
                   value="5000"></td>
        <td>
            <div class="spaning"><input name="general18" value="0.6" vname="generaldiscountA18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general18" value="1.6" vname="generaldiscountB18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general18" value="2.6" vname="generaldiscountC18" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g02" type="button">修改</button>
        </td>
    </tr>
    <tr>
        <th>杂项（方位、豹子、冠亚和、点数…）</th>
        <td><span class="playColor bRed">&nbsp;</span><input name="general15" vname="generalordermin15"
                                                             autocomplete="off" maxlength="9" type="text"
                                                             style="margin-top:4px;_margin-top:2px;_" value="2">
        </td>
        <td><input name="general15" vname="generalordermax15" autocomplete="off" maxlength="9" type="text"
                   value="20000"></td>
        <td><input name="general15" vname="generalitem15" autocomplete="off" maxlength="9" type="text"
                   value="60000"></td>
        <td>
            <div class="spaning"><input name="general15" value="0.6" vname="generaldiscountA15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general15" value="1.6" vname="generaldiscountB15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="general15" value="2.6" vname="generaldiscountC15" type="text"
                                        minvalue="0" maxvalue="100"><a href="javascript:void(0)"
                                                                       name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <button id="g03" type="button">修改</button>
        </td>
    </tr>
    </tbody>
</table>
<table class="games_info" id="games_info"><!-- 广东快乐十分 -->
<tbody id="klc">
<tr>
    <td class="game-flag" colspan="15">
        <div>广东快乐十分</div>
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
<?php for ($i = 0; $i <count($klc_array); $i++) { ?>
    <?php
    ?>
    <tr>
        <th><span class="playColor bBlue">&nbsp;</span><?php echo $lang->hk_cn($klc_array[$i]['g_type']) ?></th>
        <td><input name="klc00"  maxlength="9"
                   type="text" value="<?php echo $klc_array[$i]['g_danzhu_min'] ?>">
        </td>
        <td><input name="d<?php echo $i ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $klc_array[$i]['g_danzhu'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $klc_array[$i]['g_danxiang'] : 0; ?>">
        </td>
        <td>
            <?php //todo:所有的最大值都应该是上级的?>
            <div class="spaning"><input name="a<?php echo $i ?>"

                    <?php echo $klc_array[$i]['g_panlu_a'] == NULL? 'value="0.5" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_a']).'"' ?>
                                         type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                    <?php echo $klc_array[$i]['g_panlu_b'] == NULL? 'value="1.6" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_b']).'"' ?>
                                        vname="klcdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                    <?php echo $klc_array[$i]['g_panlu_c'] == NULL? 'value="2.6" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_c']).'"' ?>
                                        vname="klcdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >=count($klc_array))
            break;
        ?>
        <?php
        ?>
        <th><span class="playColor bGreen">&nbsp;</span><?php echo $lang->hk_cn($klc_array[$i]['g_type']) ?></th>
        <td><input name="klc00"  maxlength="9"
                   type="text" value="<?php echo $klc_array[$i]['g_danzhu_min'] ?>">
        </td>
        <td><input name="d<?php echo $i ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $klc_array[$i]['g_danzhu'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $klc_array[$i]['g_danxiang'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                    <?php echo $klc_array[$i]['g_panlu_a'] == NULL? 'value="0.5" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_a']).'"' ?>
                                        vname="klcdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                    <?php echo $klc_array[$i]['g_panlu_b'] == NULL? 'value="1.6" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_b']).'"' ?>
                                        vname="klcdiscountB18" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                    <?php echo $klc_array[$i]['g_panlu_c'] == NULL? 'value="2.6" disabled="disabled ': 'value="'.(100-$klc_array[$i]['g_panlu_c']).'"' ?>
                                        vname="klcdiscountC18" type="text" minvalue="0"
                                        maxvalue="<?php //echo $count > 0 ? $klc_array[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
    </tr>
<?php } ?>
</tbody>
<!-- 重庆时时彩 -->
<tbody id="ssc">
<tr>
    <td class="game-flag" colspan="15">
        <div>重庆时时彩</div>
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
<?php for ($i = 26; $i < 39; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>
        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="ssc00" vname="sscordermin00" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="sscordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="sscitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="sscdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="sscdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="sscdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 39) {
        } else {
            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bRed">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="ssc05" vname="sscordermin05" autocomplete="off" maxlength="9" type="text" value="0">
            </td>
            <td><input name="d<?php echo $i ?>" vname="sscordermax05" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="sscitem05" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
            </td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="sscdiscountA05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="sscdiscountB05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="sscdiscountC05" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php } //if else end?>
    </tr>

<?php } //for end?>

</tbody>
<!-- 北京赛车 -->
<tbody id="pk10">
<tr>
    <td class="game-flag" colspan="15">
        <div>北京赛车</div>
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
<?php for ($i = 60; $i < 68; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>

        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="pk1000" vname="pk10ordermin00" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="pk10ordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="pk10item00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="pk10discountA00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="pk10discountB00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="pk10discountC00" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td class="games_sp"></td>
        <?php $i++; ?>
        <?php
        $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
        $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
        $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
        ?>
        <th><span class="playColor bZise">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="pk1013" vname="pk10ordermin13" autocomplete="off" maxlength="9" type="text" value="0">
        </td>
        <td><input name="d<?php echo $i ?>" vname="pk10ordermax13" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>"></td>
        <td><input name="e<?php echo $i ?>" vname="pk10item13" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="pk10discountA13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="pk10discountB13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="pk10discountC13" type="text"
                                        minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)"
                    name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
    </tr>
<?php }//北京赛车for end ?>

</tbody>
<!--幸运农场-->
<tbody id="nc">
<tr>
    <td class="game-flag" colspan="15">
        <div>幸运农场</div>
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
<?php for ($i = 123; $i < 136; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>

        <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="nc00" vname="ncordermin00" autocomplete="off" maxlength="9" type="text" value="2"></td>
        <td><input name="d<?php echo $i ?>" vname="ncordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td><input name="e<?php echo $i ?>" vname="ncitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="ncdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="ncdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="ncdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <!-- <td class="games_sp"></td><th>动物单选</th><td><input name="nc19" vname="ncordermin19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncordermax19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncitem19" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountA19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountB19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountC19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td> -->
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 136) {
        } else {

            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="nc20" vname="ncordermin20" autocomplete="off" maxlength="9" type="text" value="2"></td>
            <td><input name="d<?php echo $i ?>" vname="ncordermax20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="ncitem20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="ncdiscountA20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="ncdiscountB20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="ncdiscountC20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php }//if else end?>
    </tr>
<?php } //for end?>

<!--   <tr><th>果蔬单选</th><td><input name="nc18" vname="ncordermin18" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc18" vname="ncordermax18" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc18" vname="ncitem18" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountA18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountB18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc18" value="0.0" vname="ncdiscountC18" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td></tr> -->
</tbody>
<tbody id="ks">
<tr>
    <td colspan="15" class="game-flag">
        <div>江苏骰宝</div>
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
<?php for ($i = 162; $i < 166; $i++) { ?>
    <?php
    $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
    $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
    $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
    ?>
    <tr>
        <th><span class="playColor bZise">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
        <td><input name="nc00" vname="ncordermin00" autocomplete="off" maxlength="9" type="text" value="2"></td>
        <td><input name="d<?php echo $i ?>" vname="ncordermax00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
        </td>
        <td><input name="e<?php echo $i ?>" vname="ncitem00" autocomplete="off" maxlength="9" type="text"
                   value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
        <td>
            <div class="spaning"><input name="a<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                        vname="ncdiscountA00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="b<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                        vname="ncdiscountB00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <td>
            <div class="spaning"><input name="c<?php echo $i ?>"
                                        value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                        vname="ncdiscountC00" type="text" minvalue="0"
                                        maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                    href="javascript:void(0)" name="up"></a><a
                    href="javascript:void(0)" class="down" name="down"></a></div>
        </td>
        <!-- <td class="games_sp"></td><th>动物单选</th><td><input name="nc19" vname="ncordermin19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncordermax19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncitem19" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountA19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountB19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountC19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td> -->
        <td class="games_sp"></td>
        <?php $i++;
        if ($i >= 166) {
        } else {

            ?>
            <?php
            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
            ?>
            <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type'] ?></th>
            <td><input name="1" vname="ncordermin20" autocomplete="off" maxlength="9" type="text" value="2"></td>
            <td><input name="d<?php echo $i ?>" vname="ncordermax20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_d_limit'] : 0; ?>">
            </td>
            <td><input name="e<?php echo $i ?>" vname="ncitem20" autocomplete="off" maxlength="9" type="text"
                       value="<?php echo $count > 0 ? $result[$i]['g_e_limit'] : 0; ?>"></td>
            <td>
                <div class="spaning"><input name="a<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"
                                            vname="ncdiscountA20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="b<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"
                                            vname="ncdiscountB20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
            <td>
                <div class="spaning"><input name="c<?php echo $i ?>"
                                            value="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"
                                            vname="ncdiscountC20" type="text" minvalue="0"
                                            maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit'] : 0; ?>"><a
                        href="javascript:void(0)" name="up"></a><a
                        href="javascript:void(0)" class="down" name="down"></a></div>
            </td>
        <?php }//if else end?>
    </tr>
<?php } ?>
</tbody>
</table>
<div class="btn-line"><input type="submit" class="yellow-btn" id="submit"  value="确定" />
    <input
        type="reset" class="white-btn" id="reset" /></div>
</form>
</div>
</div>
</div>
</body>
</html>
