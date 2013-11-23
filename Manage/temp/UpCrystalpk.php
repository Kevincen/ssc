<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
include_once ROOT_PATH.'class/SumAmountpk.php';
global $Users;
if ($Users[0]['g_login_id'] != 89) exit;

if (isset($Users[0]['g_lock_1_4'])){
	if ($Users[0]['g_lock_1_4'] !=1) 
		exit(back('您的權限不足！'));
}

$db=new DB();
if (!Matchs::isNumber($_GET['uid'], 5, 15)) 
	exit(back('uid參數錯誤！'));
$uid = $_GET['uid'];

$result = $db->query("SELECT `g_id`, `g_s_nid`, `g_mumber_type`, `g_nid`, `g_date`, `g_type`, `g_qishu`, `g_mingxi_1`, `g_mingxi_1_str`, `g_mingxi_2`, `g_mingxi_2_str`, `g_odds`, `g_jiner`, `g_tueishui`, `g_tueishui_1`, `g_tueishui_2`, `g_tueishui_3`, `g_tueishui_4`, `g_distribution`, `g_distribution_1`, `g_distribution_2`, `g_distribution_3`, `g_win`, `g_t_id`  FROM g_zhudan WHERE g_id = '{$uid}' LIMIT 1", 1);

if (!$result)
	exit(back($uid.'# 注單錯誤或已被刪除！'));

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (!Matchs::isFloating($_POST['s_odds']) && !Copyright) 
		exit(back($_POST['s_odds'].'賠率錯誤'));
		
	if (isset($_POST['s_money'])){
		if (!Matchs::isNumber($_POST['s_money']) && !Copyright) 
			exit(back($_POST['s_money'].'下注金額錯誤'));
	}
	$sum =false;
	$arr = array();
	$arr['uid'] = $uid;
	$arr['s_number'] = $_POST['s_number'];
	$arr['s_numtype'] = $result[0]['g_mingxi_1'];
	$arr['s_money'] = $result[0]['g_mingxi_1_str'] ? $result[0]['g_jiner'] * $result[0]['g_mingxi_1_str'] : $_POST['s_money'];
	$arr['s_numcontent'] = isset($_POST['s_numcontent']) ? $_POST['s_numcontent'] : $_POST['s_LM'];
	$arr['s_odds'] = $_POST['s_odds'];
	$arr['s_ok'] = $_POST['s_ok'];
	
	if ($result[0]['g_mingxi_1_str'])
	{
		$a = explode('、', $arr['s_numcontent']);
		$a = array_unique($a);
		$arr['s_numcontent'] = join('、', $a);
		if (mb_strlen($result[0]['g_mingxi_2']) != mb_strlen($arr['s_numcontent'])) 
			exit(back('連碼格式輸入錯誤，必須于原來的格式保存一致。'));
			
		if (!isNumberArr(explode('、', $arr['s_numcontent']))) 
			exit(back('輸入號碼超出限定範圍。'));
	}
	if ($arr['s_ok'] == 1 && $result[0]['g_mumber_type'] != 5) //結算
	{
		$sql = "SELECT g_name, g_money_yes FROM g_user WHERE g_name = '{$result[0]['g_nid']}' LIMIT 1";
		$userName = $db->query($sql, 1);
		if (!$userName) exit(back($result[0]['g_nid'].' 該帳號錯誤或已被刪除。'));
		$money = $userName[0]['g_money_yes'] - $result[0]['g_win'] - $arr['s_money'];
		$sql = "UPDATE g_user SET g_money_yes = '{$money}' WHERE g_name = '{$userName[0]['g_name']}' LIMIT 1";
		$db->query($sql, 2);
		$sum =true;
	}
	if ($result[0]['g_mingxi_1_str']) $arr['s_money'] = $result[0]['g_jiner'];
	$sql = "UPDATE g_zhudan SET g_win = null, g_qishu='{$arr['s_number']}', g_mingxi_1='{$arr['s_numtype']}',g_mingxi_2='{$arr['s_numcontent']}', g_jiner = '{$arr['s_money']}' ,g_odds='{$arr['s_odds']}' WHERE g_id ='{$result[0]['g_id']}' LIMIT 1";
	if ($db->query($sql, 2))
	{
		$SumAmount = new SumAmountpk($arr['s_number'], false, $arr['uid'], $sum);
		if (!is_array($SumAmount->ResultAmount())) exit(back($arr['uid'].'# 注單無法結算，請核實數據。'));
		exit(go($result[0]['g_id'].'# 注單更變成功。', '2'));
	}else{
	exit(back($result[0]['g_id'].'# 注單无改变。'));
	}
}
else if (isset($_GET['uid']))
{
	$ps = false;
	$sql = "SELECT g_id FROM g_zhudan WHERE g_t_id = '{$uid}' AND g_type = '北京赛车PK10' AND g_qishu = '{$result[0]['g_qishu']}}' LIMIT 1 ";
	if ($db->query($sql, 0))
		exit(back('很遺憾！'.$uid.'# 注單已有關聯走飛記錄，無法修改。'));
		
	if (!$db->query("SELECT g_qishu FROM g_history6 WHERE g_qishu = '{$result[0]['g_qishu']}' LIMIT 1 ", 0)){
		if ($db->query("SELECT g_id FROM g_kaipan6 WHERE g_qishu = '{$result[0]['g_qishu']}' LIMIT 1", 0))
			$ps = true;
		else
			exit(back($result[0]['g_qishu'].'期數不存在或未開出！'));
	}
	$html = selectHtml($result[0]['g_qishu']);
}

