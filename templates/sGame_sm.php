<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGame.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_mix_money`");
if ($ConfigModel['g_kg_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
$_SESSION['pk'] = false;
$_SESSION['gd'] = true;
$_SESSION['jsk3'] = false;

//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode (',', $result[0]['g_panlus']); 


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
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="./js/odds_sm.js"></script>
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
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td class="bolds wanfa">廣東快樂十分</td>
        <td><span style="color:#0033FF; font-weight:bold" id="tys">兩面盤</span></td>
        <td align="left" class="bolds" style="color:#FF0000"><div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;"> <span>今天輸贏：</span></div></td>
		<td align="left" class="bolds" style="color:#FF0000">
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td   class="bolds" align="right"><span id="number" style="font-size:14px;position:relative; top:1px"></span>期開獎 </td>
        <td width="32"><div  id="a" class="nc1"></div></td>
        <td width="32"><div  id="b"></div></td>
        <td width="32"><div   id="c"></div></td>
        <td width="32"><div  id="d"></div></td>
        <td width="32"><div   id="e"></div></td>
        <td width="32"><div  id="f"></div></td>
        <td width="32"><div   id="g"></div></td>
        <td width="32"><div   id="h"></div></td>
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
    	<td colspan="12">總和、龍虎</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">總和大</td>
    	<td class="o" width="45" id="h1"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和單</td>
    	<td class="o" width="45" id="h2"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和尾大</td>
    	<td class="o" width="45" id="h5"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">龍</td>
    	<td class="o" width="45" id="h6"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">總和小</td>
    	<td class="o" width="45" id="h3"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和雙</td>
    	<td class="o" width="45" id="h4"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">總和尾小</td>
    	<td class="o" width="45" id="h7"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">虎</td>
    	<td class="o" width="45" id="h8"></td>
    	<td class="loads"></td>
    </tr>
	<tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第一球</td>
    	<td colspan="3">第二球</td>
    	<td colspan="3">第三球</td>
    	<td colspan="3">第四球</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ah21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="bh21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="ch21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="dh21"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ah22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="bh22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="ch22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="dh22"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ah23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="bh23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="ch23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="dh23"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ah24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="bh24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="ch24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="dh24"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="ah25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="bh25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="ch25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="dh25"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="ah26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="bh26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="ch26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="dh26"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="ah27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="bh27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="ch27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="dh27"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="ah28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="bh28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="ch28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="dh28"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_list_caption" style="color:#000">
    	<td colspan="3">第五球</td>
    	<td colspan="3">第六球</td>
    	<td colspan="3">第七球</td>
    	<td colspan="3">第八球</td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="eh21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="fh21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="gh21"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">大</td>
    	<td class="o" width="45" id="hh21"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="eh22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="fh22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="gh22"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">小</td>
    	<td class="o" width="45" id="hh22"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="eh23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="fh23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="gh23"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">單</td>
    	<td class="o" width="45" id="hh23"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="eh24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="fh24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="gh24"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">雙</td>
    	<td class="o" width="45" id="hh24"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="eh25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="fh25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="gh25"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾大</td>
    	<td class="o" width="45" id="hh25"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="eh26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="fh26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="gh26"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">尾小</td>
    	<td class="o" width="45" id="hh26"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="eh27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="fh27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="gh27"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數單</td>
    	<td class="o" width="45" id="hh27"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="eh28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="fh28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="gh28"></td>
    	<td class="loads"></td>
    	<td width="57" class="caption_1">合數雙</td>
    	<td class="o" width="45" id="hh28"></td>
    	<td class="loads"></td>
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
        <td><a class="nv" <?php echo $onclick?>>總和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和單雙</a></td>
        <td><a class="nv" <?php echo $onclick?>>總和尾數大小</a></td>
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