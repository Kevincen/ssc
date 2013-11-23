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
	case 'g18':
		$types = '合肖';
		$aHtml = '<a '.$getResult.'>合肖</a>';
		$ch="r";
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
<form id="lm" action="" method="post" target="leftFrame">
<table class="wq" border="0" cellpadding="0" cellspacing="0"> 
    <tr class="t_td_text"> 
		<?php
		$arr=array("一肖中","一肖不中","二肖中","二肖不中","三肖中","三肖不中","四肖中","四肖不中","五肖中","五肖不中","六肖中","六肖不中","七肖中","七肖不中","八肖中","八肖不中","九肖中","九肖不中","十肖中","十肖不中","十一肖中","十一肖不中");
		for($i=0;$i<count($arr);$i++){
		?>
    	<td height="29" style="background:#FFFFCC"><b><?=$arr[$i]?></b></td>
		<td width="50"><span class="stt o" id="<?=$ch?>h<?=$i+1?>"></span></td>
		<td><input  type="radio" name="gg" value="t<?=$i+1?>"   /></td> 
		<?php
			if(($i+1)%4==0){
				echo '<tr class="t_td_text">';
			}    
		}
		?>
		<td colspan="6"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	 
    <tr class="t_td_text">
		<?php
		$iIndex=1;
		foreach($CONFIG["lhc_rgb"]['SX'] as $k=>$arr){ 
			echo "<td width=30><b>{$k}</b></td>";  
			echo "<td width=30 class=\"t{$iIndex} v\"><input type=checkbox style='display:none' name=\"t[]\"  id='t{$iIndex}'  value=\"{$k}\" /></td>";
			echo "<td><table align=left><tr>";
			foreach($arr as $v){ 
				echo "<td class='".ball_color($v)."'>".$v."</td>"; 
			} 
			echo "</tr></table></td>"; 
			if($iIndex%3==0 && $iIndex<12) echo "<tr class=\"t_td_text\">";
			$iIndex++; 
		}
		?>
    </tr> 
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" disabled="disabled" class="inputq qw" id="rn" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" disabled="disabled" class="inputq qw" id="sub" value="下註" /></td>
    </tr>
</table>
</form>
<input type="hidden" id="mix" value="<?php echo $ConfigModel['g_mix_money']?>" />
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