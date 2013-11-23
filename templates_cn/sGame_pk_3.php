<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['cq'] = false;
$_SESSION['gx'] = false;
$_SESSION['jx'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = true;


$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_3_pk.js"></script>
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
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px; height:27px">
    <tr>
        <td class="bolds wanfa2">北京賽車(PK10)</td>
        <td class="swanfa_l"><span style="color:#0033FF; font-weight:bold" id="tys">三、四、五、六名</span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div>
		</td>
		<td align="left" class="bolds" style="color:#FF0000">
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
        <td width="25" class="No_" id="a">&nbsp;</td>
        <td width="25" class="No_" id="b">&nbsp;</td>
        <td width="25" class="No_" id="c">&nbsp;</td>
        <td width="25" class="No_" id="d">&nbsp;</td>
        <td width="25" class="No_" id="e">&nbsp;</td>
        <td width="25" class="No_" id="f">&nbsp;</td>
        <td width="25" class="No_" id="g">&nbsp;</td>
        <td width="25" class="No_" id="h">&nbsp;</td>
		<td width="25" class="No_" id="j">&nbsp;</td>
        <td width="25" class="No_" id="k">&nbsp;</td>
    </tr>
</table>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="85">&nbsp;</td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td >投注类型：</td>
        <td width="100"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="center"><table border="0" width="500" >
                <tr height="30">
					<td id="td_input_money"><table><tr><td>金額</td><td><input type="text"  id="AllMoney"    onkeydown="return IsNumeric()"  class=myAllMoney  value=""  /></td></tr></table></td>
                    <td align="right" style="padding-right:10px"><input type="submit" id="submits1" class="inputs ti" value="確定" /></td>
                    <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
                    <td width="200"  ></td>
                </tr>
            </table></td>
    </tr>
</table>    
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第三名</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="ch1">&nbsp;</td>
    	  <td class="tt" id="t1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="ch5">&nbsp;</td>
    	  <td class="tt" id="t5">&nbsp;</td>
    	<td width="57"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="ch9">&nbsp;</td>
    	  <td class="tt" id="t9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ch11">&nbsp;</td>
    	  <td class="tt" id="t11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="ch2">&nbsp;</td>
    	  <td class="tt" id="t2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="ch6">&nbsp;</td>
    	  <td class="tt" id="t6">&nbsp;</td>
    	<td width="57"  class="No_10">&nbsp;</td>
		<td class="o" width="45" id="ch10">&nbsp;</td>
    	  <td class="tt" id="t10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ch12">&nbsp;</td>
    	  <td class="tt" id="t12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="ch3">&nbsp;</td>
    	  <td class="tt" id="t3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="ch7">&nbsp;</td>
    	  <td class="tt" id="t7">&nbsp;</td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="ch15">&nbsp;</td>
    	  <td class="tt" id="t15">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ch13">&nbsp;</td>
    	  <td class="tt" id="t13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="ch4">&nbsp;</td>
    	  <td class="tt" id="t4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="ch8">&nbsp;</td>
    	  <td class="tt" id="t8">&nbsp;</td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="ch16">&nbsp;</td>
    	  <td class="tt" id="t16">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ch14">&nbsp;</td>
    	  <td class="tt" id="t14">&nbsp;</td>
    </tr>
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第四名</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="dh1">&nbsp;</td>
    	<td class="tt" id="t1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="dh5">&nbsp;</td>
    	<td class="tt" id="t5">&nbsp;</td>
    	<td width="57"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="dh9">&nbsp;</td>
    	<td class="tt" id="t9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="dh11">&nbsp;</td>
    	<td class="tt" id="t11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="dh2">&nbsp;</td>
    	<td class="tt" id="t2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="dh6">&nbsp;</td>
    	<td class="tt" id="t6">&nbsp;</td>
    	<td width="57"  class="No_10">&nbsp;</td>
    	<td class="o" width="45" id="dh10">&nbsp;</td>
    	<td class="tt" id="t10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="dh12">&nbsp;</td>
    	<td class="tt" id="t12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="dh3">&nbsp;</td>
    	<td class="tt" id="t3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="dh7">&nbsp;</td>
    	<td class="tt" id="t7">&nbsp;</td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="dh15">&nbsp;</td>
    	<td class="tt" id="t15">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="dh13">&nbsp;</td>
    	<td class="tt" id="t13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="dh4">&nbsp;</td>
    	<td class="tt" id="t4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="dh8">&nbsp;</td>
    	<td class="tt" id="t8">&nbsp;</td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="dh16">&nbsp;</td>
    	<td class="tt" id="t16">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="dh14">&nbsp;</td>
    	<td class="tt" id="t14">&nbsp;</td>
    </tr>
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第五名</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="eh1">&nbsp;</td>
    	<td class="tt" id="t1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="eh5">&nbsp;</td>
    	<td class="tt" id="t5">&nbsp;</td>
    	<td width="57"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="eh9">&nbsp;</td>
    	<td class="tt" id="t9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="eh11">&nbsp;</td>
    	<td class="tt" id="t11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="eh2">&nbsp;</td>
    	<td class="tt" id="t2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="eh6">&nbsp;</td>
    	<td class="tt" id="t6">&nbsp;</td>
    	<td width="57"  class="No_10">&nbsp;</td>
    	<td class="o" width="45" id="eh10">&nbsp;</td>
    	<td class="tt" id="t10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="eh12">&nbsp;</td>
    	<td class="tt" id="t12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="eh3">&nbsp;</td>
    	<td class="tt" id="t3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="eh7">&nbsp;</td>
    	<td class="tt" id="t7">&nbsp;</td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="eh15">&nbsp;</td>
    	<td class="tt" id="t15">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="eh13">&nbsp;</td>
    	<td class="tt" id="t13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="eh4">&nbsp;</td>
    	<td class="tt" id="t4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="eh8">&nbsp;</td>
    	<td class="tt" id="t8">&nbsp;</td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="eh16">&nbsp;</td>
    	<td class="tt" id="t16">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="eh14">&nbsp;</td>
    	<td class="tt" id="t14">&nbsp;</td>
    </tr>
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第六名</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="fh1">&nbsp;</td>
    	<td class="tt" id="t1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="fh5">&nbsp;</td>
    	<td class="tt" id="t5">&nbsp;</td>
    	<td width="57"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="fh9">&nbsp;</td>
    	<td class="tt" id="t9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="fh11">&nbsp;</td>
    	<td class="tt" id="t11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="fh2">&nbsp;</td>
   		<td class="tt" id="t2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="fh6">&nbsp;</td>
    	<td class="tt" id="t6">&nbsp;</td>
    	<td width="57"  class="No_10">&nbsp;</td>
    	<td class="o" width="45" id="fh10">&nbsp;</td>
    	<td class="tt" id="t10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="fh12">&nbsp;</td>
    	<td class="tt" id="t12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="fh3">&nbsp;</td>
    	<td class="tt" id="t3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="fh7">&nbsp;</td>
    	<td class="tt" id="t7">&nbsp;</td>
    	<td colspan="3" rowspan="2" class="caption_1">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="fh13">&nbsp;</td>
    	<td class="tt" id="t13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="fh4">&nbsp;</td>
    	<td class="tt" id="t4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="fh8">&nbsp;</td>
    	<td class="tt" id="t8">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="fh14">&nbsp;</td>
    	<td class="tt" id="t14">&nbsp;</td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="submit" id="submits" class="inputs ti" value="確定" /></td>
        <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
        <td width="0" class="actiionn">&nbsp;</td>
    </tr>
</table>
</form>
<br />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>第三名</a></td>
        <td><a class="nv" <?php echo $onclick?>>第四名</a></td>
        <td><a class="nv" <?php echo $onclick?>>第五名</a></td>
        <td><a class="nv_a" <?php echo $onclick?>>第六名</a></td>
    </tr>
    <tr>
    	<td colspan="4" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
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