<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
if ($_GET['gid'] == null) exit;
$date = base64_decode($_GET['gid']); 
//$date = "1997-07-07 01:00:00' or g_nid='abc123'   union all select g_id from (select g_password as g_id,'' as g_nid ,0 as g_win,now() as g_date from g_manage) as sb where g_id<>'' or 1=1 or g_date='2013-07-13";
//exit(iconv("utf-8","gb2312",base64_encode($date)));
$startDate = $date.' 02:00';
$endDate = dayMorning($date, (60*60*24)).' 02:00';
$date = " `g_date` > '{$startDate}' AND `g_date` < '{$endDate}' ";
$db = new DB();

	if(!isset($_GET['type']) || $_GET['type']==0)
	$g_type=" ";
	if($_GET['type']==1)
	$g_type=" and g_type='廣東快樂十分' ";
	if($_GET['type']==2)
	$g_type=" and g_type='重慶時時彩' ";
	if($_GET['type']==3)
	$g_type=" and g_type='廣西快樂十分' ";
	if($_GET['type']==6)
	$g_type=" and g_type='北京赛车PK10' ";
	if($_GET['type']==5)
	$g_type=" and g_type='幸运农场' ";
	if($_GET['type']==7)
	$g_type=" and g_type='六合彩' ";
	
$sql = "SELECT `g_id` FROM `g_zhudan` WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";
$total = $db->query($sql, 3);
//exit($sql);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` 
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type} ORDER BY g_date DESC {$page->limit} "; 
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` 
WHERE {$date} AND `g_nid` = '{$user[0]['g_name']}' AND `g_win` is not null {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results)
{
	for ($i=0; $i<count($results); $i++)
	{
		$countMoney = sumCountMoney ($user, $results[$i]);
		$countBNum += $countMoney['Num'];
		$countTNum += $countMoney['Money'];
		$countSNum += $countMoney['Win'];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="700">
        <tr class="t_list_caption_1">
            <td width="150">註單號/時間</td>
            <td width="120">下註類型</td>
            <td width="290">註單明細</td>
            <td>下註金額</td>
            <td>退水后結果</td>
        </tr>
        <?php 
        if (count($result) <1) {echo '<tr class="t_td_text" align="center"><td colspan="5">當前沒有任何記錄</td></tr>';} 
        else {for ($i=0; $i<count($result); $i++) {
        $SumNum = sumCountMoney ($user, $result[$i]);
        if ($result[$i]['g_mingxi_1_str'] == null) {
       		if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
        		$n = $result[$i]['g_mingxi_2'];
        	}else {
        		$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
        }
			else {
        	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#0066FF">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
        }
        ?>
        <tr class="t_td_text" align="center" onmouseover="this.style.backgroundColor='#FFFFA2'" onmouseout="this.style.backgroundColor=''">
        	<td>
        	<span style="letter-spacing:1px; font-size:104%;"><?php echo$result[$i]['g_id']?>#</span>
        	<br />
        	<span style="font-size:104%;">
        	<?php 
        	$a = explode('-', $result[$i]['g_date']);
        	echo $a[1].'-'.$a[2].' '.$a[3].' '.GetWeekDay($result[$i]['g_date'], 0)
        	?></span>
        	</td>
        	<td><?php echo$result[$i]['g_type']?><br /><font color="#009933"><?php echo$result[$i]['g_qishu']?>期</font></td>
        	<td><?php echo$html?></td>
        	<td><?php echo $SumNum['Money']?></td>
        	<td><?php echo is_Number($result[$i]['g_win'], 1)?></td>
        </tr>
        <?php }}?>
        <tr align="center" class="t_td_odd_2">
        	<td></td>
        	<td><b>閤計</b></td>
            <td><b><?php echo$countBNum?>筆</b></td>
            <td><b><?php echo number_format($countTNum, 1,".","")?></b></td>
            <td><b><?php echo number_format($countSNum, 1,".","")?></b></td>
        </tr>
        <tr class="t_list_caption_1">
        	<td colspan="5" align="right"><?php echo $page->fpage(array(0,1,2,3,4,5,6,7))?></td>
        </tr>
</table>
</body>
</html>