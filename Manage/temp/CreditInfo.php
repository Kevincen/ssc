<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
global $Users, $LoginId, $userModel;
if ( /*$LoginId ==56 || */ //by wjl
    $LoginId == 89
) exit;

$db = new DB();
$sql = "SELECT `g_type`, `g_a_limit`, `g_b_limit`, `g_c_limit`, `g_d_limit`, `g_e_limit`  
FROM g_send_back WHERE g_name = '{$Users[0]['g_name']}' ORDER BY g_id DESC";
$result = $db->query($sql, 1);

if (!$result) exit(back('帳號信息錯誤！'));
if ($LoginId == 48)
    $yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'], true);
else
    $yes_money = $Users[0]['g_money'] - $userModel->SumMoney($Users[0]['g_nid'] . UserModel::Like());
$tid = $_GET['tid'];
//获取退水，这里没有会员，所以无视就好
$result = $userModel->GetUserMR($Users[0]['g_name']);
if (!$result) {
    echo 'result get failed';
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/wjl_tmp/common.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');
            set_credit_show(<?php echo $tid?>);
        });
    </script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height: 281px;">
    <div dom="left" class="sidebar" style="display: none;"></div>
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: none;"></div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1">
        <div id="infop" tmp="infop">
            <div id="infop_klc">
                <table class="clear_table personal">
                    <caption>
                        <div>基本信息</div>
                    </caption>
                    <tbody>
                    <tr>
                        <th>账号</th>
                        <td id="account" class=""><?php echo $Users[0]['g_name'] ?></td>
                        <th>名称</th>
                        <td id="name"><?php echo $Users[0]['g_f_name'] ?></td>
                        <th>账号状态</th>
                        <td id="status">
                            <?php
                            switch ($Users[0]['g_lock']) {
                                case 3:
                                    echo '停用';
                                    break;
                                case 2:
                                    echo '停押';
                                    break;
                                case 3:
                                    echo '启用';
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr name="tr3">
                        <th>补货设定</th>
                        <td id="short_covering" class="">
                            <?php if ($Users[0]['g_Immediate_lock'] == 1) {
                                echo '允许';
                            } else {
                                echo '不允许';
                            }
                            ?></td>
                        <th ishide="1">自己及下级占成数</th>
                        <td ishide="1" id="share_total"><?php echo $Users[0]['g_distribution_limit'] ?></td>
                        <th ishide="1">所属盘口</th>
                        <td ishide="1" id="odds_set">C盘</td>
                    </tr>
                    <tr name="tr3">
                        <th>信用额度</th>
                        <td id="credit" class=""><?php echo $Users[0]['g_money'] ?></td>
                        <th id="dgshare_t"></th>
                        <td id="dgshare"></td>
                        <th></th>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <table class="clear_table games hidetable" id="klsf"><!--快乐十分-->
                    <thead>
                    <tr>
                        <th></th>
                        <th>单注最低</th>
                        <th>单注最高</th>
                        <th>单项最高</th>
                        <th>A盘退水</th>
                        <th>B盘退水</th>
                        <th>C盘退水</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < 26; $i++) { ?>
                        <?php
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
                </table><!--快乐十分 end-->
                <table class="clear_table games hidetable" id="cqssc"> <!--时时彩 -->
                    <?php
                    $start_index = 26;
                    $end_index = 39;
                    ?>
                    <thead>
                    <tr>
                        <th></th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                        <th><?php echo $result[$i]['g_type'] ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <!--26~39-->
                    <tr>
                        <th>单注最低</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td>0</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单注最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单项最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>A盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_a_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>B盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_b_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>C盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_c_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table><!--时时彩end-->
                <table class="clear_table games hidetable" id="bjsc"> <!--赛车start -->
                    <?php
                    $start_index = 60;
                    $end_index = 68;
                    ?>
                    <thead>
                    <tr>
                        <th></th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <th><?php echo $result[$i]['g_type'] ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <!--26~39-->
                    <tr>
                        <th>单注最低</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td>0</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单注最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单项最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>A盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_a_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>B盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_b_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>C盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_c_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table><!--赛车end-->
                <table class="clear_table games hidetable" id="xync"> <!--幸运农场start -->
                    <?php
                    $start_index = 123;
                    $end_index = 136;
                    ?>
                    <thead>
                    <tr>
                        <th></th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <th><?php echo $result[$i]['g_type'] ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>单注最低</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td>0</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单注最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单项最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>A盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_a_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>B盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_b_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>C盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_c_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table><!--幸运农场end-->
                <table class="clear_table games hidetable" id="jssb"> <!--江苏晒宝start -->
                    <?php
                    $start_index = 162;
                    $end_index = count($result);
                    ?>
                    <thead>
                    <tr>
                        <th></th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <th><?php echo $result[$i]['g_type'] ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>单注最低</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td>0</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单注最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>单项最高</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo $result[$i]['g_d_limit'] ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>A盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_a_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>B盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_b_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>C盘退水</th>
                        <?php for ($i = $start_index; $i < $end_index; $i++) { ?>
                            <td><?php echo 100 - $result[$i]['g_c_limit'] ?>%</td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table><!--江苏晒宝end-->
            </div>
        </div>
    </div>
    <!--main content--></div>
</body>
</html>