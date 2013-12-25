<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'function/cheCookie.php';
global $user;

if (!isset($_GET['type'])) {
    if ((isset($_SESSION['cq']) && $_SESSION['cq'] == true))
        $type= 2;
    else if ((isset($_SESSION['gx']) && $_SESSION['gx'] == true))
        $type= 3;
    else if ((isset($_SESSION['nc']) && $_SESSION['nc'] == true))
        $type= 5;
    else if ((isset($_SESSION['pk']) && $_SESSION['pk'] == true))
        $type= 6;
    else if ((isset($_SESSION['lhc']) && $_SESSION['lhc'] == true))
        $type= 7;
    else if ((isset($_SESSION['xj']) && $_SESSION['xj'] == true))
        $type= 8;
    else if ((isset($_SESSION['jsk3']) && $_SESSION['jsk3'] == true))
        $type= 9;
    else
        $type= 1;
} else {
    $type = $_GET['type'];
}
//test
//var_dump($user);

$panlu = $user[0]['g_panlu'];
$send_back = $user[0]['g_distribution'];
if ($panlu == 'A') {
    $sql_panlu = "g_panlu_a";
} elseif ($panlu == 'B') {
    $sql_panlu = "g_panlu_b";
} elseif ($sql_panlu == 'C') {
    $sql_panlu = "g_panlu_c";
} else {
    exit(back("盘路错误"));
}

$db = new DB();
$sql = "SELECT `g_type`, {$sql_panlu} as g_tuishui,`g_danzhu_min`,`g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$user[0]['g_name']}' and g_game_id={$type} ORDER BY g_id DESC ";
$result = $db->query($sql, 1);
//var_dump($result);
$lang = new utf8_lang();

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
        <td id="odds_set" class=""><?php echo $user[0]['g_panlu'] ?>盘</td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
<?php if ($type == 1) { ?>
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

                <?php for ($i = 0; $i < 13; $i++) {

                    ?>
                    <tr>
                        <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                        <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                        <td><?php echo $result[$i]['g_danzhu'] ?></td>
                        <td><?php echo $result[$i]['g_danxiang'] ?></td>
                        <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
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
                <?php for ($i = 13; $i < count($result); $i++) {

                    ?>
                    <tr>
                        <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                        <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                        <td><?php echo $result[$i]['g_danzhu'] ?></td>
                        <td><?php echo $result[$i]['g_danxiang'] ?></td>
                        <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } elseif ($type == 2) { ?>
    <div id="infop_ssc">
        <table class="t1 w100">
            <colgroup>
                <col class="col_single">
            </colgroup>
            <thead>
            <tr>
                <th>这里项目对不上</th>
                <th>单码</th>
                <th>两面</th>
                <th>龙虎</th>
                <th>和</th>
                <th>豹子</th>
                <th>顺子</th>
                <th>对子</th>
                <th>半顺</th>
                <th>杂六</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>单注最低</th>
                <td name="00" class="">2</td>
                <td name="01" class="">2</td>
                <td name="02" class="">2</td>
                <td name="03">2</td>
                <td name="04">2</td>
                <td name="05">2</td>
                <td name="06">2</td>
                <td name="07">2</td>
                <td name="08">2</td>
            </tr>
            <tr>
                <th>单注最高</th>
                <td name="00">20,000</td>
                <td name="01">200,000</td>
                <td name="02">200,000</td>
                <td name="03">200,000</td>
                <td name="04">10,000</td>
                <td name="05">10,000</td>
                <td name="06">10,000</td>
                <td name="07">10,000</td>
                <td name="08">10,000</td>
            </tr>
            <tr>
                <th>单项最高</th>
                <td name="00">100,000</td>
                <td name="01">1,000,000</td>
                <td name="02">1,000,000</td>
                <td name="03">1,000,000</td>
                <td name="04">30,000</td>
                <td name="05">30,000</td>
                <td name="06">30,000</td>
                <td name="07">30,000</td>
                <td name="08">30,000</td>
            </tr>
            <tr>
                <th>退水</th>
                <td name="00">0.6%</td>
                <td name="01">0.6%</td>
                <td name="02">0.6%</td>
                <td name="03">0.6%</td>
                <td name="04">0.6%</td>
                <td name="05">0.6%</td>
                <td name="06">0.6%</td>
                <td name="07">0.6%</td>
                <td name="08">0.6%</td>
            </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
<?php } elseif ($type == 6) { ?>
    <div class="infop-pk10 of-h" id="infop_pk10">
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
            <?php for ($i = 0; $i < count($result); $i++) {

                ?>
                <tr>
                    <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                    <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                    <td><?php echo $result[$i]['g_danzhu'] ?></td>
                    <td><?php echo $result[$i]['g_danxiang'] ?></td>
                    <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif ($type == 5) { ?>
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
                <?php for ($i = 0; $i < 13; $i++) {

                    ?>
                    <tr>
                        <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                        <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                        <td><?php echo $result[$i]['g_danzhu'] ?></td>
                        <td><?php echo $result[$i]['g_danxiang'] ?></td>
                        <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
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
                <?php for ($i = 13; $i < count($result); $i++) {

                    ?>
                    <tr>
                        <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                        <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                        <td><?php echo $result[$i]['g_danzhu'] ?></td>
                        <td><?php echo $result[$i]['g_danxiang'] ?></td>
                        <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } elseif ($type == 9) { ?>
    <div class="infop-pk10 of-h" id="infop_pk10">
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
            <?php for ($i = 0; $i < count($result); $i++) {

                ?>
                <tr>
                    <th><?php echo $lang->hk_cn($result[$i]['g_type']) ?></th>
                    <td class=""><?php echo $result[$i]['g_danzhu_min'] ?></td>
                    <td><?php echo $result[$i]['g_danzhu'] ?></td>
                    <td><?php echo $result[$i]['g_danxiang'] ?></td>
                    <td><?php echo 100 - $result[$i]['g_tuishui'] ?>%</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>

</div>
</div>


</body>
</html>