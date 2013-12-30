<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 13-12-26
 * Time: 上午12:08
 */

$lang = new utf8_lang();

//获取游戏的开放情况
$configModel = configModel("g_kg_game_lock,g_cq_game_lock,g_gx_game_lock,g_pk_game_lock,g_nc_game_lock,g_lhc_game_lock,g_xj_game_lock,g_jsk3_game_lock");
?>
<table border="0" cellpadding="0" cellspacing="0" class="t_list">
    <tr>
        <td class="t_list_caption redbg" colspan="2">账户信息</td>
    </tr>
    <tr>
        <td class="t_td_caption_1" width="71">账号：</td>
        <td class="t_td_text" width="137"><?php echo $user[0]['g_name'] ?>(<label
                id="pls"><?php echo strtoupper($user[0]['g_panlu']) ?></label>盘)
        </td>
    </tr>
    <tr>
        <td class="t_td_caption_1">信用额度：</td>
        <td class="t_td_text"><?php echo is_Number($user[0]['g_money']) ?></td>
    </tr>
    <tr>
        <td class="t_td_caption_1">信用余额：</td>
        <td id="jine" class="t_td_text" style="font-weight:bold;"><?php echo is_Number($user[0]['g_money_yes']) ?></td>
    </tr>
    <tr>
        <td class="t_td_caption_1">已下金额：</td>
        <td class="t_td_text">功能未做</td>
    </tr>


    <!--新旧版跳转临时按钮-->
    <tr>
        <td class="t_list_caption left_version" colspan="2"><a href="/index.php?version=hk" target="_parent">新版</a></td>
    </tr>
    <!--临时按钮end-->
    <?php if ($configModel['g_kg_game_lock'] == 1) { ?>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a
                    href="http://baidu.lehecai.com/lottery/draw/view/544?agentId=5555" target="_blank">"广东快乐十分"开奖网</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <?php if ($configModel['g_cq_game_lock'] == 1) { ?>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://video.shishicai.cn/cqssc/" target="_blank">"重庆时时彩"开奖网</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <?php if ($configModel['g_pk_game_lock'] == 1) { ?>
        <tr>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://www.bwlc.net/buy/trax/" target="_blank">"北京赛车(PK10)"官网</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <?php if ($configModel['g_nc_game_lock'] == 1) { ?>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://www.16cp.com/gamedraw/lucky/open.shtml"
                                                              target="_blank">"幸运农场"官网</a></td>
        </tr>
    <?php
    }
    ?>
    <?php if ($configModel['g_gx_game_lock'] == 1) { ?>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://video.shishicai.cn/haoma/gxkl10/list/50.aspx"
                                                              target="_blank">"广西快乐十分"开奖网</a></td>
        </tr>
    <?php
    }
    ?>

    <?php if ($configModel['g_xj_game_lock'] == 1) { ?>
        <tr>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://www.xjflcp.com/ssc/" target="_blank">"新疆时时彩"开奖网</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <?php if ($configModel['g_jsk3_game_lock'] == 1) { ?>
        <tr>
        <tr>
            <td class="t_list_caption font_st" colspan="2"><a href="http://www.cailele.com/lottery/k3/" target="_blank">"江苏骰宝（快3）"开奖网</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <tr class="hide-successinfo t1" style="display: table-row;">
        <td style="text-align:center;text-indent:0;" colspan="2"><a class="btn_m elem_btn" href="../left.php"
                                                                    id="sideLeftBack">返回</a></td>
    </tr>
    <tr id="left_times_title" class="t1" style="display: table-row;">
        <th colspan="2"><h3 class="red-title center"><?php echo $number_1 ?>&nbsp;期</h3></th>
    </tr>
</table>
<div id="successinfo" class="success-info" style="display: block;">
    <ul>
        <li class="failure" style="display: none;">
            <table>
                <tbody>
                <tr>
                    <td id="f-list">
                        <dl>
                            <dt><span class="bluer">第一球 8</span> @ <span class="red">9.8</span></dt>
                            <dd class="red"></dd>
                        </dl>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="center mrg20"><a href="javascript:void(0)" class="btn_m elem_btn l-c-b del-failure-info"
                                       id="sideLeftCancel">取消</a></p></li>
        <li class="failure-odd-change" style="display: none;">
            <dl>
                <dt><span class="bluer">第一球 8</span> @ <span class="red">9.8</span></dt>
                <dd class="red"></dd>
            </dl>
            <p class="center mrg20"><a href="javascript:void(0)" class="btn_m elem_btn l-c-b" style="color: white;">
                    取消</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="btn_m elem_btn l-c-b-t2 ft000"
                                         style="color: white;">确定下注</a></p></li>
        <li class="success" style="">
            <table class="t1 bg_white dataArea">
                <thead style="visibility:hidden;">
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tbody id="s-list">
                <?php if ($action == 'fn2') {
                    if ($stringList['type'] == '选二连直') {
                        $ball_array = explode('|', $s_ball);
                        $s_ball = "前位 " . $ball_array[0] . '</br>后位 ' . $ball_array[1];
                    }
                    ?>
                    <tr>
                        <td colspan="3"><p>注单号：<span class="greener"><?php  echo $ListArr[0]['id']?></span></p>

                            <p class="text-i-em3"><span class="bluer"><?php echo $stringList['type']?></span>&nbsp; @ &nbsp;<b class="red"><?php echo $odds ?></b></p>

                            <p class="text-i-em3"><span class="black">复式[<?php echo $results[0] ?>组]</span></p>

                            <p class="text-i-em3" style="text-indent:0"><span class="black"><?php echo $s_ball ?></span></p>

                            <p>分组：<span class="black" style="padding-left:1em"><?php echo $results[0] ?>组</span></p>

                            <p>下注额：<span class="black"><?php echo $countZhuEr?></span></p>

                            <p>可赢额：<span class="black"><?php echo $ListArr[0]['KeYing']?></span></p></td>
                    </tr>
                    <tr>
                        <th class="db-bg">ID</th>
                        <th class="db-bg">号码组合</th>
                        <th class="db-bg">下注额</th>
                    </tr>
                    <?php
                    for ($i=0; $i<count($results[1]); $i++) {
                        $s = $i+1;
                        ?>
                        <tr>
                            <td><?php  echo $s?></td>
                            <td><?php echo $results[1][$i]?></td>
                            <td><?php echo $s_money?></td>
                        </tr>
                    <?php } ?>
                <?php
                } else if ($action == 'fn' || $action == 'fn1' || $action == 'fn3') { //單筆循環投注單
                    for ($i=0; $i<count($ListArr); $i++) {
                        $nn = $ListArr[$i]['g_mingxi_1'] == '總和、龍虎' ? $ListArr[$i]['g_mingxi_2'] : $ListArr[$i]['g_mingxi_1'].' '.$ListArr[$i]['g_mingxi_2'].'';
                        ?>
                        <tr>
                            <td colspan="3"><p>注单号：<span class="greener"><?php echo  $ListArr[$i]['id']?></span></p>

                                <p class="text-i-em3"><span class="bluer"><?php echo $lang->hk_cn($nn)?></span>&nbsp; @ &nbsp;<b
                                        class="red"><?php echo $ListArr[$i]['g_odds'] ?></b></p>

                                <p>下注额：<span class="black"><?php echo $ListArr[$i]['g_jiner'] ?></span></p>

                                <p>可赢额：<span class="black"><?php echo $ListArr[$i]['KeYing'] ?></span></p></td>
                        </tr>
                    <?php
                    }
                }?>
                </tbody>
                <tfoot>
                <tr>
                    <td class="inner_text td_h" colspan="2" style="width:75px">下注笔数</td>
                    <td class="db-bg" style="width:147px"><span class="black suc_zhus"><?php echo $countBiShu?>笔</span></td>
                </tr>
                <tr>
                    <td class="inner_text td_h" colspan="2" style="width:75px">合计注额</td>
                    <td class="db-bg"><b class="reder suc_t_amount"><?php echo $countZhuEr?></b></td>
                </tr>
                </tfoot>
            </table>
        </li>
    </ul>
</div>

