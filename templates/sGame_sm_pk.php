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
<script type="text/javascript" src="./js/odds_sm_pk.js"></script>
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
        <td class="swanfa"><span style="color:#0033FF; font-weight:bold" id="tys">兩面盤</span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div>
		</td>
		<td align="left" class="bolds" style="color:#FF0000">
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
        <td width="25" class="No_" id="a"></td>
        <td width="25" class="No_" id="b"></td>
        <td width="25" class="No_" id="c"></td>
        <td width="25" class="No_" id="d"></td>
        <td width="25" class="No_" id="e"></td>
        <td width="25" class="No_" id="f"></td>
        <td width="25" class="No_" id="g"></td>
        <td width="25" class="No_" id="h"></td>
		<td width="25" class="No_" id="j"></td>
        <td width="25" class="No_" id="k"></td>
    </tr>
</table>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td ><span id="o" style=" color:#009900; font-weight:bold; font-size:14px;position:relative; top:1px"></span>期</td>
        <td width="85"></td>
        <td>距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="6">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="2" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<table class="ths" border="0" cellpadding="0" cellspacing="0">
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
    	<td colspan="3">冠軍</td>
		<td colspan="3">亞軍</td>
		<td colspan="3">第三名</td>
		<td colspan="3">第四名</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="ah11"></td>
    	<td class="tt" id="t1_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="bh11"></td>
    	  <td class="tt" id="t2_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="ch11"></td>
    	  <td class="tt" id="t3_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="dh11"></td>
    	  <td class="tt" id="t4_h11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="ah12"></td>
    	  <td class="tt" id="t1_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="bh12"></td>
    	  <td class="tt" id="t2_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="ch12"></td>
    	  <td class="tt" id="t3_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="dh12"></td>
    	  <td class="tt" id="t4_h12"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="ah13"></td>
    	  <td class="tt" id="t1_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="bh13"></td>
    	  <td class="tt" id="t2_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="ch13"></td>
    	  <td class="tt" id="t3_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="dh13"></td>
    	  <td class="tt" id="t4_h13"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="ah14"></td>
    	  <td class="tt" id="t1_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="bh14"></td>
    	  <td class="tt" id="t2_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="ch14"></td>
    	  <td class="tt" id="t3_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="dh14"></td>
    	  <td class="tt" id="t4_h14"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="ah15"></td>
    	  <td class="tt" id="t1_h15"></td>
		<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="bh15"></td>
    	  <td class="tt" id="t2_h15"></td>
		<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="ch15"></td>
    	  <td class="tt" id="t3_h15"></td>
		<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="dh15"></td>
    	  <td class="tt" id="t4_h15"></td>
   	</tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="ah16"></td>
    	  <td class="tt" id="t1_h16"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="bh16"></td>
    	  <td class="tt" id="t2_h16"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="ch16"></td>
    	  <td class="tt" id="t3_h16"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="dh16"></td>
    	  <td class="tt" id="t4_h16"></td>
    </tr>

	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第五名</td>
		<td colspan="3">第六名</td>
		<td colspan="3">第七名</td>
		<td colspan="3">第八名</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="eh11"></td>
    	  <td class="tt" id="t5_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="fh11"></td>
    	<td class="tt" id="t6_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="gh11"></td>
    	<td class="tt" id="t7_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="hh11"></td>
    	<td class="tt" id="t8_h11"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="eh12"></td>
    	<td class="tt" id="t5_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="fh12"></td>
    	<td class="tt" id="t6_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="gh12"></td>
    	<td class="tt" id="t7_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="hh12"></td>
    	<td class="tt" id="t8_h12"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="eh13"></td>
    	<td class="tt" id="t5_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="fh13"></td>
    	<td class="tt" id="t6_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="gh13"></td>
    	<td class="tt" id="t7_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="hh13"></td>
    	<td class="tt" id="t8_h13"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="eh14"></td>
    	<td class="tt" id="t5_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="fh14"></td>
    	<td class="tt" id="t6_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="gh14"></td>
    	<td class="tt" id="t7_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="hh14"></td>
    	<td class="tt" id="t8_h14"></td>
    </tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="57" id="eh15"></td>
    	<td class="tt" id="t5_h15"></td>
		<td colspan="9" rowspan="2" class="caption_1">&nbsp;</td>
   	</tr>
	<tr class="t_td_text">
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="57" id="eh16"></td>
    	<td class="tt" id="t5_h16"></td>
   	</tr>
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第九名</td>
		<td colspan="3">第十名</td>
		<td colspan="3">冠、亞軍和</td>
		<td colspan="3">&nbsp;</td>
    </tr>
   <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="ih11"></td>
    	<td class="tt" id="t9_h11"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="57" id="jh11"></td>
    	<td class="tt" id="t10_h11"></td>
    	<td width="57" class="caption_1">冠亞大</td>
    	<td class="o" width="57" id="kh1"></td>
    	<td class="tt" id="t12_h1"></td>
    	<td colspan="3" rowspan="5" class="caption_1">&nbsp;</td>
   	</tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="ih12"></td>
    	<td class="tt" id="t9_h12"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="57" id="jh12"></td>
    	<td class="tt" id="t10_h12"></td>
    	<td width="57" class="caption_1">冠亞小</td>
    	<td class="o" width="57" id="kh2"></td>
    	<td class="tt" id="t12_h2"></td>
   	</tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="ih13"></td>
    	<td class="tt" id="t9_h13"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="57" id="jh13"></td>
    	<td class="tt" id="t10_h13"></td>
    	<td width="57" class="caption_1">冠亞單</td>
    	<td class="o" width="57" id="kh3"></td>
    	<td class="tt" id="t12_h3"></td>
   	</tr>
	 <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="ih14"></td>
    	<td class="tt" id="t9_h14"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="57" id="jh14"></td>
    	<td class="tt" id="t10_h14"></td>
    	<td width="57" class="caption_1">冠亞雙</td>
    	<td class="o" width="57" id="kh4"></td>
    	<td class="tt" id="t12_h4"></td>
   	</tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="submit" id="submits" class="inputs ti" value="確定" /></td>
        <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
        <td width="0" class="actiionn"></td>
    </tr>
</table>
</form>
<br />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td class="nv_ab" ><a class="nv_a" <?php echo $onclick?>>冠、亞軍和</a></td>
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