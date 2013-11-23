<div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
    <div id="member" class="member">
        <div class="title"><span id="account_name">修改<?php echo $Rank[0] ?><?php echo $userList[0]['g_f_name'] ?>
            </span>上级<span id="superior"><?php echo $Rank[1] ?>？？？</span><a href="javascript:void(0)"
                                                                                          id="reback" level="1"
                                                                                          class="mag-btn1">返回</a></div>
        <form id="user_info">
            <table class="clear-table base-info">
                <caption>
                    <div>基本资料</div>
                </caption>
                <tbody>
                <tr>
                    <th>名称</th>
                    <td><input autocomplete="off" name="name" type="text" vname="name"
                               vmessage="由汉字的简繁体(一个汉字2位字符)、圆点(.)、字母、数字、下划线组成，长度不超过16个英文字符或8个汉字！"
                               value="<?php echo $userList[0]['g_f_name'] ?>"></td>
                    <th>账号</th>
                    <td><input autocomplete="off" name="account" type="text" vname="account"
                               vmessage="账号由1-12位英文字母、数字、下划线组成，且第一位不能是下划线！" value="<?php echo $userList[0]['g_name'] ?>" class=""></td>
                    <th>密码</th>
                    <td><input autocomplete="off" name="password" type="password" vname="password"
                               vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
                    <th>确认密码</th>
                    <td class="error-info"><input autocomplete="off" name="repassword" type="password"
                                                  vname="repassword" vmessage="6~16位数字、字母组成！(为空表示密码不修改)" value=""></td>
                </tr>
                <tr>
                    <th>总信用额度</th>
                    <td><input autocomplete="off" type="text" name="credit" maxlength="9" vname="credit"
                               vmessage="10000~47000" title="10000~47000" value="<?php echo $userList[0]['g_money'] ?>"></td>
                    <th>所属盘口</th>
                    <td><select name="odds_set"></select>？？盘</td>
                    <th>状态</th>
                    <td><select name="status">
                        <option value="0"
                        <?php if ($userList[0]['g_lock'] == 3) {
                                            echo 'selected=""';
                                        }
                                >停用</option>
                        <option value="2"
                        <?php if ($userList[0]['g_lock'] == 2) {
                                            echo 'selected=""';
                                        } ?>
                                >停押</option>
                        <option value="1"
                        <?php if ($userList[0]['g_lock'] == 1) {
                                echo 'selected=""';
                                }
                        ?>
                                >启用</option>
                    </select></td>
                    <th>补货设定</th>
                    <td><label for="short_covering1"><input id="short_covering1" value="true" name="short_covering"
                                                            type="radio"
                        <?php if ($userList[0]['g_Immediate_lock'] == 1) {
                                                echo 'checked="checked"';
                                            } ?>
                        >允许</label>
                        <label for="short_covering2"><input id="short_covering2" value="false" name="short_covering"
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
                    <th name="currentname">股东及下级占成权限总和(%)??</th>
                    <td><!--<select name='share_total'><option value="0"></option></select>-->
                        <div class="share_up_div"><input name="share_total" type="text" maxlength="3"
                                                         vname="share_total" value=""> <a href="javascript:void(0)"
                                                                                          class="select"
                                                                                          id="share_total"></a>
                            <ul id="share_total_list" class="share_up_list">
                                <li>0</li>
                            </ul>
                        </div>
                    </td>
                    <th name="parentname">分公司占成(%)</th>
                    <td><!--<select name='share_up'><option value="0"></option></select>-->
                        <div class="share_up_div"><input name="share_up" type="text" maxlength="3" vname="share_up"
                                                         value=""> <a href="javascript:void(0)" class="select"
                                                                      id="share_up"></a>
                            <ul id="share_up_list" class="share_up_list" style="display: none;">
                                <li>0</li>
                                <li>5</li>
                                <li>10</li>
                                <li>15</li>
                                <li>20</li>
                                <li>25</li>
                                <li>30</li>
                                <li>35</li>
                                <li>40</li>
                                <li>45</li>
                                <li>50</li>
                                <li>55</li>
                                <li>60</li>
                                <li>65</li>
                                <li>70</li>
                                <li>75</li>
                                <li>80</li>
                                <li>85</li>
                                <li>90</li>
                                <li>95</li>
                            </ul>
                        </div>
                    </td>
                    <th>倍数投注</th>
                    <td><label for="beishu_set1"><input id="beishu_set1" value="true" name="beishu_set" type="radio">允许</label><label
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
                </tbody>
            </table>
        </form>
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
            <?php for ($i=8; $i<26; $i++){?>
            <tr>
                <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type']?></th>
                <td><input name="klc00" vname="klcordermin00" autocomplete="off" maxlength="9" type="text" value="0">
                </td>
                <td><input name="klc00" vname="klcordermax00" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_d_limit']:0;?>"></td>
                <td><input name="klc00" vname="klcitem00" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_e_limit']:0;?>">
                </td>
                <td>
                    <div class="spaning"><input name="klc00" value="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>" vname="klcdiscountA00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="klc00" value="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>" vname="klcdiscountB00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="klc00" value="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>" vname="klcdiscountC00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <?php $i++; ?>
                <th><span class="playColor bGreen">&nbsp;</span><?php echo $result[$i]['g_type']?></th>
                <td><input name="klc18" vname="klcordermin18" autocomplete="off" maxlength="9" type="text" value="0">
                </td>
                <td><input name="klc18" vname="klcordermax18" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_d_limit']:0;?>">
                </td>
                <td><input name="klc18" vname="klcitem18" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_e_limit']:0;?>">
                </td>
                <td>
                    <div class="spaning"><input name="klc18" value="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>" vname="klcdiscountA18" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="klc18" value="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>" vname="klcdiscountB18" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="klc18" value="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>" vname="klcdiscountC18" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <?php }?>
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
            <?php for ($i=31; $i<39; $i++){?>
            <tr>
                <th><span class="playColor bBlue">&nbsp;</span><?php echo $result[$i]['g_type']?></th>
                <td><input name="ssc00" vname="sscordermin00" autocomplete="off" maxlength="9" type="text" value="0">
                </td>
                <td><input name="ssc00" vname="sscordermax00" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_d_limit']:0;?>"></td>
                <td><input name="ssc00" vname="sscitem00" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_e_limit']:0;?>">
                </td>
                <td>
                    <div class="spaning"><input name="ssc00" value="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>" vname="sscdiscountA00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="ssc00" value="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>" vname="sscdiscountB00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="ssc00" value="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>" vname="sscdiscountC00" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <?php $i++;
                    if ($i >= 39){
                    }
                    else {
                ?>
                <th><span class="playColor bRed">&nbsp;</span><?php echo $result[$i]['g_type']?></th>
                <td><input name="ssc05" vname="sscordermin05" autocomplete="off" maxlength="9" type="text" value="0">
                </td>
                <td><input name="ssc05" vname="sscordermax05" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_d_limit']:0;?>">
                </td>
                <td><input name="ssc05" vname="sscitem05" autocomplete="off" maxlength="9" type="text"
                           value="<?php echo $count > 0 ? $result[$i]['g_e_limit']:0;?>">
                </td>
                <td>
                    <div class="spaning"><input name="ssc05" value="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>" vname="sscdiscountA05" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_a_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="ssc05" value="<?php echo $count > 0 ? $result[$i]['g_b_limit']:0;?>" vname="sscdiscountB05" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="ssc05" value="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>" vname="sscdiscountC05" type="text" minvalue="0"
                                                maxvalue="<?php echo $count > 0 ? $result[$i]['g_c_limit']:0;?>"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <?php } //if else end?>
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
            <tr>
                <th><span class="playColor bBlue">&nbsp;</span>冠亚,3~10单码</th>
                <td><input name="pk1000" vname="pk10ordermin00" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1000" vname="pk10ordermax00" autocomplete="off" maxlength="9" type="text"
                           value="20000"></td>
                <td><input name="pk1000" vname="pk10item00" autocomplete="off" maxlength="9" type="text" value="50000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1000" value="0.6" vname="pk10discountA00" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1000" value="1.6" vname="pk10discountB00" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1000" value="2.6" vname="pk10discountC00" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bZise">&nbsp;</span>冠亚大小</th>
                <td><input name="pk1013" vname="pk10ordermin13" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1013" vname="pk10ordermax13" autocomplete="off" maxlength="9" type="text"
                           value="100000"></td>
                <td><input name="pk1013" vname="pk10item13" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1013" value="0.6" vname="pk10discountA13" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1013" value="1.6" vname="pk10discountB13" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1013" value="2.6" vname="pk10discountC13" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>1~10两面</th>
                <td><input name="pk1010" vname="pk10ordermin10" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1010" vname="pk10ordermax10" autocomplete="off" maxlength="9" type="text"
                           value="100000"></td>
                <td><input name="pk1010" vname="pk10item10" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1010" value="0.6" vname="pk10discountA10" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1010" value="1.6" vname="pk10discountB10" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1010" value="2.6" vname="pk10discountC10" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bZise">&nbsp;</span>冠亚单双</th>
                <td><input name="pk1014" vname="pk10ordermin14" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1014" vname="pk10ordermax14" autocomplete="off" maxlength="9" type="text"
                           value="100000"></td>
                <td><input name="pk1014" vname="pk10item14" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1014" value="0.6" vname="pk10discountA14" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1014" value="1.6" vname="pk10discountB14" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1014" value="2.6" vname="pk10discountC14" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>1~5龙虎</th>
                <td><input name="pk1012" vname="pk10ordermin12" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1012" vname="pk10ordermax12" autocomplete="off" maxlength="9" type="text"
                           value="100000"></td>
                <td><input name="pk1012" vname="pk10item12" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1012" value="0.6" vname="pk10discountA12" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1012" value="1.6" vname="pk10discountB12" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1012" value="2.6" vname="pk10discountC12" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bRed">&nbsp;</span>冠亚和</th>
                <td><input name="pk1015" vname="pk10ordermin15" autocomplete="off" maxlength="9" type="text" value="2">
                </td>
                <td><input name="pk1015" vname="pk10ordermax15" autocomplete="off" maxlength="9" type="text"
                           value="10000"></td>
                <td><input name="pk1015" vname="pk10item15" autocomplete="off" maxlength="9" type="text" value="30000">
                </td>
                <td>
                    <div class="spaning"><input name="pk1015" value="0.6" vname="pk10discountA15" type="text"
                                                minvalue="0" maxvalue="0.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1015" value="1.6" vname="pk10discountB15" type="text"
                                                minvalue="0" maxvalue="1.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="pk1015" value="2.6" vname="pk10discountC15" type="text"
                                                minvalue="0" maxvalue="2.6"><a href="javascript:void(0)"
                                                                               name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
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
            <tr>
                <th><span class="playColor bBlue">&nbsp;</span>1~8单码</th>
                <td><input name="nc00" vname="ncordermin00" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc00" vname="ncordermax00" autocomplete="off" maxlength="9" type="text" value="20000">
                </td>
                <td><input name="nc00" vname="ncitem00" autocomplete="off" maxlength="9" type="text" value="40000"></td>
                <td>
                    <div class="spaning"><input name="nc00" value="0.6" vname="ncdiscountA00" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc00" value="1.6" vname="ncdiscountB00" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc00" value="2.6" vname="ncdiscountC00" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <!-- <td class="games_sp"></td><th>动物单选</th><td><input name="nc19" vname="ncordermin19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncordermax19" autocomplete="off" maxlength="9" type="text"></td><td><input name="nc19" vname="ncitem19" autocomplete="off" maxlength="9" type="text"></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountA19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountB19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td><td><div class="spaning"><input name="nc19" value="0.0" vname="ncdiscountC19" type="text"><a href="javascript:void(0)" name="up"></a><a href="javascript:void(0)" class="down" name="down"></a></div></td> -->
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>任选二</th>
                <td><input name="nc20" vname="ncordermin20" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc20" vname="ncordermax20" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc20" vname="ncitem20" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc20" value="0.6" vname="ncdiscountA20" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc20" value="1.6" vname="ncdiscountB20" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc20" value="2.6" vname="ncdiscountC20" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bBlue">&nbsp;</span>正码</th>
                <td><input name="nc29" vname="ncordermin29" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc29" vname="ncordermax29" autocomplete="off" maxlength="9" type="text" value="20000">
                </td>
                <td><input name="nc29" vname="ncitem29" autocomplete="off" maxlength="9" type="text" value="40000"></td>
                <td>
                    <div class="spaning"><input name="nc29" value="0.6" vname="ncdiscountA29" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc29" value="1.6" vname="ncdiscountB29" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc29" value="2.6" vname="ncdiscountC29" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>选二连直</th>
                <td><input name="nc22" vname="ncordermin22" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc22" vname="ncordermax22" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc22" vname="ncitem22" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc22" value="0.6" vname="ncdiscountA22" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc22" value="1.6" vname="ncdiscountB22" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc22" value="2.6" vname="ncdiscountC22" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>1~8两面</th>
                <td><input name="nc08" vname="ncordermin08" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc08" vname="ncordermax08" autocomplete="off" maxlength="9" type="text" value="100000">
                </td>
                <td><input name="nc08" vname="ncitem08" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="nc08" value="0.6" vname="ncdiscountA08" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc08" value="1.6" vname="ncdiscountB08" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc08" value="2.6" vname="ncdiscountC08" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>选二连组</th>
                <td><input name="nc21" vname="ncordermin21" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc21" vname="ncordermax21" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc21" vname="ncitem21" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc21" value="0.6" vname="ncdiscountA21" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc21" value="1.6" vname="ncdiscountB21" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc21" value="2.6" vname="ncdiscountC21" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>总和两面</th>
                <td><input name="nc12" vname="ncordermin12" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc12" vname="ncordermax12" autocomplete="off" maxlength="9" type="text" value="100000">
                </td>
                <td><input name="nc12" vname="ncitem12" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="nc12" value="0.6" vname="ncdiscountA12" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc12" value="1.6" vname="ncdiscountB12" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc12" value="2.6" vname="ncdiscountC12" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>任选三</th>
                <td><input name="nc23" vname="ncordermin23" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc23" vname="ncordermax23" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc23" vname="ncitem23" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc23" value="0.6" vname="ncdiscountA23" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc23" value="1.6" vname="ncdiscountB23" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc23" value="2.6" vname="ncdiscountC23" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bRed">&nbsp;</span>1~8中发白</th>
                <td><input name="nc15" vname="ncordermin15" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc15" vname="ncordermax15" autocomplete="off" maxlength="9" type="text" value="20000">
                </td>
                <td><input name="nc15" vname="ncitem15" autocomplete="off" maxlength="9" type="text" value="60000"></td>
                <td>
                    <div class="spaning"><input name="nc15" value="0.6" vname="ncdiscountA15" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc15" value="1.6" vname="ncdiscountB15" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc15" value="2.6" vname="ncdiscountC15" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>选三前组</th>
                <td><input name="nc30" vname="ncordermin30" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc30" vname="ncordermax30" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc30" vname="ncitem30" autocomplete="off" maxlength="9" type="text" value="2000"></td>
                <td>
                    <div class="spaning"><input name="nc30" value="0.6" vname="ncdiscountA30" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc30" value="1.6" vname="ncdiscountB30" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc30" value="2.6" vname="ncdiscountC30" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bRed">&nbsp;</span>1~8东南西北</th>
                <td><input name="nc16" vname="ncordermin16" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc16" vname="ncordermax16" autocomplete="off" maxlength="9" type="text" value="20000">
                </td>
                <td><input name="nc16" vname="ncitem16" autocomplete="off" maxlength="9" type="text" value="60000"></td>
                <td>
                    <div class="spaning"><input name="nc16" value="0.6" vname="ncdiscountA16" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc16" value="1.6" vname="ncdiscountB16" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc16" value="2.6" vname="ncdiscountC16" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>任选四</th>
                <td><input name="nc26" vname="ncordermin26" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc26" vname="ncordermax26" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc26" vname="ncitem26" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc26" value="0.6" vname="ncdiscountA26" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc26" value="1.6" vname="ncdiscountB26" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc26" value="2.6" vname="ncdiscountC26" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>1~4龙虎</th>
                <td><input name="nc17" vname="ncordermin17" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc17" vname="ncordermax17" autocomplete="off" maxlength="9" type="text" value="100000">
                </td>
                <td><input name="nc17" vname="ncitem17" autocomplete="off" maxlength="9" type="text" value="200000">
                </td>
                <td>
                    <div class="spaning"><input name="nc17" value="0.6" vname="ncdiscountA17" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc17" value="1.6" vname="ncdiscountB17" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc17" value="2.6" vname="ncdiscountC17" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>任选五</th>
                <td><input name="nc27" vname="ncordermin27" autocomplete="off" maxlength="9" type="text" value="2"></td>
                <td><input name="nc27" vname="ncordermax27" autocomplete="off" maxlength="9" type="text" value="2000">
                </td>
                <td><input name="nc27" vname="ncitem27" autocomplete="off" maxlength="9" type="text" value="5000"></td>
                <td>
                    <div class="spaning"><input name="nc27" value="0.6" vname="ncdiscountA27" type="text" minvalue="0"
                                                maxvalue="0.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc27" value="1.6" vname="ncdiscountB27" type="text" minvalue="0"
                                                maxvalue="1.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
                <td>
                    <div class="spaning"><input name="nc27" value="2.6" vname="ncdiscountC27" type="text" minvalue="0"
                                                maxvalue="2.6"><a href="javascript:void(0)" name="up"></a><a
                            href="javascript:void(0)" class="down" name="down"></a></div>
                </td>
            </tr>
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
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>大小</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin00" name="ks00" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax00" name="ks00" value="100000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem00" name="ks00" value="200000">
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA00" value="0.6" name="ks00" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB00" value="1.6" name="ks00" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC00" value="2.6" name="ks00" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bRed">&nbsp;</span>点数</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin04" name="ks04" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax04" name="ks04" value="5000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem04" name="ks04" value="20000"></td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA04" value="0.6" name="ks04" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB04" value="1.6" name="ks04" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC04" value="2.6" name="ks04" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bZise">&nbsp;</span>三军</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin01" name="ks01" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax01" name="ks01" value="100000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem01" name="ks01" value="200000">
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA01" value="0.6" name="ks01" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB01" value="1.6" name="ks01" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC01" value="2.6" name="ks01" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>长牌</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin05" name="ks05" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax05" name="ks05" value="2000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem05" name="ks05" value="5000"></td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA05" value="0.6" name="ks05" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB05" value="1.6" name="ks05" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC05" value="2.6" name="ks05" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bGreen">&nbsp;</span>围骰</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin02" name="ks02" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax02" name="ks02" value="2000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem02" name="ks02" value="5000"></td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA02" value="0.6" name="ks02" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB02" value="1.6" name="ks02" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC02" value="2.6" name="ks02" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td class="games_sp"></td>
                <th><span class="playColor bGreen">&nbsp;</span>短牌</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin06" name="ks06" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax06" name="ks06" value="2000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem06" name="ks06" value="5000"></td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA06" value="0.6" name="ks06" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB06" value="1.6" name="ks06" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC06" value="2.6" name="ks06" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
            </tr>
            <tr>
                <th><span class="playColor bGreen">&nbsp;</span>全骰</th>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermin03" name="ks03" value="2"></td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksordermax03" name="ks03" value="2000">
                </td>
                <td><input type="text" maxlength="9" autocomplete="off" vname="ksitem03" name="ks03" value="5000"></td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountA03" value="0.6" name="ks03" minvalue="0"
                                                maxvalue="0.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountB03" value="1.6" name="ks03" minvalue="0"
                                                maxvalue="1.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td>
                    <div class="spaning"><input type="text" vname="ksdiscountC03" value="2.6" name="ks03" minvalue="0"
                                                maxvalue="2.6"><a name="up" href="javascript:void(0)"></a><a name="down"
                                                                                                             class="down"
                                                                                                             href="javascript:void(0)"></a>
                    </div>
                </td>
                <td class="games_sp"></td>
            </tr>
            </tbody>
        </table>
        <div class="btn-line"><a type="button" class="yellow-btn" id="submit" href="javascript:void(0)">确定</a><a
                type="reset" class="white-btn" id="reset" href="javascript:void(0)">取 消</a></div>
    </div>
</div>