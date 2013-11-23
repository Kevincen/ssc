<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';

$week = week ();
function setHtml ($week, $str, $user,$type=0)
{
	$date1 = GetWeekDay(date("Y-m-d"), 1);
	$a = 0; $b = 0; $ac = 0; $e = 0; $g = 0;
	foreach ($week as $value) 
	{
		$date2 = GetWeekDay($value, 1);
		$c = explode('-', $value);
		$f = date('H:i:s')<='02:00' ? dayMorning(date("Y-m-d"), (60*60*24), true) : date("Y-m-d");
		if ($f == $value){
			$html = '<td align="center" style="color:blue;font-weight:bold"><span style="font-size:104%">'.$c[1].'-'.$c[2].'</span>&nbsp;&nbsp;&nbsp;'.$date2.'</td>';
		}
		else {
			$html ='<td align="center"><span style="font-size:104%">'.$c[1].'-'.$c[2].'</span>&nbsp;&nbsp;&nbsp;'.$date2.'</td>';
		}
        $date = GetWeekDay($value, 1);
        $result = GetForms($value.' 02:00', dayMorning($value, (60*60*24)).' 02:00', $user[0]['g_name'],$type);
		//alert(count($result));
        $count_bishu = 0; //筆數
        $count_jiner = 0; //下注金額
        $count_win = 0; //輸贏結果
        $count_tueishui = 0; //退水
        $count_win_n = 0; //退水后結果
        for ($i=0; $i<count($result); $i++)
        {
        	$countMoney = sumCountMoney ($user, $result[$i]);
        	$count_bishu += $countMoney['Num'];
        	$count_jiner += $countMoney['Money'];
        	$count_tueishui += $countMoney['TuiShui'];
        	$count_win_n += $countMoney['Win'];
        	$count_win += $result[$i]['g_win'] - $countMoney['TuiShui'];
        }
        if ($count_win_n == 0 && $count_jiner ==0){
        	$count_win_n = '0.0';
        } else {
        	$count_win_n = '<a href="repors.php?gid='.base64_encode($value).'&dateId='.base64_encode($value).'&type='.$type.'" class="bgh">'.is_Number($count_win_n,1).'</a>';
        }
        $a += $count_bishu; 
        $b += $count_jiner; 
        $ac += $count_win; 
        $e += $count_tueishui; 
        $g += ($count_win + $count_tueishui);
        echo '<tr class="t_td_text" align="right">
			            '.$html.'
			            <td align="center">'.$count_bishu.'</td>
			            <td style="letter-spacing:1px; font-size:104%;">'.is_Number($count_jiner).'&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%;">'.number_format($count_win, 1,".","").'&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%;">'.number_format($count_tueishui,1,".","").'&nbsp;</td>
			            <td style="letter-spacing:1px; font-size:104%; color:red">'.$count_win_n.'&nbsp;</td>
        			  </tr>';
	}
	echo '<tr class="t_td_caption_1">
        	<td><b>'.$str.'</b></td>
            <td>'.$a.'</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">'.is_Number($b).'&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">'.number_format($ac, 1,".","").'&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;">'.number_format($e, 1,".","").'&nbsp;</td>
            <td align="right" style="letter-spacing:1px; font-size:104%;"><b>'.number_format($g, 1,".","").'</b>&nbsp;</td>
        </tr>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/sc.js"></script>
<script>
function typechang($this){
	if ($this.value == 1){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=1";
	} else if ($this.value == 3){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=3";
	} else if($this.value == 4){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=4";
	}else  if($this.value == 2){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=2";
	}else if($this.value == 5){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=5";
	}else if($this.value == 6){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=6";
	}else if($this.value == 7){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=7";
		}else if($this.value == 9){
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=9";
	}else{
		window.parent.frames.mainFrame.location.href = "/templates/Repore.php?type=0";
	}
}
</script>
<title></title>
</head>
<body>

<select id="type" onchange="typechang(this)" style="color: #FF0000;font-weight:bold;margin-top:15px;">
                        <option value="0" <?php echo $_GET['type']==0? 'selected':''?>>全部</option>
						<option value="1"  <?php  echo $_GET['type']==1? 'selected':''?>>廣東快樂十分</option>
                         <option value="2" <?php  echo $_GET['type']==2? 'selected':''?>>重慶時時彩</option>
						<!--  <option value="3" <?php  echo $_GET['type']==3? 'selected':''?>>廣西快樂十分</option> -->
						  <option value="6" <?php echo $_GET['type']==6? 'selected':''?>>北京赛车PK10</option>
						   <option value="9" <?php echo $_GET['type']==9? 'selected':''?>>江苏快3</option>
						  <option value="5" <?php echo $_GET['type']==5? 'selected':''?>>幸运农场</option>
						  <!--  <option value="7" <?php echo $_GET['type']==7? 'selected':''?>>六合彩</option>-->
	
                	</select>
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" width="700" style="margin-top:0px;top:1px;">
        <tr class="t_list_caption_1 tbheader">
            <td width="150">交易日期</td>
            <td width="90">註單筆數</td>
            <td width="120">下註金額</td>
            <td width="120">輸贏結果</td>
            <td width="90">退水</td>
            <td>退水後結果</td>
        </tr>
        <?php
		if(!isset($_GET['type']))
		 echo setHtml($week['weekstart'], '上周', $user);
		 else
		 echo setHtml($week['weekstart'], '上周', $user,$_GET['type']);
		 ?>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="1" class="t_list t_result" width="700">
        <tr class="t_list_caption_1 tbheader">
            <td width="150">交易日期</td>
            <td width="90">註單筆數</td>
            <td width="120">下註金額</td>
            <td width="120">輸贏結果</td>
            <td width="90">退水</td>
            <td>退水後結果</td>
        </tr>
        <?php 

		if(!isset($_GET['type']))
		echo setHtml($week['weekend'], '本周', $user);
		else
		echo setHtml($week['weekend'], '本周', $user,$_GET['type']);
		?>
</table>
</body>
</html>