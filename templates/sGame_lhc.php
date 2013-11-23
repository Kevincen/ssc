<?php 
error_reporting(E_ALL^E_NOTICE);
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamelhc.php';
$ConfigModel = configModel("`g_lhc_game_lock`, `g_mix_money`");
if ($ConfigModel['g_lhc_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;
//获取当前盘口 
$_SESSION['lhc'] = true; 
$g=$_GET['g']; 
switch ($g) {
	case 'g7':
		$types = '特碼';
		$aHtml = '<a '.$getResult.'>特碼</a>';
		$ch="g";
		break;
	case "g8":
		$types = '正碼';
		$aHtml = '<a '.$getResult.'>正碼總和</a>';
		$ch="h";
		break;
	case 'g1':
		$types = '正碼一';
		$aHtml = '<a '.$getResult.'>正碼一</a>';
		$ch="a";
		break; 
	case 'g2':
		$types = '正碼二';
		$aHtml = '<a '.$getResult.'>正碼二</a>';
		$ch="b";
		break; 
	case 'g3':
		$types = '正碼三';
		$aHtml = '<a '.$getResult.'>正碼三</a>';
		$ch="c";
		break; 
	case 'g4':
		$types = '正碼四';
		$aHtml = '<a '.$getResult.'>正碼四</a>';
		$ch="d";
		break; 
	case 'g5':
		$types = '正碼五';
		$aHtml = '<a '.$getResult.'>正碼五</a>';
		$ch="e";
		break;
	case 'g6':
		$types = '正碼六';
		$aHtml = '<a '.$getResult.'>正碼六</a>';
		$ch="f";
		break; 
	default:exit;
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  <?=$oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script language="javascript">
var red='<?=implode(",",$CONFIG["lhc_rgb"]['red_arr'])?>';
var green='<?=implode(",",$CONFIG["lhc_rgb"]['green_arr'])?>';
var blue='<?=implode(",",$CONFIG["lhc_rgb"]['blue_arr'])?>';
</script>
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGame_lhc.js"></script> 
<title></title>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
		if (s !== "left.php")
			window.parent.frames.leftFrame.location.href = "/templates/left.php";
			
			function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
<style type="text/css">
div#row1 { float: left;  }
div#row2 { }
</style>
</head>
<body>
<input type="hidden" id="hiden" value="<?php echo $g?>" />
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="105" height="20" class="bolds">六合彩</td>
        <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td class="bolds" style="color:red" align="right"></td>
      <td align="right"><img id='soundbut' src="images/soundon.png" width="27" height="19" value='on' onclick="soundset(this);"  title="开奖音开关"/></td>
        <td align="right"  colspan="4">
        			<td class="bolds" width="146" align="left"><span id="number" style="position:relative;"></span>期開獎</td>
			        <td id="a"></td>
			        <td id="b"></td>
			        <td id="c"></td>
			        <td id="d"></td>
			        <td id="e"></td>
					<td id="f"></td>
			        <td id="g"></td>
	</tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
    <tr>
    	<td height="30" width="125px" ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="90"><span style="color:#0033FF; font-weight:bold" id="tys"><?php echo$types?></span></td>
        <td width="60"><form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
				window.parent.frames.mainFrame.location.href = "sGame_lhc.php?g=<?php echo $g?>&abc="+sel.value;
			} 
			</script>
           </label>
         </form></td>
        <td width="180">距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="4">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td width="75" align="right" style="position:relative;top:-1px;"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
		
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
		
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
		
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
		
    	<td>號</td>
    	<td>賠率</td>
    	<td>金額</td>
    </tr>
   <tr class="t_td_text">
   	<?php 
	$numarr=array();
	/*for($i=1;$i<=49;$i++){
		$numarr[$i-1]= strlen($i)==1 ? "0".$i : $i; 
	}*/
	 
	for($row=0;$row<=10;$row++){
		for($col=1;$col<=49;$col+=10){
			$cel = $col+$row;
			if($cel>49)continue;
			$numarr[$cel-1] = strlen($cel)==1 ? "0".$cel : $cel; 
		}
	}
	 
	
	
	if($g=="g8"){
		$carr=array("總大","總小","總單","總雙");
	}else if($g=="g1" || $g=="g2" || $g=="g3" || $g=="g4" || $g=="g5" || $g=="g6" || $g=="g7" ){ 
		$carr=array("大","小","單","雙","合單","合雙","紅波","綠波","藍波");
		if($g=="g7"){
			$karr=array("合大","合小","尾大","尾小","大單","大雙","小單","小雙",
				"紅大單","紅大雙","紅小單","紅小雙","藍大單","藍大雙","藍小單","藍小雙","綠大單","綠大雙","綠小單","綠小雙"
			);
			$carr=array_merge($carr,$karr);
		}
	}
	$im=49;
	foreach($carr as $v){
		$numarr[$im++]=$v;
	}
	 
	
	$index=1;
	foreach($numarr as $k=>$v){
		?>
		<td class="<?=$ch?>h<?=($k+1)?> <?=ball_color($v)?> <?=is_numeric($v) ? "haoma" : ""?>" id="Ball_<?=str_replace("g","",$g)?>Q<?=$ch?>h<?=($k+1)?>"><?=$v?></td>
    	<td class="o" width="40" id="<?=$ch?>h<?=($k+1)?>"></td>
    	<td class="loads" id="Ball_<?=str_replace("g","",$g)?>N<?=$ch?>h<?=($k+1)?>"></td>
		<?php
		if( ($index++)%5==0 )echo "<tr class=\"t_td_text\">";
	}
	?>
    <td colspan="6"></td> 
</table> 

<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text">
	<td   class="t_list_caption">總和</td>
	<?php 
	$arr=array("總和大","總和小","總和單","總和雙");
	for($i=0;$i<count($arr);$i++){
		?>
		<td  class="caption_1 ph<?=$i+1?>"><?=$arr[$i]?></td>
    	<td class="o" width="40" id="ph<?=$i+1?>"></td>
    	<td class="loads" width="80" id="Ball_16Nph<?=$i+1?>"></td>
		<?php
	}
	?> 
    </tr> 
</table> 
<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text">
	<td   class="t_list_caption">半<BR>波</td>
	<td>
		<table border="0" cellpadding="0" cellspacing="1" class="wq" style="width:684px; margin:0px">
			<tr class="t_td_text">
			<?php 
			$narr=array("紅"=>"red_arr","綠"=>"green_arr","藍"=>"blue_arr");
			$darr=array("單","雙","大","小");
			$iIndex=1;
			foreach($narr as $crgb=>$ergb){
				foreach($darr as $d){ 
					echo "<td class=\"ih".$iIndex."\">{$crgb}{$d}</td>";
					echo "<td  class=\"o\" width=\"30\" id=\"ih".$iIndex."\">-</td>";
					echo "<td class=\"loads\" id=\"Ball_9Nih".$iIndex."\"></td>";  
					if($iIndex==6){
						echo '<tr class="t_td_text">';
					}
					$iIndex++; 
				}
			}
			?> 
		</table>
	</td> 
    </tr> 
</table> 
<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text">
	<td   class="t_list_caption">五行</td>
	<?php 
	$arr=array("金","木","水","火","土");
	for($i=0;$i<count($arr);$i++){
		?>
		<td  class="caption_1 jh<?=$i+1?>"><?=$arr[$i]?></td>
    	<td class="o" width="40" id="jh<?=$i+1?>"></td>
    	<td class="loads" width="70" id="Ball_10Njh<?=$i+1?>"></td>
		<?php
	}
	?> 
    </tr> 
</table> 

<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text">
	<td   class="t_list_caption">生<BR>肖</td>
	<td>
		<table border="0" cellpadding="0" cellspacing="1" class="wq" style="width:684px; margin:0px">
			<tr class="t_td_text">
			<?php 
			$iIndex=1;
			$ch="k";
			foreach($CONFIG["lhc_rgb"]['SX'] as $k=>$arr){ 
				echo "<td class=\"".$ch."h".$iIndex."\" style='width:30px'>{$k}</td>";
				echo "<td  class=\"o\" width=\"40\" id=\"".$ch."h".$iIndex."\">-</td>";
				echo "<td class=\"loads\" id=\"Ball_11N".$ch."h".$iIndex."\"></td>"; 
				if($iIndex==6){
					echo '<tr class="t_td_text">';
				}
				$iIndex++;  
			}
			?>
		</table>
	</td> 
    </tr> 
</table> 

<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text">
	<td   class="t_list_caption">特<BR>尾</td>
	<td>
		<table border="0" cellpadding="0" cellspacing="1" class="wq" style="width:684px; margin:0px">
			<tr class="t_td_text">
			<?php 
			$numarr=array(0,1,2,3,4,5,6,7,8,9); 
			$ch="m";
			foreach($numarr as $k=>$v){
				?>
				<td class="<?=$ch?>h<?=($k+1)?>" style="width:30px" id="Ball_13Q<?=$ch?>h<?=($k+1)?>"><?=$v?></td>
				<td class="o" width="40" id="<?=$ch?>h<?=($k+1)?>"></td>
				<td class="loads" id="Ball_13N<?=$ch?>h<?=($k+1)?>"></td>
				<?php
				if( ($k+1)==5 )echo "<tr class=\"t_td_text\">";
			}
			?>
		</table>
	</td> 
    </tr> 
</table>
<?php include("lhcQuick.php")?>  
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs ti" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs ti" value="下註" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>

<?php  if($g=="g1" || $g=="g2" || $g=="g3" || $g=="g4" || $g=="g5" || $g=="g6" || $g=="g7" ){?>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td width="16%" class="nv_ab" ><?php echo $aHtml?></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>大小</a></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>單雙</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>合單合雙</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>尾大尾小</a></td>
		<td width="17%"><a class="nv" <?php echo $onclick?>>波段</a></td> 
    </tr>
    <tr>
    	<td colspan="6" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table> 
<?php }else if($g=="g8"){?>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td width="16%" class="nv_ab" ><?php echo $aHtml?></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>正碼總和大小</a></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>正碼總和單雙</a></td> 
    </tr>
    <tr>
    	<td colspan="3" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table> 
<?php }?>
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div id="look" style="display:none"></div>
<?php include_once 'inc/cl_file.php';?>
<?php 
$name = base64_decode($_COOKIE['g_user']);
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$name}' LIMIT 1", 0);
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>