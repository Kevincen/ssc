<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user;
$db = new DB();
$sql = "SELECT `g_type`, `g_panlu_a`,`g_panlu_b`,`g_panlu_c`, `g_danzhu`, `g_danxiang` FROM `g_panbiao` WHERE `g_nid` = '{$user[0]['g_name']}' ORDER BY g_id DESC ";
$result = $db->query($sql, 1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css?112" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
<title>PHP</title>
</head>
<body> 
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" width="900">
        <tr>
            <td class="t_list_caption" colspan="2">信用資料</td>
        </tr>
        <tr>
            <td class="t_td_caption_1" width="150">會員帳號</td>
            <td class="t_td_text"><?php echo $user[0]['g_name']?>（<?php echo strtoupper($user[0]['g_panlus'])?>盤）</td>
        </tr>
        <tr>
            <td class="t_td_caption_1">信用額度</td>
            <td class="t_td_text"><?php echo $user[0]['g_money']?></td>
        </tr>
        <tr>
            <td class="t_td_caption_1">可用金額</td>
            <td class="t_td_text"><?php echo $user[0]['g_money_yes']?></td>
        </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">廣東快樂十分</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=0; $i<13; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td>
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=13; $i<26; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">重慶時時彩</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=26; $i<33; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td valign="top">
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=33; $i<39; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>
<? /*
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">廣西快樂十分</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=39; $i<50; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td valign="top">
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=50; $i<60; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>
*/ ?>
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">北京赛车PK10</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=60; $i<68; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td>
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=68; $i<76; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">幸运农场</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=123; $i<136; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td valign="top">
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=136; $i<149; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>
<? /*
<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">新疆時時彩</td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=149; $i<156; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td valign="top">
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=156; $i<162; $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>
*/ ?>

<table border="0" cellpadding="0" cellspacing="0" class="t_list t_result" width="901">
        <tr>
            <td class="t_list_caption" colspan="8">江苏骰寶(快3) </td>
        </tr>
        <tr class="t_td_text">
        	<td>
        		<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
						 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=162; $i<166; $i++) {
						$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
						$P = $user[0]['g_panlus'];
                        if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
						if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
						if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
	        			
						$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
						echo $str;
	        			}
        			?>
        		</table>
			</td>
            <td valign="top">
            	<table border="0" cellpadding="0" cellspacing="1" class="t_list_1" width="100%">
        			<tr class="t_list_caption_1">
        				<td width="110">交易類型</td>
        				 <?php $P = $user[0]['g_panlus'];?>
                         <?php if(strstr($P,'A')!=''){echo "<td width='60'>A盤</td>";}?>
						 <?php if(strstr($P,'B')!=''){echo "<td width='60'>B盤</td>";}?>
						 <?php if(strstr($P,'C')!=''){echo "<td width='60'>C盤</td>";}?>
        				<td>單註限額</td>
        				<td>單期限額</td>
        			</tr>
        			<?php 
	        			for ($i=166; $i<count($result); $i++) {
	        				$str='<tr class="t_td_text" align="center"><td class="t_td_caption_1">'.$result[$i]['g_type'].'</td>';
							$P = $user[0]['g_panlus'];
                       		if(strstr($P,'A')!=''){$str.="<td>".$result[$i]['g_panlu_a']."</td>";}
							if(strstr($P,'B')!=''){$str.="<td>".$result[$i]['g_panlu_b']."</td>";}
							if(strstr($P,'C')!=''){$str.="<td>".$result[$i]['g_panlu_c']."</td>";}
							$str.='<td>'.$result[$i]['g_danzhu'].'</td><td>'.$result[$i]['g_danxiang'].'</td></tr>';
							echo $str;
	        			}
        			?>
        		</table>
			</td>
        </tr>
</table>

</body>
</html>