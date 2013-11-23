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
	case 'g17':
		$types = '連碼';
		$aHtml = '<a '.$getResult.'>連碼</a>';
		$ch="q";
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
	<tr class="t_list_caption" id="ts">
		<td height=20><input  type="radio" name="gg" value="t1"   /> </td>
		<td><input  type="radio" name="gg" value="t2" /> </td>
		<td><input  type="radio" name="gg" value="t3" /> </td>
		<td><input  type="radio" name="gg" value="t4" /> </td>
		<td><input  type="radio" name="gg" value="t5" /> </td>
	</tr>
    <tr class="t_td_text">
    	<td>三中三<br /><span class="stt o" id="qh1"></span></td>
        <td>三中二<br /><span class="stt o" id="qh2"></span></td>
        <td>二中二<br /><span class="stt o" id="qh3"></span></td>
        <td>五不中<br /><span class="stt o" id="qh4"></span></td>
        <td>二中特<br /><span class="stt o" id="qh5"></span></td> 
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
        <td>號</td>
        <td>勾選</td>
		<td>號</td>
        <td>勾選</td>
		<td>號</td>
        <td>勾選</td>
		<td>號</td>
        <td>勾選</td>
    </tr>
	<?php
	for($col=1;$col<=7;$col++){ 
	?>
    <tr class="t_td_text">
		<?php for($row=0;$row<7;$row++){  ?>
    	<td class="<?=ball_color($col+$row*7)?>"><?=strlen($col+$row*7)==1 ? "0".($col+$row*7) : $col+$row*7?></td>
        <td class="t<?=$col+$row*7?> v"><input type="checkbox" style="display:none" name="t[]" id="t<?=$col+$row*7?>" value="<?=$col+$row*7?>" /></td> 
		<?php } ?>
    </tr>
	<?php 
	}
	?>
     
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" disabled="disabled" class="inputq qw" id="rn" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" disabled="disabled" class="inputq qw" id="sub" value="下註" /></td>
    </tr>
</table>
</form>
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