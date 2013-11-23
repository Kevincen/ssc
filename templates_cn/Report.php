<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
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
$total = $db->query("SELECT `g_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}", 3);
$pageNum = 15;
$page = new Page($total, $pageNum);
$sql = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type} ORDER BY g_date DESC {$page->limit} ";
$result = $db->query($sql, 1);
$sql1 = "SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id` FROM `g_zhudan` WHERE `g_nid` = '{$user[0]['g_name']}' AND `g_win` is null  {$g_type}";
$results = $db->query($sql1, 1);
$countBNum = 0;
$countTNum = 0;
$countSNum = 0;
if ($results)
{
	for ($i=0; $i<count($results); $i++)
	{
		$countMoney = sumCountMoney ($user, $results[$i], true);
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
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
<script>
function typechang($this){
	if ($this.value == 1){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=1";
	} else if ($this.value == 3){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=3";
	} else if($this.value == 4){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=4";
	}else  if($this.value == 2){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=2";
	}else if($this.value == 5){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=5";
	}else  if($this.value == 6){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=6";
		}else  if($this.value == 7){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=7";
		}else  if($this.value == 9){
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=9";
	}else{
		window.parent.frames.mainFrame.location.href = "/templates/Report.php?type=0";
	}
}
</script>
<title></title>
</head>
<body>
<div style="display:none">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "%68%6D%2E%62%61%69%64%75%2E%63%6F%6D/h.js%3F9898c9fdab97319b23cd83299998e52e' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
<select id="type" onChange="typechang(this)" style="color: #FF0000;font-weight:bold;margin-top:15px;">
                        <option value="0" <?php echo $_GET['type']==0? 'selected':''?>>全部</option>
						<option value="1"  <?php  echo $_GET['type']==1? 'selected':''?>>廣東快樂十分</option>
                         <option value="2" <?php  echo $_GET['type']==2? 'selected':''?>>重慶時時彩</option>
						 <!-- <option value="3" <?php  echo $_GET['type']==3? 'selected':''?>>廣西快樂十分</option>-->
						   <option value="6" <?php echo $_GET['type']==6? 'selected':''?>>北京赛车PK10</option>
						<option value="9" <?php echo $_GET['type']==9? 'selected':''?>>江苏快3</option>
						    <option value="5" <?php echo $_GET['type']==5? 'selected':''?>>幸运农场</option>
						   <!-- <option value="7" <?php echo $_GET['type']==7? 'selected':''?>>六合彩</option>-->
                	</select>
<table border="0" cellpadding="0" cellspacing="1" class="t_list" width="700"  >
        <tr class="t_list_caption_1">
            <td width="150">註單號/時間</td>
            <td width="120">下註類型</td>
            <td width="290">註單明細</td>
            <td>下註金額</td>
            <td>可贏金額</td>
        </tr>
        <?php 
        if (count($result) <1) {echo '<tr class="t_td_text" align="center"><td colspan="5">當前沒有任何記錄</td></tr>';} 
        else {for ($i=0; $i<count($result); $i++) {
        $SumNum = sumCountMoney ($user, $result[$i], true);
        if ($result[$i]['g_mingxi_1_str'] == null) {
        	if ($result[$i]['g_mingxi_1'] == '總和、龍虎' || $result[$i]['g_mingxi_1'] == '總和、龍虎和'){
        		$n = $result[$i]['g_mingxi_2'];
        	}else {
        		$n = $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#0066FF">'.$n.'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font>';
        } else {
        	$_xMoney = $result[$i]['g_mingxi_1_str'] * $result[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#0066FF">'.$result[$i]['g_mingxi_1'].'</font>@ <font color="red"><b>'.$result[$i]['g_odds'].'</b></font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result[$i]['g_mingxi_2'].'</span>';
        }
        ?>
        <tr class="t_td_text" align="center" onMouseOver="this.style.backgroundColor='#FFFFA2'" onMouseOut="this.style.backgroundColor=''">
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
        	<td><?php echo is_Number($SumNum['Win'], 1)?></td>
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