function selectHtml($number){
	$html ="<select name=\"s_number\">";
	$html .="<option selected=\"selected\" value=\"{$number}\">{$number}</option>";
	$html .="</select>";
	/*for ($i=0; $i<count($result); $i++){
		if ($number == $result[$i]['g_qishu']){
			$html .="<option selected=\"selected\" value=\"{$result[$i]['g_qishu']}\">{$result[$i]['g_qishu']}</option>";
		} else {
			$html .="<option value=\"{$result[$i]['g_qishu']}\">{$result[$i]['g_qishu']}</option>";
		}
	}
	$html .="</select>";*/
	return $html;
}
function isNumberArr($arr){
	for ($i=0; $i<count($arr); $i++){
		if ($arr[$i] > 20 || $arr[$i] < 1) 
			return false;
	}
	return true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Manage/temp/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/actiontop.js"></script>
<title></title>
<script type="text/javascript">
<!--
	function isForm(){
		if (confirm("警告： 確定修改注單嗎？")){
			return true;
		}
		return false;
	}
-->
</script>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16055567.js"></script>
</div>
<form action="" method="post" onsubmit="return isForm()">
	<table width="100%" height="100%" border="0" cellspacing="0" class="a">
    	<tr>
        	<td width="6" height="99%" bgcolor="#1873aa"></td>
            <td class="c">
            	<table border="0" cellspacing="0" class="main">
                	<tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_03.gif" alt="" /></td>
                        <td background="/Manage/temp/images/tab_05.gif"></td>
                        <td width="16"><img src="/Manage/temp/images/tab_07.gif" alt="" /></td>
                    </tr>
                    <tr>
                    	<td class="t"></td>
                        <td class="c">
                        <!-- strat -->
                            <table border="0" cellspacing="0" class="conter">
                            	<tr class="tr_top">
                                	<th colspan="2">注單更變</th>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">注單號</td>
                                	<td align="left">&nbsp;<?php echo$result[0]['g_id']?>#</td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">帳號</td>
                                	<td align="left">&nbsp;<?php echo$result[0]['g_nid']?></td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">下注類型</td>
                                	<td align="left">&nbsp;<?php echo$result[0]['g_type']?></td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">下注期數</td>
                                	<td align="left">&nbsp;<?php echo$html?></td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">下注明細</td>
                                	<td align="left">&nbsp;
                                		<select name="s_numtype" disabled="disabled">
                                			<?php if ($result[0]['g_mingxi_1']=='冠亞和'){?>
                                			<option <?php if($result[0]['g_mingxi_1']=='冠亞和'){echo'selected="selected"';}?> value="冠亞和">冠亞和</option>
                                			
                                			<?php } else if ($result[0]['g_mingxi_1']=='冠、亞軍和') {?>
                                			<option <?php if($result[0]['g_mingxi_1']=='冠、亞軍和'){echo'selected="selected"';}?> value="冠、亞軍和">冠、亞軍和</option>
                                			<?php } else {?>
                                			<option <?php if($result[0]['g_mingxi_1']=='冠军'){echo'selected="selected"';}?> value="冠军">冠军</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='亚军'){echo'selected="selected"';}?> value="亚军">亚军</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第三名'){echo'selected="selected"';}?> value="第三名">第三名</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第四名'){echo'selected="selected"';}?> value="第四名">第四名</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第五名'){echo'selected="selected"';}?> value="第五名">第五名</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第六名'){echo'selected="selected"';}?> value="第六名">第六名</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第七名'){echo'selected="selected"';}?> value="第七名">第七名</option>
                                			<option <?php if($result[0]['g_mingxi_1']=='第八名'){echo'selected="selected"';}?> value="第八名">第八名</option>
                                			<?php }?>
                                		</select>
                                	</td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">下注內容</td>
                                	<td align="left">&nbsp;
                                	<?php if ($result[0]['g_mingxi_1']=='任選二'||$result[0]['g_mingxi_1']=='選二連組'||$result[0]['g_mingxi_1']=='任選三'||$result[0]['g_mingxi_1']=='選三前組'||$result[0]['g_mingxi_1']=='任選四'||$result[0]['g_mingxi_1']=='任選五'){?>
                                		<input type="text" name="s_LM" class="textc" style="width:220px" value="<?php echo$result[0]['g_mingxi_2']?>" />
                                		&nbsp;<?php echo $result[0]['g_mingxi_1_str']?>組&nbsp;
                                		<span class="red">（注：號碼長度必須保持一致。）</span>
                                	<?php }else {?>
                                		<select name="s_numcontent">
                                			<?php if ($result[0]['g_mingxi_1']=='冠亞和') {?>
                                			<option <?php if($result[0]['g_mingxi_2']=='冠亞和大'){echo'selected="selected"';}?> value="冠亞和大">冠亞和大</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='冠亞和小'){echo'selected="selected"';}?> value="冠亞和小">冠亞和小</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='冠亞和單'){echo'selected="selected"';}?> value="冠亞和單">冠亞和單</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='冠亞和雙'){echo'selected="selected"';}?> value="冠亞和雙">冠亞和雙</option>
                                			
                                			
                                			<?php } else  if ($result[0]['g_mingxi_1']=='冠、亞軍和') {?>
                                			<option <?php if($result[0]['g_mingxi_2']=='3'){echo'selected="selected"';}?> value="3">3</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='4'){echo'selected="selected"';}?> value="4">4</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='5'){echo'selected="selected"';}?> value="5">5</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='6'){echo'selected="selected"';}?> value="6">6</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='7'){echo'selected="selected"';}?> value="7">7</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='8'){echo'selected="selected"';}?> value="8">8</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='9'){echo'selected="selected"';}?> value="9">9</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='10'){echo'selected="selected"';}?> value="10">10</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='11'){echo'selected="selected"';}?> value="11">11</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='12'){echo'selected="selected"';}?> value="12">12</option>
											<option <?php if($result[0]['g_mingxi_2']=='13'){echo'selected="selected"';}?> value="13">13</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='14'){echo'selected="selected"';}?> value="14">14</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='15'){echo'selected="selected"';}?> value="15">15</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='16'){echo'selected="selected"';}?> value="16">16</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='17'){echo'selected="selected"';}?> value="17">17</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='18'){echo'selected="selected"';}?> value="18">18</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='19'){echo'selected="selected"';}?> value="19">19</option>
                                			
                                			
                                			
                                			<?php } else{?>
                                			<option <?php if($result[0]['g_mingxi_2']=='1'){echo'selected="selected"';}?> value="1">1</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='2'){echo'selected="selected"';}?> value="2">2</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='3'){echo'selected="selected"';}?> value="3">3</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='4'){echo'selected="selected"';}?> value="4">4</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='5'){echo'selected="selected"';}?> value="5">5</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='6'){echo'selected="selected"';}?> value="6">6</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='7'){echo'selected="selected"';}?> value="7">7</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='8'){echo'selected="selected"';}?> value="8">8</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='9'){echo'selected="selected"';}?> value="9">9</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='10'){echo'selected="selected"';}?> value="10">10</option>
                                			
                                			<option <?php if($result[0]['g_mingxi_2']=='大'){echo'selected="selected"';}?> value="大">大</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='小'){echo'selected="selected"';}?> value="小">小</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='單'){echo'selected="selected"';}?> value="單">單</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='雙'){echo'selected="selected"';}?> value="雙">雙</option>
											<option <?php if($result[0]['g_mingxi_2']=='龍'){echo'selected="selected"';}?> value="龍">龍</option>
                                			<option <?php if($result[0]['g_mingxi_2']=='虎'){echo'selected="selected"';}?> value="虎">虎</option>
                                			<?php }?>
                                		</select>
                                	<?php }?>
									</td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">賠率</td>
                                	<td align="left">&nbsp;
                                	<input type="text" class="textc" name="s_odds" value="<?php echo$result[0]['g_odds']?>" /></td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">下注金額</td>
                                	<td align="left">&nbsp;
                                			<?php 
                                				if ($result[0]['g_mingxi_1']=='任選二'||$result[0]['g_mingxi_1']=='選二連組'||$result[0]['g_mingxi_1']=='任選三'||$result[0]['g_mingxi_1']=='選三前組'||$result[0]['g_mingxi_1']=='任選四'||$result[0]['g_mingxi_1']=='任選五'){
                                						$money = $result[0]['g_jiner']*$result[0]['g_mingxi_1_str'];
                                						echo $money;
                                					}else {
                                						$money = $result[0]['g_jiner'];
                                						echo '<input type="text" class="textc" name="s_money" value="'.$money.'" />';
                                					}
                                				?>
                                	</td>
                                </tr>
                                <tr align="right" style="height:30px">
                                	<td class="bj">輸贏結果</td>
                                	<td align="left">&nbsp;<?php echo$result[0]['g_win']==null?'<span style="color:#0000FF">未結算</span>':$result[0]['g_win'];?></td>
                                </tr>
                                <tr align="right" style="height:30px; <?php if ($ps != true)echo 'display:none'?>">
                                	<td class="bj">是否結算</td>
                                	<td align="left">&nbsp;<input type="checkbox" name="s_ok" value="<?php echo$result[0]['g_win']==null? 0:1;?>" checked="checked"/></td>
                                </tr>
                            </table>
                        <!-- end -->
                        </td>
                        <td class="r"></td>
                    </tr>
                    <tr>
                    	<td width="12"><img src="/Manage/temp/images/tab_18.gif" alt="" /></td>
                        <td class="f" align="center">
                        <input type="submit" class="inputs" value="確定更變" />&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" onclick="javascript:history.go(-1)" class="inputs" value="取消返回" />
                        </td>
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
</form>
</body>
</html>