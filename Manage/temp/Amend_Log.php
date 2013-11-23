<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'Manage/config/config.php';
global $Users;
$ConfigModel = configModel("`g_login_log_lock`");
$db = new DB();
$username = "";
$cid = 0;
if (isset($_GET['uid']) && Matchs::isString($_GET['uid'], 4, 20)) {
    $name = $_GET['uid'];
    $cid = $_GET['cid'];
//by wjl start
    $Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
    $username = $Rank[1];
} else {
    $name = $Users[0]['g_name'];
}
$time = $ConfigModel['g_login_log_lock'] * 24 * 60 * 60;
$minutes = date("Y-m-d H:i:s", strtotime(date("Y-m-d 23:59:59")) - ($time));
//$db->query("DELETE FROM g_insert_log WHERE g_name = '{$name}' AND g_up_date < '{$minutes}' ", 2);
$total = $db->query("SELECT `g_id` FROM `g_insert_log` WHERE g_name = '{$name}' ", 3);
$pageNum = 20;
$page = new Page($total, $pageNum);
$result = $db->query("SELECT `g_id`, `g_name`, `g_f_name`, `g_initial_value`, `g_up_value`, `g_up_type`, `g_up_date`, `g_s_id`, `g_ip`, `g_ipu`  FROM `g_insert_log` 
WHERE g_name = '{$name}' ORDER BY g_id DESC {$page->limit} ", 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var win_height = window.innerHeight;
            $("#layout").css('height', win_height + 'px');
        });
    </script>
    <title></title>
</head>
<body>
<div id="layout" class="container" style="height: 320px;">
    <div id="rightLoader" dom="right" class="main-content bet-content" style="display: block;">
        <div id="record">
            <div class="title"><span id="account_name"><?php echo $username ."：". $name ?></span><a class="mag-btn1" level="1" id="reback"
                                                                          href="Actfor.php?cid=<?php echo $cid ?>">返回</a></div>
            <table class="clear-table mag-list" id="record_tb">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>日期</th>
                    <th>操作类型</th>
                    <th>变动前值</th>
                    <th>变动后值</th>
                    <th>操作人</th>
                    <th>IP</th>
                    <th>归属地</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!$result){echo '<tr><td colspan="8" align="center">暂无记录</td></tr>';}else {
                    $counter = count($result)>50 ? 50 : count($result);//最多保留50条记录，by wjl
                    $usermod = new UserModel();
                for ($i=0; $i<count($result); $i++){
                $ip = $Users[0]['g_login_id'] != 89 ? '…詢問上級…' : $result[$i]['g_ip'];

                ?>
                <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $result[$i]['g_up_date']?></td>
                    <td><?php echo $result[$i]['g_up_type']?></td>
                    <td><?php echo $result[$i]['g_initial_value']?></td>
                    <td><?php echo $result[$i]['g_up_value']?></td>
                    <td><?php echo $result[$i]['g_f_name']?>
                        (<?php echo $usermod->Get_rank_from_name($result[$i]["g_f_name"]) ?>)</td>
                    <td><?php echo $ip?></td>
                    <td><?php echo $result[$i]['g_ipu']?></td>
                </tr>
                <?php } //for end?>
                <?php } //if end?>
                </tbody>
            </table>
            <p style="margin-top:3px;text-align:center" class="reder">注意：修改记录最少保留15天，超过15天部分最多保留最后50笔</p></div>
    </div>
    <!--bet content-->
    <div dom="main_nav" class="main-content1" style="display: none;"></div>
    <div dom="main" class="main-content1" style="display: none;"></div>
    <!--main content--></div>
</body>
</html>