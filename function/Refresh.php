<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  作者QQ:1834219632
  Author: Version:1.0
  Date:2011-12-13
*/
define('Copyright', '作者QQ:914190123');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
include_once ROOT_PATH.'function/cheCookie.php';


	$name = base64_decode($_COOKIE['g_user']);
	$uid = base64_decode($_COOKIE['g_uid']);
	$db = new DB();
	$sql = "SELECT `g_nid`, `g_login_id`, `g_name`, `g_f_name`, `g_mumber_type`, `g_password`, `g_money`, `g_money_yes`, `g_distribution`, `g_panlu`,`g_panlus`, `g_xianer`, `g_out`, `g_count_time`, `g_look`, `g_ip`, `g_date`, `g_uid` FROM `g_user` WHERE `g_name` = '{$name}' AND `g_uid` = '{$uid}' LIMIT 1 ";
	$usere = $db->query($sql, 1);
	
	$sql = "SELECT * FROM g_zhudan where g_nid='$name' ORDER BY g_id DESC LIMIT 10";
	$result1 = $db->query($sql, 1);
	
	$table="<TR class='t_list_caption'>
<TD colSpan=4 align='middle'><SPAN class=STYLE2>最新下註的十個單</SPAN></TD></TR>
<TR class='t_list_caption'>
<TD align='middle'><FONT color=#000000>時間</FONT></TD>
<TD align='middle'><FONT color=#000000>内容</FONT></TD>
<TD align='middle'><FONT color=#000000>賠率</FONT></TD>
<TD align='middle'><FONT color=#000000>金額</FONT></TD></TR>";
	
	for($i=0;$i<count($result1);$i++){

$SumNum = sumCountMoney ($user, $result1[$i], true);
        if ($result1[$i]['g_mingxi_1_str'] == null) {
        	if ($result1[$i]['g_mingxi_1'] == '總和、龍虎' || $result1[$i]['g_mingxi_1'] == '總和、龍虎和'){
        		$n = $result1[$i]['g_mingxi_2'];
        	}else {
        		$n = $result1[$i]['g_mingxi_1'].'『'.$result1[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#0066FF">'.$n.'</font>';
        } else {
        	$_xMoney = $result1[$i]['g_mingxi_1_str'] * $result1[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result1[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result1[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#0066FF">'.$result1[$i]['g_mingxi_1'].'</font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result1[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result1[$i]['g_mingxi_2'].'</span>';
        }
		
		
		$table.="<TR class='t_td_text'>
<TD align='middle'><FONT color=#000000>".date('H:i:s',strtotime($result1[$i]['g_date']))."</FONT></TD>
<TD align='middle'><FONT color=#000000>".$html."</FONT></TD>
<TD align='middle'><FONT color=#000000><font color='red'><b>".$result1[$i]['g_odds']."</b></font></FONT></TD>
<TD align='middle'><FONT color=#000000>".$result1[$i]['g_jiner']."</FONT></TD></TR>";
		
		}
	
	
echo $usere[0]['g_panlus'].";".is_Number($usere[0]['g_money']).";".is_Number($usere[0]['g_money_yes']).";".$table;


?>
