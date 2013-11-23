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
	case 'g9':
		$types = '半波';
		$aHtml = '<a '.$getResult.'>半波</a>';
		$ch="i";
		break;
	case "g10":
		$types = '五行';
		$aHtml = '<a '.$getResult.'>五行</a>';
		$ch="j";
		break;
	case 'g11':
		$types = '特碼生肖';
		$aHtml = '<a '.$getResult.'>特碼生肖</a>';
		$ch="k";
		break; 
	case 'g12':
		$types = '一肖';
		$aHtml = '<a '.$getResult.'>一肖</a>';
		$ch="l";
		break; 
	case 'g15':
		$types = '特碼頭';
		$aHtml = '<a '.$getResult.'>特碼頭</a>';
		$ch="o";
		break; 
	case 'g4':
		$types = '正碼四';
		$aHtml = '<a '.$getResult.'>正碼四</a>';
		break; 
	case 'g5':
		$types = '正碼五';
		$aHtml = '<a '.$getResult.'>正碼五</a>';
		break;
	case 'g6':
		$types = '正碼六';
		$aHtml = '<a '.$getResult.'>正碼六</a>';
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
    	<td>號碼</td>
    </tr> 
   	<?php 
	if($g=="g9"){ //半波
		$narr=array("紅"=>"red_arr","綠"=>"green_arr","藍"=>"blue_arr");
		$darr=array("單","雙","大","小");
		$iIndex=1;
		foreach($narr as $crgb=>$ergb){
			foreach($darr as $d){
				echo "<tr class=\"t_td_text\">";
				echo "<td class=\"".$ch."h".$iIndex."\">{$crgb}{$d}</td>";
				echo "<td  class=\"o\" width=\"40\" id=\"".$ch."h".$iIndex."\">{$crgb}{$d}</td>";
				echo "<td class=\"loads\" id=\"Ball_".str_replace("g","",$g)."N".$ch."h".$iIndex."\"></td>";
				echo "<td><table align=left><tr>";
				$arr=$CONFIG["lhc_rgb"][$ergb]; 
				foreach($arr as $v){
					if($d=="單" && $v%2==1){  
						echo "<td class='".ball_color($v)."'>".$v."</td>";
					}else if($d=="雙" && $v%2==0){
						echo "<td class='".ball_color($v)."'>".$v."</td>";
					}else if($d=="大" && $v>=25){
						echo "<td class='".ball_color($v)."'>".$v."</td>";
					}else if($d=="小" && $v<25){
						echo "<td class='".ball_color($v)."'>".$v."</td>";
					}
				} 
				echo "</tr></table></td>";
				$iIndex++;
				echo "</tr>";
			}
		}
	}else if($g=="g10"){ //五行
		$iIndex=1;
		foreach($CONFIG["lhc_rgb"]['WH'] as $k=>$arr){
			echo "<tr class=\"t_td_text\">";
			echo "<td class=\"".$ch."h".$iIndex."\" style='width:30px'>{$k}</td>";
			echo "<td  class=\"o\" width=\"40\" id=\"".$ch."h".$iIndex."\">-</td>";
			echo "<td class=\"loads\" id=\"Ball_".str_replace("g","",$g)."N".$ch."h".$iIndex."\"></td>";
			echo "<td><table align=left><tr>";
			foreach($arr as $v){ 
				echo "<td class='".ball_color($v)."'>".$v."</td>"; 
			} 
			echo "</tr></table></td>";
			$iIndex++;
			echo "</tr>";
		}
	}else if($g=='g11' || $g=="g12"){ //特碼生肖 / 一肖
		$iIndex=1;
		foreach($CONFIG["lhc_rgb"]['SX'] as $k=>$arr){
			echo "<tr class=\"t_td_text\">";
			echo "<td class=\"".$ch."h".$iIndex."\" style='width:30px'>{$k}</td>";
			echo "<td  class=\"o\" width=\"40\" id=\"".$ch."h".$iIndex."\">-</td>";
			echo "<td class=\"loads\" id=\"Ball_".str_replace("g","",$g)."N".$ch."h".$iIndex."\"></td>";
			echo "<td><table align=left><tr>";
			foreach($arr as $v){ 
				echo "<td class='".ball_color($v)."'>".$v."</td>"; 
			} 
			echo "</tr></table></td>";
			$iIndex++;
			echo "</tr>";
		}
	}else if($g=="g15"){ 
		for($t=1;$t<=5;$t++){
			echo "<tr class=\"t_td_text\">";
			echo "<td class=\"".$ch."h".$t."\" style='width:30px'>".($t-1)."</td>";
			echo "<td  class=\"o\" width=\"40\" id=\"".$ch."h".$t."\">-</td>";
			echo "<td class=\"loads\" id=\"Ball_".str_replace("g","",$g)."N".$ch."h".$t."\"></td>";
			echo "<td><table align=left><tr>";
			for($m=1;$m<=49;$m++){
				if( strlen($m)==1 )$m="0".$m;
				if( substr($m,0,1)==($t-1) )
					echo "<td class='".ball_color($m)."'>".$m."</td>"; 
			} 
			echo "</tr></table></td>"; 
			echo "</tr>";
		}
	}
 	?>
</table> 
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs ti" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs ti" value="下註" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>

 
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td width="16%" class="nv_ab" ><?php echo $aHtml?></td> 
    </tr>
    <tr>
    	<td   class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table> 
 
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