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
<html xmlns="http://www.w3.org/1999/xhtml" oncontextmenu="return false">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/sGame_xj.js"></script>
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
    	<td width="105" height="20" class="bolds">新疆時時彩</td>
        <td colspan="2" class="bolds" style="color:red"> <div  id="row1" style="position: relative; filter: blur(add=1, direction=45, strength=3); FONT-FAMILY: Arial; height: 15px; color: red; font-size: 10pt;">
<span>今天輸贏：</span></div><div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div></td>
        <td class="bolds" style="color:red" align="right"></td>
      <td align="right"><img id='soundbut' src="images/soundon.png" width="27" height="19" value='on' onclick="soundset(this);"  title="开奖音开关"/></td>
        <td align="right"  colspan="4">
        			<td class="bolds" width="146" align="left">
			        	<span id="number" style="position:relative;"></span>期開獎</td>
			        <td id="a" class="l"></td>
			        <td id="b" class="l"></td>
			        <td id="c" class="l"></td>
			        <td id="d" class="l"></td>
			        <td id="e" class="l"> </td>
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
			window.parent.frames.mainFrame.location.href = "sGame_xj.php?g=<?php echo$g?>&abc="+sel.value;
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
    	<td class="No_cq0"></td>
    	<td class="o" width="40" id="ah1"></td>
    	<td class="loads"></td>
    	<td class="No_cq1"></td>
    	<td class="o" width="40" id="ah2"></td>
    	<td class="loads"></td>
    	<td class="No_cq2"></td>
    	<td class="o" width="40" id="ah3"></td>
    	<td class="loads"></td>
    	<td class="No_cq3"></td>
    	<td class="o" width="40" id="ah4"></td>
    	<td class="loads"></td>
    	<td class="No_cq4"></td>
    	<td class="o" width="40" id="ah5"></td>
    	<td class="loads"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="No_cq5"></td>
    	<td class="o" width="40" id="ah6"></td>
    	<td class="loads"></td>
    	<td class="No_cq6"></td>
    	<td class="o" width="40" id="ah7"></td>
    	<td class="loads"></td>
    	<td class="No_cq7"></td>
    	<td class="o" width="40" id="ah8"></td>
    	<td class="loads"></td>
    	<td class="No_cq8"></td>
    	<td class="o" width="40" id="ah9"></td>
    	<td class="loads"></td>
    	<td class="No_cq9"></td>
    	<td class="o" width="40" id="ah10"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
    <tr class="t_td_text">
    	<td  class="caption_1 ah11" width="49">大</td>
    	<td class="o" width="40" id="ah11"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ah12" width="49">小</td>
    	<td class="o" width="40" id="ah12"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ah13" width="49">單</td>
    	<td class="o" width="40" id="ah13"></td>
    	<td class="loads"></td>
    	<td  class="caption_1 ah14" width="49">雙</td>
    	<td class="o" width="40" id="ah14"></td>
    	<td class="loads"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="12">總和、龍虎和</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 bh1">總和大</td>
    	<td class="o" width="40" id="bh1"></td>
    	<td class="loads" width="80"></td>
    	<td  class="caption_1 bh2">總和小</td>
    	<td class="o" width="40" id="bh2"></td>
    	<td class="loads" width="80"></td>
    	<td  class="caption_1 bh3">總和單</td>
    	<td class="o" width="40" id="bh3"></td>
    	<td class="loads" width="80"></td>
    	<td  class="caption_1 bh4">總和雙</td>
    	<td class="o" width="40" id="bh4"></td>
    	<td class="loads" width="80"></td>
    </tr>
    <tr class="t_td_text">
    	<td  class="caption_1 bh5">龍</td>
    	<td class="o" width="40" id="bh5"></td>
    	<td class="loads" width="80"></td>
    	<td  class="caption_1 bh6">虎</td>
    	<td class="o" width="40" id="bh6"></td>
    	<td class="loads" width="80"></td>
    	<td  class="caption_1 bh7">和</td>
    	<td class="o" width="40" id="bh7"></td>
    	<td class="loads" width="80"></td>
    	<td colspan="3"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">前三</td>
	</tr>
    <tr class="t_td_text">
    	<td class="caption_1 ch1">豹子</td>
    	<td class="o" width="40" id="ch1"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 ch2">順子</td>
    	<td class="o" width="40" id="ch2"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 ch3">對子</td>
    	<td class="o" width="40" id="ch3"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 ch4">半順</td>
    	<td class="o" width="40" id="ch4"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 ch5">雜六</td>
    	<td class="o" width="40" id="ch5"></td>
    	<td class="loads" width="60"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">中三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 dh1">豹子</td>
    	<td class="o" width="40" id="dh1"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 dh2">順子</td>
    	<td class="o" width="40" id="dh2"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 dh3">對子</td>
    	<td class="o" width="40" id="dh3"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 dh4">半順</td>
    	<td class="o" width="40" id="dh4"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 dh5">雜六</td>
    	<td class="o" width="40" id="dh5"></td>
    	<td class="loads" width="60"></td>
    </tr>
</table>
<table class="wq" border="0" cellpadding="0" cellspacing="0">
	<tr class="t_list_caption">
	<td colspan="15">后三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 eh1">豹子</td>
    	<td class="o" width="40" id="eh1"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 eh2">順子</td>
    	<td class="o" width="40" id="eh2"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 eh3">對子</td>
    	<td class="o" width="40" id="eh3"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 eh4">半順</td>
    	<td class="o" width="40" id="eh4"></td>
    	<td class="loads" width="60"></td>
    	<td  class="caption_1 eh5">雜六</td>
    	<td class="o" width="40" id="eh5"></td>
    	<td class="loads" width="60"></td>
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