<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'Manage/config/config.php';
global $Users,$ConfigModel;

if (isset($_GET['uid'])){
	$userid = $_GET['uid'];
} else {
	if (isset($Users[0]['g_s_lock']))
		$userid = $Users[0]['g_s_name'];
	 else 
		$userid = $Users[0]['g_name'];
}
$db = new DB();
$time = $ConfigModel['g_login_log_lock']*24*60*60;
$minutes = date("Y-m-d H:i:s",strtotime(date("Y-m-d 23:59:59"))-($time));
$db->query("DELETE FROM g_login_log WHERE g_name = '{$userid}' AND g_date < '{$minutes}' ", 2);
$total = $db->query("SELECT `g_id` FROM `g_login_log` WHERE g_name = '{$userid}' ", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT * FROM g_login_log WHERE g_name = '{$userid}' ORDER BY g_id DESC {$page->limit}";
$result = $db->query($sql, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="17"><img src="/Manage/temp/images/tb.gif" width="16" height="16" /></td>
                                    <td width="99%">&nbsp;登錄日誌</td>
                                  </tr>
                            </table>
                        </td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<td width="40">ID</td>
                                    <td>登陸時間</td>
                                    <td>登陸IP</td>
                                    <td>IP狀態</td>
                                </tr>
                                <?php if (!$result){echo '<td align="center" colspan="4">暫無記錄</td>';}else {
                                	for ($i=0; $i<count($result); $i++){
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
                                	<td><?php echo$i+1?></td>
                                    <td><?php if ($Users[0]['g_login_id']==89){echo$result[$i]['g_date'];}else{echo'…詢問上級…';}?></td>
                                    <td><?php if ($Users[0]['g_login_id']==89){echo $result[$i]['g_ip'];}else{echo'…詢問上級…';}?></td>
                                    <td><?php if ($Users[0]['g_login_id']==89){echo$result[$i]['g_ip_location'];}else{echo'處於安全狀態';}?></td>
                                </tr>
                                <?php }}?>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="right"><?php echo $page->fpage(array(0,1, 3,4,5,6,7))?></td>
                        <td width="16"><img src="/Manage/temp/images/tab_20.gif" alt="" /></td>
                    </tr>
                </table>
            </td>
            <td width="6" bgcolor="#1873aa"></td>
        </tr>
        <tr>
        	<td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_59.gif" alt="" /></td>
            <td bgcolor="#1873aa"></td>
            <td height="6" bgcolor="#1873aa"><img src="/Manage/images/main_62.gif" alt="" /></td>
        </tr>
    </table>
</body>
</html>