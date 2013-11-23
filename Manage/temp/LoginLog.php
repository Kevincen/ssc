<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
include_once ROOT_PATH . 'Manage/ExistUser.php';
include_once ROOT_PATH . 'Manage/config/config.php';
global $Users, $ConfigModel,$LoginId;

if (isset($_GET['uid'])) {
    $userid = $_GET['uid'];
    $cid = $_GET['cid'];
//by wjl start
    $Rank = UserModel::GetNextRank($cid, $LoginId, $Users);
    $username = $Rank[1];
//by wjl end
} else {
    if (isset($Users[0]['g_s_lock']))
        $userid = $Users[0]['g_s_name'];
    else
        $userid = $Users[0]['g_name'];
}

$db = new DB();
$time = $ConfigModel['g_login_log_lock'] * 24 * 60 * 60;
$minutes = date("Y-m-d H:i:s", strtotime(date("Y-m-d 23:59:59")) - ($time));
$db->query("DELETE FROM g_login_log WHERE g_name = '{$userid}' AND g_date < '{$minutes}' ", 2);
$total = $db->query("SELECT `g_id` FROM `g_login_log` WHERE g_name = '{$userid}' ", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT * FROM g_login_log WHERE g_name = '{$userid}' ORDER BY g_id DESC {$page->limit}";
$result = $db->query($sql, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/actiontop.js"></script>
    <title></title>
</head>
<body>
<div id="rightLoader" dom="right" class="main-content bet-content" s    tyle="display: block;">
    <div id="log">
        <div class="title"><span id="account_name"><?php echo $username ."：". $userid ?></span>
            <a class="mag-btn1" level="1" id="reback"
                                                                       href="Actfor.php?cid=<?php echo $cid ?>">返回</a></div>
        <table class="clear-table mag-list" id="log_tb">
            <thead>
            <tr>
                <th>序号</th>
                <th>登录时间</th>
                <th>IP</th>
                <th>IP归属</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!$result){echo '<td align="center" colspan="4">暫無記錄</td>';}else {
                $counter = count($result)>20 ? 20 :count($result);
            for ($i=0; $i<$counter; $i++){
            ?>
            <tr>
                <td><?php echo$i+1?></td>
                <td><?php if ($Users[0]['g_login_id']==89){echo$result[$i]['g_date'];}else{echo'…询问上级';}?></td>
                <td><?php if ($Users[0]['g_login_id']==89){echo$result[$i]['g_ip'];}else{echo'…詢問上級…';}?></td>
                <td><?php if ($Users[0]['g_login_id']==89){echo$result[$i]['g_ip_location'];}else{echo'處於安全狀態';}?></td>
            </tr>
            <?php }}?>
            </tbody>
        </table>
        <p style="margin-top:3px;text-align:center" class="reder">注意：登录日志最少被保留7天，超过7天部分最多保留最后20笔</p></div>
</div>
</body>
</html>