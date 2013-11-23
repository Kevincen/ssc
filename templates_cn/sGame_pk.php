<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
$_SESSION['jsk3'] = false;
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
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_zh_pk.js"></script>
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
        <td class="swanfa"><span style="color:#0033FF; font-weight:bold" id="tys">冠、亞軍 組合</span></td>
        <td align="left" class="bolds" style="color:#FF0000" nowrap><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div></td>
		<td align="left" class="bolds" style="color:#FF0000" nowrap>
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
<table class="wqs saiche" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">冠、亞軍和 （冠軍車號＋亞軍車號 ＝ 和）</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">3</td>
    	<td class="o" width="45" id="lh1">&nbsp;</td>
    	  <td class="tt" id="t11_h1">&nbsp;</td>
    	<td width="57" class="caption_1">4</td>
    	<td class="o" width="45" id="lh2">&nbsp;</td>
    	 <td class="tt" id="t11_h2">&nbsp;</td>
    	<td width="57" class="caption_1">5</td>
    	<td class="o" width="45" id="lh3">&nbsp;</td>
    	 <td class="tt" id="t11_h3">&nbsp;</td>
    	<td width="57" class="caption_1">6</td>
    	<td class="o" width="45" id="lh4">&nbsp;</td>
    	 <td class="tt" id="t11_h4">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">7</td>
    	<td class="o" width="45" id="lh5">&nbsp;</td>
    	 <td class="tt" id="t11_h5">&nbsp;</td>
    	<td width="57" class="caption_1">8</td>
    	<td class="o" width="45" id="lh6">&nbsp;</td>
    	 <td class="tt" id="t11_h6">&nbsp;</td>
    	<td width="57" class="caption_1">9</td>
    	<td class="o" width="45" id="lh7">&nbsp;</td>
    	 <td class="tt" id="t11_h7">&nbsp;</td>
    	<td width="57" class="caption_1">10</td>
    	<td class="o" width="45" id="lh8">&nbsp;</td>
    	 <td class="tt" id="t11_h8">&nbsp;</td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">11</td>
    	<td class="o" width="45" id="lh9">&nbsp;</td>
    	 <td class="tt" id="t11_h9">&nbsp;</td>
    	<td width="57" class="caption_1">12</td>
    	<td class="o" width="45" id="lh10">&nbsp;</td>
    	 <td class="tt" id="t11_h10">&nbsp;</td>
    	<td width="57" class="caption_1">13</td>
    	<td class="o" width="45" id="lh11">&nbsp;</td>
    	 <td class="tt" id="t11_h11">&nbsp;</td>
    	<td width="57" class="caption_1">14</td>
    	<td class="o" width="45" id="lh12">&nbsp;</td>
    	 <td class="tt" id="t11_h12">&nbsp;</td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">15</td>
    	<td class="o" width="45" id="lh13">&nbsp;</td>
    	 <td class="tt" id="t11_h13">&nbsp;</td>
    	<td width="57" class="caption_1">16</td>
    	<td class="o" width="45" id="lh14">&nbsp;</td>
    	 <td class="tt" id="t11_h14">&nbsp;</td>
    	<td width="57" class="caption_1">17</td>
    	<td class="o" width="45" id="lh15">&nbsp;</td>
    	 <td class="tt" id="t11_h15">&nbsp;</td>
    	<td width="57" class="caption_1">18</td>
    	<td class="o" width="45" id="lh16">&nbsp;</td>
    	 <td class="tt" id="t11_h16">&nbsp;</td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">19</td>
    	<td class="o" width="45" id="lh17">&nbsp;</td>
    	 <td class="tt" id="t11_h17">&nbsp;</td>
    	<td colspan="9" class="caption_1">&nbsp;</td>
   	</tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">冠亞大</td>
    	<td class="o" width="45" id="kh1">&nbsp;</td>
    	 <td class="tt" id="t12_h1">&nbsp;</td>
    	<td width="57" class="caption_1">冠亞小</td>
    	<td class="o" width="45" id="kh2">&nbsp;</td>
    	 <td class="tt" id="t12_h2">&nbsp;</td>
    	<td width="57" class="caption_1">冠亞單</td>
    	<td class="o" width="45" id="kh3">&nbsp;</td>
    	 <td class="tt" id="t12_h3">&nbsp;</td>
    	<td width="57" class="caption_1">冠亞雙</td>
    	<td class="o" width="45" id="kh4">&nbsp;</td>
    	 <td class="tt" id="t12_h4">&nbsp;</td>
    </tr>
  </table>
  <table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption"><!-- <a class="nv_a" -->
     	<td class="td_caption_2"><a class="nv" <?php echo $onclick?>>冠、亞軍和</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亞軍和 大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亞軍和 單雙</a></td>
    </tr>
    <tr>
    	<td colspan="4" class="t_td_text" align="center">
        	<table class="hj" border="0" cellpadding="0" cellspacing="1">
            	<tr class="t_td_text" id="z_cl"><td></td></tr>
            </table>
        </td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">冠军</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="ah1">&nbsp;</td>
    	<td class="tt" id="t1_h1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="ah5">&nbsp;</td>
    	 <td class="tt" id="t1_h5">&nbsp;</td>
    	<td width="29"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="ah9">&nbsp;</td>
    	 <td class="tt" id="t1_h9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ah11">&nbsp;</td>
    	 <td class="tt" id="t1_h11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="ah2">&nbsp;</td>
    	 <td class="tt" id="t1_h2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="ah6">&nbsp;</td>
    	 <td class="tt" id="t1_h6">&nbsp;</td>
    	<td width="29"  class="No_10">&nbsp;</td>
		<td class="o" width="45" id="ah10">&nbsp;</td>
    	 <td class="tt" id="t1_h10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ah12">&nbsp;</td>
    	 <td class="tt" id="t1_h12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="ah3">&nbsp;</td>
    	 <td class="tt" id="t1_h3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="ah7">&nbsp;</td>
    	 <td class="tt" id="t1_h7">&nbsp;</td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="ah15">&nbsp;</td>
    	 <td class="tt" id="t1_h15">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ah13">&nbsp;</td>
    	 <td class="tt" id="t1_h13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="ah4">&nbsp;</td>
    	 <td class="tt" id="t1_h4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="ah8">&nbsp;</td>
    	 <td class="tt" id="t1_h8">&nbsp;</td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="ah16">&nbsp;</td>
    	 <td class="tt" id="t1_h16">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ah14">&nbsp;</td>
    	 <td class="tt" id="t1_h14">&nbsp;</td>
    </tr>
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="12">亞軍</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_1">&nbsp;</td>
    	<td class="o" width="45" id="bh1">&nbsp;</td>
    	 <td class="tt" id="t2_h1">&nbsp;</td>
    	<td width="29"  class="No_5">&nbsp;</td>
    	<td class="o" width="45" id="bh5">&nbsp;</td>
    	 <td class="tt" id="t2_h5">&nbsp;</td>
    	<td width="29"  class="No_9">&nbsp;</td>
    	<td class="o" width="45" id="bh9">&nbsp;</td>
    	 <td class="tt" id="t2_h9">&nbsp;</td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="bh11">&nbsp;</td>
    	 <td class="tt" id="t2_h11">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_2">&nbsp;</td>
    	<td class="o" width="45" id="bh2">&nbsp;</td>
    	 <td class="tt" id="t2_h2">&nbsp;</td>
    	<td width="29"  class="No_6">&nbsp;</td>
    	<td class="o" width="45" id="bh6">&nbsp;</td>
    	 <td class="tt" id="t2_h6">&nbsp;</td>
    	<td width="29"  class="No_10">&nbsp;</td>
    	<td class="o" width="45" id="bh10">&nbsp;</td>
    	 <td class="tt" id="t2_h10">&nbsp;</td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="bh12">&nbsp;</td>
    	 <td class="tt" id="t2_h12">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_3">&nbsp;</td>
    	<td class="o" width="45" id="bh3">&nbsp;</td>
    	 <td class="tt" id="t2_h3">&nbsp;</td>
    	<td width="29"  class="No_7">&nbsp;</td>
    	<td class="o" width="45" id="bh7">&nbsp;</td>
    	 <td class="tt" id="t2_h7">&nbsp;</td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="bh15">&nbsp;</td>
    	 <td class="tt" id="t2_h15">&nbsp;</td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="bh13">&nbsp;</td>
    	 <td class="tt" id="t2_h13">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td width="29"  class="No_4">&nbsp;</td>
    	<td class="o" width="45" id="bh4">&nbsp;</td>
    	 <td class="tt" id="t2_h4">&nbsp;</td>
    	<td width="29"  class="No_8">&nbsp;</td>
    	<td class="o" width="45" id="bh8">&nbsp;</td>
    	 <td class="tt" id="t2_h8">&nbsp;</td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="bh16">&nbsp;</td>
    	 <td class="tt" id="t2_h16">&nbsp;</td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="bh14">&nbsp;</td>
    	 <td class="tt" id="t2_h14">&nbsp;</td>
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