<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamecq.php';
$ConfigModel = configModel("`g_cq_game_lock`, `g_mix_money`");
if ($ConfigModel['g_cq_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);
 
 $pan = explode (',', $result[0]['g_panlus']); 

	
$_SESSION['cq'] = true;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}



switch ($g) {
	case 'g1':
		$types = '第一球';
		$aHtml = '<a '.$getResult.'>第1球</a>';
		break;
	case 'g2':
		$types = '第二球';
		$aHtml = '<a '.$getResult.'>第2球</a>';
		break;
	case 'g3':
		$types = '第三球';
		$aHtml = '<a '.$getResult.'>第3球</a>';
		break;
	case 'g4':
		$types = '第四球';
		$aHtml = '<a '.$getResult.'>第4球</a>';
		break;
	case 'g5':
		$types = '第五球';
		$aHtml = '<a '.$getResult.'>第5球</a>';
		break;
	default:exit;
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGame_cq.js"></script>
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
<div style="display:none">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "%68%6D%2E%62%61%69%64%75%2E%63%6F%6D/h.js%3F9898c9fdab97319b23cd83299998e52e' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
<input type="hidden" id="hiden" value="<?php echo $g?>" /> 
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td class="bolds wanfa">重慶時時彩</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys"><?=$types?></span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
        <td id="a" class="l">&nbsp;</td>
		<td id="b" class="l">&nbsp;</td>
		<td id="c" class="l">&nbsp;</td>
		<td id="d" class="l">&nbsp;</td>
		<td id="e" class="l"> </td>
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
<table class="ths" border="0" cellpadding="0" cellspacing="0"  style="margin-top:0px">
    <tr>
        <td >投注类型：</td>
        <td width="100"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="center"><table border="0" width="500" >
                <tr height="30">
					<td id="td_input_money"><table><tr><td>金額</td><td><input type="text"  id="AllMoney"    onkeydown="return IsNumeric()"  class=myAllMoney  value=""  /></td></tr></table></td>
                    <td align="right" style="padding-right:10px"><input type="submit" id="submits1" class="inputs ti" value="確定" /></td>
                    <td align="left" style="padding-left:10px"><input type="button" onclick="MyReset()" class="inputs ti" value="重置" /></td>
                    <td width="200" ></td>
                </tr>
            </table></td>
    </tr>
</table> 
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
    	<td>號</td>
    	<td>賠率</td>
    	<td class="je" >金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td class="je" >金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td class="je" >金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td class="je" >金額</td>
    	<td>號</td>
    	<td>賠率</td>
    	<td class="je" >金額</td>
    </tr>
   <tr class="t_td_text">
    	<td class="caption_1 No_cq0">&nbsp;</td>
    	<td class="o" width="40" id="ah1">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq1">&nbsp;</td>
    	<td class="o" width="40" id="ah2">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq2">&nbsp;</td>
    	<td class="o" width="40" id="ah3">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq3">&nbsp;</td>
    	<td class="o" width="40" id="ah4">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq4">&nbsp;</td>
    	<td class="o" width="40" id="ah5">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1 No_cq5">&nbsp;</td>
    	<td class="o" width="40" id="ah6">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq6">&nbsp;</td>
    	<td class="o" width="40" id="ah7">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq7">&nbsp;</td>
    	<td class="o" width="40" id="ah8">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq8">&nbsp;</td>
    	<td class="o" width="40" id="ah9">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1 No_cq9">&nbsp;</td>
    	<td class="o" width="40" id="ah10">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
    <tr class="t_td_text">
    	<td  class="caption_1 ah11" width="49">大</td>
    	<td class="o" width="40" id="ah11">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah12" width="49">小</td>
    	<td class="o" width="40" id="ah12">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah13" width="49">單</td>
    	<td class="o" width="40" id="ah13">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah14" width="49">雙</td>
    	<td class="o" width="40" id="ah14">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="12">總和、龍虎和</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 bh1" width="80">總和大</td>
    	<td class="o" width="40" id="bh1">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td  class="caption_1 bh2" width="80">總和小</td>
    	<td class="o" width="40" id="bh2">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td  class="caption_1 bh3" width="80">總和單</td>
    	<td class="o" width="40" id="bh3">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td  class="caption_1 bh4" width="80">總和雙</td>
    	<td class="o" width="40" id="bh4">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td  class="caption_1 bh5">龍</td>
    	<td class="o" width="40" id="bh5">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td  class="caption_1 bh6">虎</td>
    	<td class="o" width="40" id="bh6">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td  class="caption_1 bh7">和</td>
    	<td class="o" width="40" id="bh7">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td colspan="3">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">前三</td>
	</tr>
    <tr class="t_td_text">
    	<td class="caption_1 ch1">豹子</td>
    	<td class="o" width="40" id="ch1">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 ch2">順子</td>
    	<td class="o" width="40" id="ch2">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 ch3">對子</td>
    	<td class="o" width="40" id="ch3">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 ch4">半順</td>
    	<td class="o" width="40" id="ch4">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 ch5">雜六</td>
    	<td class="o" width="40" id="ch5">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">中三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 dh1">豹子</td>
    	<td class="o" width="40" id="dh1">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 dh2">順子</td>
    	<td class="o" width="40" id="dh2">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 dh3">對子</td>
    	<td class="o" width="40" id="dh3">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 dh4">半順</td>
    	<td class="o" width="40" id="dh4">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 dh5">雜六</td>
    	<td class="o" width="40" id="dh5">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">后三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 eh1">豹子</td>
    	<td class="o" width="40" id="eh1">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 eh2">順子</td>
    	<td class="o" width="40" id="eh2">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 eh3">對子</td>
    	<td class="o" width="40" id="eh3">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 eh4">半順</td>
    	<td class="o" width="40" id="eh4">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    	<td  class="caption_1 eh5">雜六</td>
    	<td class="o" width="40" id="eh5">&nbsp;</td>
    	<td class="loads" width="60">&nbsp;</td>
    </tr>
</table>
<table border="0" width="700">
	<tr height="30">
    	<td align="right" style="padding-right:10px"><input type="button" onclick="reset()" class="inputs ti" value="重填" /></td>
        <td align="left" style="padding-left:10px"><input type="submit" id="submits" class="inputs ti" value="下註" /></td>
        <td width="0" class="actiionn">&nbsp;</td>
    </tr>
</table>
</form>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
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
    	<td colspan="10">&nbsp;</td>
    </tr>
</table>
<br />
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
        <td width="16%" class="nv_ab" ><?php echo$aHtml?></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>大小</a></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>單雙</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td><a class="nv" <?php echo $onclick?>>龍虎和</a></td>
    </tr>
    <tr>
    	<td colspan="6" class="t_td_text" align="center">
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