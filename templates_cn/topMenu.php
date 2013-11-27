<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
global $user;
$db = new DB();
$sql = "SELECT `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$user[0]['g_name']}' ORDER BY g_id DESC ";
$result = $db->query($sql, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="js/sc.js"></script>
    <link rel="stylesheet" href="/wjl_tmp/steal_front.css"/>
    <title>PHP</title>
</head>
<body class="skin_brown">
    <div class="mains_corll">
            <div id="infop" class="dataArea" tmp="infop">
                <div style="height:4px;visibility:hidden;font-size:0"></div>
                <table class="t1 w100">
                    <colgroup>
                        <col class="col_single">
                        <col>
                        <col class="col_single">
                        <col>
                        <col class="col_single">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="6">
                            <div class="t">基本信息</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">账号</td>
                        <td id="account" class=""><?php echo $user[0]['g_name'] ?></td>
                        <td class="">会员名称</td>
                        <td id="name" class=""><?php echo $user[0]['g_f_name'] ?></td>
                        <td>信用额度</td>
                        <td id="credit"><?php echo $user[0]['g_money'] ?></td>
                    </tr>
                    <tr>
                        <td class="">账号状态</td>
                        <td id="status" class="">    <?php
                            switch ($user[0]['g_look']) {
                                case 3:
                                    echo '停用';
                                    break;
                                case 2:
                                    echo '停押';
                                    break;
                                case 1:
                                    echo '启用';
                                    break;
                            }
                            ?></td>
                        <td class="">所属盘口</td>
                        <td id="odds_set" class=""><?php echo $user[0]['g_look'] ?>盘</td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <div id="infop_klc">
                    <div class="game-left" id="infoklcl">
                        <table class="t1 w100">
                            <colgroup>
                                <col class="col_single">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>单注最低</th>
                                <th>单注最高</th>
                                <th>单项最高</th>
                                <th>退水(%)</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php for ($i = 0; $i < 26; $i++) {

                            $result[$i]['g_a_limit'] = 100 - $result[$i]['g_a_limit'];
                            $result[$i]['g_b_limit'] = 100 - $result[$i]['g_b_limit'];
                            $result[$i]['g_c_limit'] = 100 - $result[$i]['g_c_limit'];
                            ?>
                            <tr>
                                <th><?php echo $result[$i]['g_type'] ?></th>
                                <td class="">2</td>
                                <td><?php echo $result[$i]['g_d_limit'] ?></td>
                                <td><?php echo $result[$i]['g_e_limit'] ?></td>
                                <td><?php echo $result[$i]['g_a_limit'] ?>%</td>
                                <td><?php echo $result[$i]['g_b_limit'] ?>%</td>
                                <td><?php echo $result[$i]['g_c_limit'] ?>%</td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="game-right" id="infoklcr">
                        <table class="t1 w100">
                            <colgroup>
                                <col class="col_single">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>单注最低</th>
                                <th>单注最高</th>
                                <th>单项最高</th>
                                <th>退水(%)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>总和单双</th>
                                <td class="">2</td>
                                <td>50,000</td>
                                <td>100,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>总和大小</th>
                                <td class="">2</td>
                                <td>50,000</td>
                                <td>100,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>总和尾大尾小</th>
                                <td class="">2</td>
                                <td>50,000</td>
                                <td>100,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>1~8 中发白</th>
                                <td class="">2</td>
                                <td>30,000</td>
                                <td>60,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>1~8 方位</th>
                                <td>2</td>
                                <td>30,000</td>
                                <td>60,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>1~4 龙虎</th>
                                <td>2</td>
                                <td>50,000</td>
                                <td>100,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>任选二</th>
                                <td>2</td>
                                <td>5,000</td>
                                <td>10,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>选二连组</th>
                                <td>2</td>
                                <td>1,000</td>
                                <td>5,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>任选三</th>
                                <td>2</td>
                                <td>1,000</td>
                                <td>5,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>选三前组</th>
                                <td>2</td>
                                <td>20</td>
                                <td>100</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>任选四</th>
                                <td>2</td>
                                <td>1,000</td>
                                <td>2,000</td>
                                <td>0.73%</td>
                            </tr>
                            <tr>
                                <th>任选五</th>
                                <td>2</td>
                                <td>1,000</td>
                                <td>3,000</td>
                                <td>0.73%</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


</body>
</html>