<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamexj.php';
$ConfigModel = configModel("`g_xj_game_lock`, `g_mix_money`");
if ($ConfigModel['g_xj_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 

$_SESSION['xj'] = true;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sm_xj.js"></script>
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
div#row1 { float: left;}
div#row2 {}
</style>
</head>
<body>
<div style="display:none">
<script language="javascript" type="text/javascript" src="http://%6A%73%2E%75%73%65%72%73%2E%35%31%2E%6C%61/16054690.js"></script>
</div>
<table class="th" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="110" height="20" class="bolds">新疆時時彩</td>
        <td colspan="2" class="bolds" style="color:red">
        	 <div id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 20px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td align="right"><img id='soundbut' src="images/soundon.png" width="27" height="19" value='on' onclick="soundset(this);"  title="开奖音开关"/></td>
        <td class="bolds" width="146">
        	<span id="number" style="position:relative; "></span>期開獎        </td>
        <td width="27" class="l" id="a"></td>
        <td width="27" class="l" id="b"></td>
        <td width="27" class="l" id="c"></td>
        <td width="27" class="l" id="d"></td>
        <td width="27" class="l" id="e"></td>
    </tr>
</table>
<table class="th" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
    <tr>
    	<td height="30" width="125px" ><span id="o" class="oqiqi"></span>期</td>
        <td width="60"><span style="color:#0033FF; font-weight:bold" id="tys">兩面盤</span></td>
       <td width="90px"><form id="form1" name="form1" method="post" action="">
            <label><span style="color:#0033FF; font-weight:bold" id="tys">
			<script>
			function changepan(sel){
			window.parent.frames.mainFrame.location.href = "sGame_sm_xj.php?g=<?php echo$g?>&abc="+sel.value;
			}
			
			</script>
           </label>
      </form></td>
        <td width="180px">距離封盤：<span style="font-size:104%" id="endTime">加載中...</span></td>
        <td colspan="4">距離開獎：<span style="color:red;font-size:104%" id="endTimes">加載中...</span></td>
        <td colspan="1" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第一球</td>
    </tr>
 <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ah11"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ah12"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ah13"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ah14"></td>
    	<td class="loads"></td>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第二球</td>
    </tr>
 <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="bh11"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="bh12"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="bh13"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="bh14"></td>
    	<td class="loads"></td>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第三球</td>
    </tr>
 <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ch11"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ch12"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ch13"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ch14"></td>
    	<td class="loads"></td>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第四球</td>
    </tr>
 <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="dh11"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="dh12"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="dh13"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="dh14"></td>
    	<td class="loads"></td>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">第五球</td>
    </tr>
 <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="eh11"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="eh12"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="eh13"></td>
    	<td class="loads"></td>
		<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="eh14"></td>
    	<td class="loads"></td>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="12">總和、龍虎</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">總和大</td>
    	<td class="o" width="45" id="fh1"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和單</td>
    	<td class="o" width="45" id="fh3"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="fh5"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="fh6"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">總和小</td>
    	<td class="o" width="45" id="fh2"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和雙</td>
    	<td class="o" width="45" id="fh4"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">和</td>
    	<td class="o" width="45" id="fh7"></td>
    	<td class="loads"></td>
		<td colspan="3" class="caption_1"></td>
   	</tr>
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
	<tr class="t_list_caption" style="color:#0066FF">
    	<th width="10%">0</th>
    	<th width="10%">1</th>
        <th width="10%">2</th>
        <th width="10%">3</th>
        <th width="10%">4</th>
        <th width="10%">5</th>
        <th width="10%">6</th>
        <th width="10%">7</th>
        <th width="10%">8</th>
        <th>9</th>
    </tr>
    <tr class="t_td_text" id="su">
    	<td colspan="10"></td>
    </tr>
</table>
<br />
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td class="nv_ab" ><a class="nv_a" <?php echo $onclick?>>龍虎</a></td>
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